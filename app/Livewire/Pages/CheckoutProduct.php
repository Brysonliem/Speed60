<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\TransactionAddressForm;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AddressUserService;
use App\Services\LocationService;
use App\Services\TransactionAddressService;
use App\Services\VoucherService;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\TransactionService;
use App\Services\XenditInvoiceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;

class CheckoutProduct extends BaseComponent
{
    #[Url]
    public $trx = '';

    protected TransactionService $transactionService;
    protected TransactionAddressService $transactionAddressService;
    protected VoucherService $voucherService;
    protected ProductService $productService;

    public TransactionAddressForm $address_form;
    public bool $is_store = false;

    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;
    public $vouchers;
    public $selectedVoucher;
    public $voucher;
    public $discount;

    // ================== ADDRESS BOOK (NEW) ==================
    protected AddressUserService $addressService;
    protected LocationService $locationService;

    /** List untuk grid (array of array), single-select id */
    public array $addresses = [];
    public ?int $selected_address_id = null;

    /** CRUD state */
    public bool $show_book_form = false;
    public bool $is_editing_book = false;

    public array $provinceOptions = [];
    public array $cityOptions = [];
    public array $districtOptions = [];
    public array $subdistrictOptions = [];

    public $tmpProvinceId = null;
    public $tmpCityId = null;
    public $tmpDistrictId = null;
    public $tmpSubdistrictId = null;

    // ================== SHIPPING (NEW) ==================
    public array $shippingOptions = [];   // list opsi kurir
    public ?array $selectedShipping = null; // {'courier_code','service','value','etd',...}
    public int $shipping_price = 0;      // harga terpilih
    public ?string $shipping_courier = null; // 'jne' dll
    public ?string $shipping_service = null; // 'REG' dll
    public ?string $shipping_etd = null;     // '1-2 HARI' dll
    // ====================================================


    /** Form tambah/ubah address book */
    public array $book_form = [
        'id' => null,
        'title_address' => '',
        'recipients_name' => '',
        'recipients_phone' => '',
        'address' => '',
        'additional_address' => '',
        'city' => '',
        'province' => '',
        'postal_code' => '',
        'is_main' => false,
    ];
    // ========================================================

    public function boot(
        TransactionService $transactionService,
        VoucherService $voucherService,
        ProductService $productService,
        TransactionAddressService $transactionAddressService,
        AddressUserService $addressUserService,
        LocationService $locationService 
    ) {
        $this->transactionService        = $transactionService;
        $this->voucherService            = $voucherService;
        $this->productService            = $productService;
        $this->transactionAddressService = $transactionAddressService;
        $this->addressService            = $addressUserService;
        $this->locationService           = $locationService; 
    }


    public function mount()
    {
        $this->loadProductCarts();

        // 1) Address book dulu
        $this->reloadAddresses();
        $this->selected_address_id = $this->addressService->defaultSelectedId(Auth::id());

        // 2) Prefill form dari address terpilih (jika ada)
        $this->fillAddress();

        // 3) Opsi provinsi untuk CRUD alamat
        $this->provinceOptions = $this->locationService->provinces();

        // 4) Hitung ongkir JNT (butuh selected_address_id)
        $this->loadShippingJnt();

        // 5) Baru hitung totals dan vouchers (grand_total sudah include shipping)
        $this->calculateTotals();
        $this->loadVouchers();
    }


    // ================== ADDRESS BOOK HELPERS ==================
    public function onBookProvinceChanged($provinceId): void
    {
        $this->tmpProvinceId = (int)$provinceId;

        $picked = collect($this->provinceOptions)->firstWhere('id', $this->tmpProvinceId);
        $this->book_form['province'] = $picked['name'] ?? '';

        // reset turunan
        $this->tmpCityId = $this->tmpDistrictId = $this->tmpSubdistrictId = null;
        $this->book_form['city'] = '';
        $this->book_form['district'] = '';
        $this->book_form['subdistrict'] = '';
        $this->book_form['postal_code'] = '';

        $this->cityOptions = $this->tmpProvinceId ? $this->locationService->cities($this->tmpProvinceId) : [];
        $this->districtOptions = [];
        $this->subdistrictOptions = [];
    }

    public function onBookCityChanged($cityId): void
    {
        $this->tmpCityId = (int)$cityId;

        $picked = collect($this->cityOptions)->firstWhere('id', $this->tmpCityId);
        $this->book_form['city'] = $picked['name'] ?? '';

        $this->tmpDistrictId = $this->tmpSubdistrictId = null;
        $this->book_form['district'] = '';
        $this->book_form['subdistrict'] = '';
        $this->book_form['postal_code'] = '';

        $this->districtOptions = $this->tmpCityId ? $this->locationService->districts($this->tmpCityId) : [];
        $this->subdistrictOptions = [];
    }

    public function onBookDistrictChanged($districtId): void
    {
        $this->tmpDistrictId = (int)$districtId;

        $picked = collect($this->districtOptions)->firstWhere('id', $this->tmpDistrictId);
        $this->book_form['district'] = $picked['name'] ?? '';

        $this->tmpSubdistrictId = null;
        $this->book_form['subdistrict'] = '';
        $this->book_form['postal_code'] = '';

        $this->subdistrictOptions = $this->tmpDistrictId ? $this->locationService->subdistricts($this->tmpDistrictId) : [];
    }

    public function onBookSubdistrictChanged($subdistrictId): void
    {
        $this->tmpSubdistrictId = (int)$subdistrictId;

        $picked = collect($this->subdistrictOptions)->firstWhere('id', $this->tmpSubdistrictId);
        $this->book_form['subdistrict'] = $picked['name'] ?? '';
        $this->book_form['postal_code'] = $picked['zip'] ?? '';
    }


    private function reloadAddresses(): void
    {
        $this->addresses = $this->addressService->listForUser(Auth::id());
    }

    public function selectAddress(int $id): void
    {
        $this->selected_address_id = $id;

        $sel = collect($this->addresses)->firstWhere('id', $id);
        if ($sel) {
            $this->prefillAddressFormFromBook($sel);
        }

        // Recalculate JNT shipping
        $this->loadShippingJnt();
    }



    public function showCreateAddress(): void
    {
        $this->resetBookForm();
        $this->is_editing_book = false;
        $this->show_book_form = true;
    }

    public function editBookAddress(int $id): void
    {
        $row = collect($this->addresses)->firstWhere('id', $id);
        if (!$row) return;

        $this->book_form = array_merge($this->book_form, $row);
        $this->is_editing_book = true;
        $this->show_book_form = true;
    }

    public function saveBookAddress(): void
    {
        $this->validate([
            'book_form.title_address'      => ['required','string','max:100'],
            'book_form.recipients_name'    => ['required','string','max:255'],
            'book_form.recipients_phone'   => ['required','string','max:30'],
            'book_form.address'            => ['required','string','max:500'],

            // ✅ simpan NAMA (string)
            'book_form.province'           => ['required','string','max:120'],
            'book_form.city'               => ['required','string','max:120'],
            'book_form.district'           => ['required','string','max:120'],
            'book_form.subdistrict'        => ['required','string','max:120'],
            'book_form.postal_code'        => ['required','string','max:20'],

            'book_form.additional_address' => ['nullable','string','max:500'],
            'book_form.is_main'            => ['boolean'],
        ]);


        $saved = $this->addressService->save(Auth::id(), $this->book_form);

        $this->reloadAddresses();
        $this->selected_address_id = $saved->id;
        $this->prefillAddressFormFromBook(
            collect($this->addresses)->firstWhere('id', $saved->id) ?? []
        );

        $this->show_book_form = false;
        $this->is_editing_book = false;

        session()->flash('success', 'Alamat disimpan.');
    }

    public function deleteBookAddress(int $id): void
    {
        $this->addressService->delete(Auth::id(), $id);

        $this->reloadAddresses();
        $this->selected_address_id = $this->addresses[0]['id'] ?? null;

        if ($this->selected_address_id) {
            $this->prefillAddressFormFromBook(
                collect($this->addresses)->firstWhere('id', $this->selected_address_id) ?? []
            );
        }

        session()->flash('success', 'Alamat dihapus.');
    }

    public function setMainBookAddress(int $id): void
    {
        $this->addressService->setMain(Auth::id(), $id);
        $this->reloadAddresses();
        $this->selected_address_id = $id;

        $this->prefillAddressFormFromBook(
            collect($this->addresses)->firstWhere('id', $id) ?? []
        );
    }

    public function cancelBookForm(): void
    {
        $this->show_book_form = false;
        $this->is_editing_book = false;
        $this->resetBookForm();
    }

    private function resetBookForm(): void
    {
        $this->book_form = [
            'id' => null,
            'title_address' => '',
            'recipients_name' => '',
            'recipients_phone' => '',
            'address' => '',
            'additional_address' => '',

            // ✅ hanya NAMA (bukan ID)
            'province' => '',
            'city' => '',
            'district' => '',
            'subdistrict' => '',
            'postal_code' => '',

            'is_main' => false,
        ];

        // id sementara untuk dropdown
        $this->tmpProvinceId = $this->tmpCityId = $this->tmpDistrictId = $this->tmpSubdistrictId = null;

        // opsi dropdown
        $this->cityOptions = $this->districtOptions = $this->subdistrictOptions = [];
    }

    // ==========================================================

    /** Prefill form transaksi dari address book terpilih */
    private function prefillAddressFormFromBook(array $addr): void
    {
        if (!$addr) return;

        // coba pecah nama depan/belakang sederhana
        $parts = preg_split('/\s+/', trim((string)($addr['recipients_name'] ?? '')), 2);
        $first = $parts[0] ?? '';
        $last  = $parts[1] ?? '';

        $this->address_form->first_name  = $first;
        $this->address_form->last_name   = $last;
        $this->address_form->address     = $addr['address'] ?? '';
        $this->address_form->province    = $addr['province'] ?? '';
        $this->address_form->district    = $addr['district'] ?? '';
        $this->address_form->subdistrict = $addr['subdistrict'] ?? '';
        $this->address_form->city        = $addr['city'] ?? '';
        $this->address_form->postal_code = $addr['postal_code'] ?? '';
        $this->address_form->email       = Auth::user()?->email; // book tidak simpan email
        $this->address_form->phone       = $addr['recipients_phone'] ?? '';
        $this->address_form->description = $addr['additional_address'] ?? null;

        $this->loadShippingJnt();
    }

    /** Prefill awal: pakai main address; fallback ke profil */
    public function fillAddress()
    {
        $user = Auth::user();
        // jika ada yang terpilih dari address book, pakai itu
        $sel = $this->selected_address_id
            ? collect($this->addresses)->firstWhere('id', $this->selected_address_id)
            : null;

        if ($sel) {
            $this->prefillAddressFormFromBook($sel);
            return;
        }

        // fallback: isi dari profil user (nama & kontak) — alamatnya biasanya dari address book sekarang
        $this->address_form->first_name  = $user->name;
        $this->address_form->last_name   = $user->last_name ?? null;
        $this->address_form->address     = '';
        $this->address_form->province    = '';
        $this->address_form->city        = '';
        $this->address_form->postal_code = '';
        $this->address_form->email       = $user->email;
        $this->address_form->phone       = $user->phone_number;
        $this->address_form->description = null;
    }



    public function calculateTotals()
    {
        $cartTotal = 0;
        foreach ($this->products as $item) {
            $cartTotal += $item->price * $item->quantity;
        }
        $this->sub_total = $cartTotal;
        $this->tax       = (int) round($this->sub_total * 0.11);

        // ⬇️ grand_total = subtotal + tax + shipping - discount
        $this->grand_total = max(0, (int) $this->sub_total + (int) $this->tax + (int) $this->shipping_price - (int) ($this->discount ?? 0));
    }


    public function updatedSelectedVoucher()
    {
        $this->applyDiscount();
    }

    public function applyDiscount()
    {
        // hitung tanpa diskon dulu
        $this->discount = 0;
        if (!empty($this->selectedVoucher)) {
            $this->voucher = $this->voucherService->getVoucherById($this->selectedVoucher);
            if ($this->voucher) {
                $gross = (int) $this->sub_total + (int) $this->tax + (int) $this->shipping_price;
                $this->discount = (int) round(($this->voucher->voucher_discount_percentage / 100) * $gross);
                session()->flash('success', "Voucher {$this->voucher->voucher_code} applied successfully!");
            }
        }
        // final
        $this->calculateTotals();
    }

    public function selectShipping(string $courier, string $service): void
    {
        $picked = collect($this->shippingOptions)->first(fn($o) =>
            $o['courier_code']===$courier && $o['service']===$service
        );
        if (!$picked) return;

        $this->selectedShipping = $picked;
        $this->shipping_price   = (int) $picked['value'];
        $this->shipping_courier = 'jnt';
        $this->shipping_service = $picked['service'];
        $this->shipping_etd     = $picked['etd'] ?? null;

        // hitung total final + diskon (kalau ada)
        $this->applyDiscount();
    }


    public function loadShippingOptions(): void
    {
        $this->shippingOptions = [];
        $this->selectedShipping = null;
        $this->shipping_price = 0;
        $this->shipping_courier = $this->shipping_service = $this->shipping_etd = null;

        // ambil alamat terpilih
        $sel = $this->selected_address_id ? collect($this->addresses)->firstWhere('id', $this->selected_address_id) : null;
        if (!$sel) {
            // belum ada alamat → biarkan kosong
            $this->calculateTotals();
            return;
        }

        try {
            /** @var \App\Services\LocationService $loc */
            $ids = $this->locationService->resolveIdsFromNames(
                (string)($sel['province'] ?? ''),
                (string)($sel['city'] ?? ''),
                (string)($sel['district'] ?? ''),
                (string)($sel['subdistrict'] ?? '')
            );

            /** @var \App\Services\RajaOngkirClient $ro */
            $ro = app(\App\Services\RajaOngkirClient::class);

            $payload = [
                'origin'          => config('rajaongkir.origin_id'),   // dari .env
                // 'originType'      => config('rajaongkir.origin.type'), // 'subdistrict' atau 'city'
                'destination'     => $ids['subdistrict_id'] ?? $ids['city_id'],
                // 'destinationType' => $ids['subdistrict_id'] ? 'subdistrict' : 'city',
                'weight'          => 1000, // 1kg (gram)
                'courier'         => config('rajaongkir.default_couriers'),
            ];

            $res = $ro->cost($payload);
            // normalisasi ke list opsi
            $this->shippingOptions = collect(data_get($res, 'rajaongkir.results', data_get($res, 'data', [])))
                ->flatMap(function ($kurir) {
                    $code = $kurir['code'] ?? ($kurir['courier'] ?? '');
                    $name = $kurir['name'] ?? strtoupper($code);
                    $costs = $kurir['costs'] ?? ($kurir['services'] ?? []);
                    return collect($costs)->map(function ($svc) use ($code, $name) {
                        $c0 = $svc['cost'][0] ?? $svc['costs'][0] ?? [];
                        return [
                            'courier_code' => $code,
                            'courier_name' => $name,
                            'service'      => $svc['service'] ?? ($svc['service_code'] ?? ''),
                            'description'  => $svc['description'] ?? '',
                            'value'        => (int)($c0['value'] ?? $c0['price'] ?? 0),
                            'etd'          => $c0['etd'] ?? $c0['etd_text'] ?? null,
                            'note'         => $c0['note'] ?? null,
                        ];
                    });
                })->values()->all();

        } catch (\Throwable $e) {
            // gagal resolve/hit → biarkan kosong dan jangan ganggu checkout
            logger()->warning('Load shipping options failed: '.$e->getMessage());
            $this->shippingOptions = [];
        }

        // total ulang (shipping masih 0 jika belum pilih)
        $this->calculateTotals();
    }


    public function loadProductCarts()
    {
        $this->products = $this->transactionService->findByTrxNumber($this->trx);
    }

    public function loadVouchers()
    {
        $user = Auth::user();
        $this->vouchers = $this->voucherService->getVouchersUser($user->id, $this->grand_total);
    }

    public function redirectWhenSuccessCheckout()
    {
        $invoiceUrl = $this->checkout();
        return redirect()->away($invoiceUrl);
    }

    public function loadShippingJnt(): void
    {
        $this->shippingOptions = [];
        $this->shipping_price = 0; 

        $sel = $this->selected_address_id ? collect($this->addresses)->firstWhere('id', $this->selected_address_id) : null;
        if (!$sel) {
            $this->calculateTotals();
            return;
        }
        try {
            $ids = $this->locationService->resolveIdsFromNames(
                (string)($sel['province'] ?? ''),
                (string)($sel['city'] ?? ''),
                (string)($sel['district'] ?? ''),
                (string)($sel['subdistrict'] ?? '')
            );

            /** @var \App\Services\RajaOngkirClient $ro */
            $ro = app(\App\Services\RajaOngkirClient::class);

            $payload = [
                'origin'          => (int) config('rajaongkir.origin_district_id'),   // dari .env
                // 'originType'      => config('rajaongkir.origin.type'), // 'subdistrict' atau 'city'
                'destination'     => $ids['district_id'],
                // 'destinationType' => $ids['subdistrict_id'] ? 'subdistrict' : 'city',
                'weight'          => 1000, // 1kg (gram)
                'courier'         => config('rajaongkir.default_couriers'),
                'price' => 'lowest'
            ];

            $res = $ro->cost($payload);
            $services = collect(data_get($res, 'data', []))
                ->map(function ($svc) {
                    return [
                        "name" => $svc['name'],
                        "code" => $svc['code'],
                        "service" => $svc['service'],
                        "description" => $svc['description'],
                        "cost" => $svc['cost'],
                        "etd" => $svc['etd'],
                    ];
                })->all();
            // pilih yg termurah (atau service default misal REG)
            if (!empty($services)) {
                $picked = collect($services)->sortBy('cost')->first();
                $this->shipping_price   = $picked['cost'];
                $this->shipping_service = $picked['service'];
                $this->shipping_courier = 'jnt';
                $this->shipping_etd     = $picked['etd'] ?? null;
            }

        } catch (\Throwable $e) {
            logger()->warning('Load JNT shipping failed: '.$e->getMessage());
            $this->shipping_price = 0;
        }

        $this->calculateTotals();
    }


    public function checkout()
    {
        // 1) Simpan alamat ke transaksi (dari address book terpilih / form baru)
        $this->createTransactionAddress();

        // 2) Update transaksi → PENDING & nilai
        $this->updateTransaction($this->trx);

        // 3) Buat invoice Xendit via service (SDK v3)
        /** @var \App\Services\XenditInvoiceService $xendit */
        $xendit = app(XenditInvoiceService::class);

        $externalId = $this->trx;

        $invoice = $xendit->create([
            'external_id'          => $externalId,
            'amount'               => (int) $this->grand_total, // rupiah (integer)
            'description'          => "Pembayaran transaksi #{$this->trx}",
            'payer_email'          => $this->address_form->email ?? null,
            'currency'             => config('xendit.currency', 'IDR'),
            'success_redirect_url' => route('products.checkout.success'),
            'failure_redirect_url' => route('products.checkout.failed'),
            'customer'             => [
                'given_names' => trim(($this->address_form->first_name ?? '') . ' ' . ($this->address_form->last_name ?? '')),
                'email'       => $this->address_form->email,
            ],
        ]);

        // 4) Simpan id & url invoice ke transaksi
        $data = [
            'sub_total'          => $this->sub_total,
            'shipping_price'     => $this->shipping_price,
            'tax_price'          => $this->tax,
            'discount_price'     => $this->discount,
            'grand_total'        => $this->grand_total,
            'proceed_at'         => now(),
            'transaction_status' => 'PENDING',
        ];

        if ($this->voucher) {
            $data['voucher_id'] = $this->voucher->id;
        }

        $this->transactionService->updateByTrxNumber($this->trx, $data);

        $tx = Transaction::where('transaction_number', $this->trx)->first();

        Order::create([
            'external_id'       => $externalId,
            'customer_name'     => $this->address_form->first_name,
            'customer_email'    => $this->address_form->email,
            'amount'            => $this->grand_total,
            'currency'          => "IDR",
            'status'            => "PENDING",
            'xendit_invoice_id' => $invoice['id'],
            'xendit_invoice_url'=> $invoice['invoice_url'],
            'transaction_id'    => $tx->id,
        ]);

        // 5) Kurangi stok saat webhook PAID saja
        return $invoice['invoice_url'];
    }

    private function createTransactionAddress(): void
    {
        $currentTransaction = Transaction::where('transaction_number', $this->trx)->first();

        // Jika user memilih alamat dari address book → pakai itu
        if ($this->selected_address_id) {
            $sel = collect($this->addresses)->firstWhere('id', $this->selected_address_id);
            if ($sel) {
                $payload = $this->mapAddressBookToTransaction($sel);
                $this->transactionAddressService->createAddress(array_merge($payload, [
                    'transaction_id' => $currentTransaction->id,
                ]));
                return;
            }
        }

        // Kalau tidak memilih address book → pakai form transaksi sekarang
        $this->transactionAddressService->createAddress([
            'transaction_id' => $currentTransaction->id,
            'first_name'     => $this->address_form->first_name,
            'last_name'      => $this->address_form->last_name,
            'address'        => $this->address_form->address,
            'province'       => $this->address_form->province,
            'city'           => $this->address_form->city,
            'postal_code'    => $this->address_form->postal_code,
            'email'          => $this->address_form->email,
            'phone'          => $this->address_form->phone,
            'description'    => $this->address_form->description,
        ]);

        // Jika user centang "Simpan alamat" → simpan juga ke address book (BUKAN update kolom users)
        if ($this->is_store) {
            $storeData = $this->mapTransactionFormToBook([
                'first_name'  => $this->address_form->first_name,
                'last_name'   => $this->address_form->last_name,
                'address'     => $this->address_form->address,
                'province'    => $this->address_form->province,
                'city'        => $this->address_form->city,
                'postal_code' => $this->address_form->postal_code,
                'email'       => $this->address_form->email,
                'phone'       => $this->address_form->phone,
                'description' => $this->address_form->description,
            ]);

            $saved = $this->addressService->save(Auth::id(), $storeData);

            // refresh list + set terpilih ke alamat yang baru disimpan
            $this->reloadAddresses();
            $this->selected_address_id = $saved->id;
        }
    }

    private function mapAddressBookToTransaction(array $addr): array
    {
        // mapping standar utk tabel alamat transaksi
        $parts = preg_split('/\s+/', trim((string)($addr['recipients_name'] ?? '')), 2);
        $first = $parts[0] ?? '';
        $last  = $parts[1] ?? '';

        return [
            'first_name'   => $first,
            'last_name'    => $last,
            'address'      => $addr['address'] ?? '',
            'province'     => $addr['province'] ?? '',
            'city'         => $addr['city'] ?? '',
            'postal_code'  => $addr['postal_code'] ?? '',
            'email'        => Auth::user()?->email, // book tidak simpan email
            'phone'        => $addr['recipients_phone'] ?? '',
            'description'  => $addr['additional_address'] ?? null,
        ];
    }

    private function mapTransactionFormToBook(array $f): array
    {
        $label = 'Alamat';
        // simple guess: pakai city sebagai label tambahan
        if (!empty($f['city'])) {
            $label = 'Alamat ' . $f['city'];
        }

        return [
            'id'                 => null,
            'title_address'      => $label,
            'recipients_name'    => trim(($f['first_name'] ?? '') . ' ' . ($f['last_name'] ?? '')),
            'recipients_phone'   => $f['phone'] ?? '',
            'address'            => $f['address'] ?? '',
            'additional_address' => $f['description'] ?? null,
            'city'               => $f['city'] ?? '',
            'province'           => $f['province'] ?? '',
            'postal_code'        => $f['postal_code'] ?? '',
            'is_main'            => false,
        ];
    }

    private function updateTransaction(string $transaction_number)
    {
        $data = [
            'sub_total'          => $this->sub_total,
            'shipping_price'     => $this->shipping_price,
            'tax_price'          => $this->tax,
            'discount_price'     => $this->discount,
            'grand_total'        => $this->grand_total,
            'proceed_at'         => now(),
            'transaction_status' => 'PENDING', // set COMPLETED saat webhook
        ];

        if ($this->voucher) {
            $data['voucher_id'] = $this->voucher->id;
        }

        $this->transactionService->updateByTrxNumber($transaction_number, $data);
    }

    public function cancelTransaction()
    {
        DB::transaction(function () {
            $this->transactionService->deleteByTransactionNumber($this->trx);
        });

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.pages.checkout-product');
    }
}
