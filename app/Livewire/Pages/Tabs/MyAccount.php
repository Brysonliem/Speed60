<?php

namespace App\Livewire\Pages\Tabs;

use App\Models\User;
use App\Models\AddressUsers;
use App\Services\AddressUserService;
use App\Services\LocationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MyAccount extends Component
{
    public $user = [];


    // password
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // address
    public $addresses = [];
    public $selected_address_id = null;

    public $show_address_form = false;
    public $is_editing_address = false;
    public $address_form = [
        'id' => null,
        'title_address' => '',
        'recipients_name' => '',
        'recipients_phone' => '',
        'address' => '',
        'additional_address' => '',
        'province'          => '',
        'city'              => '',
        'district'          => '',
        'subdistrict'       => '',
        'postal_code'       => '',

        'is_main' => false,
    ];

    // options untuk dropdown
    public array $provinceOptions = [];
    public array $cityOptions = [];
    public array $districtOptions = [];
    public array $subdistrictOptions = [];

    public $tmpProvinceId = null;
    public $tmpCityId = null;
    public $tmpDistrictId = null;
    public $tmpSubdistrictId = null;

    /** @var AddressUserService */
    protected AddressUserService $addressService;
    protected LocationService $locationService;


    // Livewire v3: boot() supports DI. Jika v2, ubah ke mount(AddressUserService $svc) dan sesuaikan.
    public function boot(AddressUserService $service, LocationService $locationService)
    {
        $this->addressService = $service;
        $this->locationService = $locationService;
    }

    public function mount()
    {
        $authUser = Auth::user();

        $this->user = [
            'id'          => $authUser->id,
            'name'        => $authUser->name,
            'username'    => $authUser->username,
            'email'       => $authUser->email,
            'phone_number'=> $authUser->phone_number,
            'address'     => $authUser->address,   // legacy, opsional
            'province'    => $authUser->province,  // legacy, opsional
            'city'        => $authUser->city,      // legacy, opsional
            'district'    => $authUser->district,  // legacy, opsional
            'block'       => $authUser->block,     // legacy, opsional
            'rt'          => $authUser->rt,        // legacy, opsional
            'rw'          => $authUser->rw,        // legacy, opsional
        ];

        $this->reloadAddresses();
        $this->selected_address_id = $this->addressService->defaultSelectedId(Auth::id());
        $this->provinceOptions = $this->locationService->provinces();
    }

    private function reloadAddresses(): void
    {
        $this->addresses = $this->addressService->listForUser(Auth::id());
    }

    /** Dependent selects */
    public function onProvinceChanged($provinceId)
    {
        $this->tmpProvinceId = (int)$provinceId;

        // isi nama ke form (yang akan disimpan)
        $picked = collect($this->provinceOptions)->firstWhere('id', $this->tmpProvinceId);
        $this->address_form['province'] = $picked['name'] ?? '';

        // reset turunan
        $this->tmpCityId = $this->tmpDistrictId = $this->tmpSubdistrictId = null;
        $this->address_form['city'] = '';
        $this->address_form['district'] = '';
        $this->address_form['subdistrict'] = '';
        $this->address_form['postal_code'] = '';

        $this->cityOptions = $this->tmpProvinceId ? $this->locationService->cities($this->tmpProvinceId) : [];
        $this->districtOptions = [];
        $this->subdistrictOptions = [];
    }

    public function onCityChanged($cityId)
    {
        $this->tmpCityId = (int)$cityId;

        $picked = collect($this->cityOptions)->firstWhere('id', $this->tmpCityId);
        $this->address_form['city'] = $picked['name'] ?? '';

        // reset turunan
        $this->tmpDistrictId = $this->tmpSubdistrictId = null;
        $this->address_form['district'] = '';
        $this->address_form['subdistrict'] = '';
        $this->address_form['postal_code'] = '';

        $this->districtOptions = $this->tmpCityId ? $this->locationService->districts($this->tmpCityId) : [];
        $this->subdistrictOptions = [];
    }

    public function onDistrictChanged($districtId)
    {
        $this->tmpDistrictId = (int)$districtId;

        $picked = collect($this->districtOptions)->firstWhere('id', $this->tmpDistrictId);
        $this->address_form['district'] = $picked['name'] ?? '';

        $this->tmpSubdistrictId = null;
        $this->address_form['subdistrict'] = '';
        $this->address_form['postal_code'] = '';

        $this->subdistrictOptions = $this->tmpDistrictId ? $this->locationService->subdistricts($this->tmpDistrictId) : [];
    }

    public function onSubdistrictChanged($subdistrictId)
    {
        $this->tmpSubdistrictId = (int)$subdistrictId;

        $picked = collect($this->subdistrictOptions)->firstWhere('id', $this->tmpSubdistrictId);
        $this->address_form['subdistrict'] = $picked['name'] ?? '';
        $this->address_form['postal_code'] = $picked['zip'] ?? '';
    }



    /** PROFILE */
    public function saveProfile()
    {
        $u = User::findOrFail(Auth::id());

        $this->validate([
            'user.name'         => ['required','string','max:255'],
            'user.username'     => ['required','string','max:255', Rule::unique('users','username')->ignore($u->id)],
            'user.email'        => ['required','email', Rule::unique('users','email')->ignore($u->id)],
            'user.phone_number' => ['nullable','string','max:30'],
        ]);

        $u->update([
            'name'         => $this->user['name'],
            'username'     => $this->user['username'],
            'email'        => $this->user['email'],
            'phone_number' => $this->user['phone_number'],
        ]);

        session()->flash('success', 'Profile updated.');
    }

    /** PASSWORD */
    public function changePassword()
    {
        $this->validate([
            'current_password' => ['required','current_password'],
            'new_password'     => ['required','min:8','confirmed'],
        ]);

        $user = User::findOrFail(Auth::id());
        $user->update(['password' => Hash::make($this->new_password)]);

        $this->reset(['current_password','new_password','new_password_confirmation']);
        session()->flash('success', 'Password success updated!');
    }

    /** ADDRESS: UI actions -> Service */
    public function showCreateAddress()
    {
        $this->resetAddressForm();
        $this->is_editing_address = false;
        $this->show_address_form = true;
    }

    public function editAddress($id)
    {
        // ambil dari array addresses utk isi form
        $addr = collect($this->addresses)->firstWhere('id', (int)$id);
        if (!$addr) return;

        $this->address_form = array_merge($this->address_form, $addr);
        $this->is_editing_address = true;
        $this->show_address_form = true;
    }

    public function saveAddress()
    {
        $this->validate([
            'address_form.title_address'     => ['required','string','max:100'],
            'address_form.recipients_name'   => ['required','string','max:255'],
            'address_form.recipients_phone'  => ['required','string','max:30'],
            'address_form.address'           => ['required','string','max:500'],

            // nama (string), bukan id
            'address_form.province'          => ['required','string','max:120'],
            'address_form.city'              => ['required','string','max:120'],
            'address_form.district'          => ['required','string','max:120'],
            'address_form.subdistrict'       => ['required','string','max:120'],
            'address_form.postal_code'       => ['required','string','max:20'],

            'address_form.additional_address'=> ['nullable','string','max:500'],
            'address_form.is_main'           => ['boolean'],
        ]);


        $saved = $this->addressService->save(Auth::id(), $this->address_form);

        $this->reloadAddresses();
        $this->selected_address_id = $saved->id;
        $this->show_address_form = false;
        $this->is_editing_address = false;

        session()->flash('success', 'Alamat disimpan.');
    }

    public function deleteAddress($id)
    {
        $this->addressService->delete(Auth::id(), (int)$id);

        $this->reloadAddresses();
        $this->selected_address_id = $this->addresses[0]['id'] ?? null;

        session()->flash('success', 'Alamat dihapus.');
    }

    public function setMain($id)
    {
        $this->addressService->setMain(Auth::id(), (int)$id);

        $this->reloadAddresses();
        $this->selected_address_id = (int)$id;
    }

    public function selectAddress($id)
    {
        $this->selected_address_id = (int)$id;
    }

    public function cancelAddressForm()
    {
        $this->show_address_form = false;
        $this->is_editing_address = false;
        $this->resetAddressForm();
    }

    private function resetAddressForm(): void
    {
        $this->address_form = [
            'id' => null,
            'title_address' => '',
            'recipients_name' => '',
            'recipients_phone' => '',
            'address' => '',
            'additional_address' => '',

            // hanya nama:
            'province' => '',
            'city' => '',
            'district' => '',
            'subdistrict' => '',
            'postal_code' => '',

            'is_main' => false,
        ];

        // reset id sementara & options
        $this->tmpProvinceId = $this->tmpCityId = $this->tmpDistrictId = $this->tmpSubdistrictId = null;
        $this->cityOptions = $this->districtOptions = $this->subdistrictOptions = [];
    }



    public function render()
    {
        return view('livewire.pages.tabs.my-account');
    }
}
