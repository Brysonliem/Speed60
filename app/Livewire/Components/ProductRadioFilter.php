<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ProductRadioFilter extends Component
{


    public array $vehicles = [];

    public function mount(array $images = []) 
    {
        // Redirect default sesuai role

        // Tambahkan dashboard sebagai default breadcrumb pertama

        $this->vehicles = [
            [
                "id" => "1",
                "url" => "/images/assets/vehicles/nm.jpg",
                "label" => "N-MAX",
                "value" => "NMAX",
                "route" => "products.index"
            ],
            [
                "id" => "2",
                "url" => "/images/assets/vehicles/mio.png",
                "label" => "Mio",
                "value" => "2",
                "route" => "products.index"
            ],
            [
                "id" => "3",
                "url" => "/images/assets/vehicles/pcx.png",
                "label" => "PCX",
                "value" => "3",
                "route" => "products.index"
            ],
            [
                "id" => "4",
                "url" => "/images/assets/vehicles/rx_king.png",
                "label" => "Rx-King",
                "value" => "4",
                "route" => "products.index"
            ],
            [
                "id" => "5",
                "url" => "/images/assets/vehicles/satria.png",
                "label" => "Satria FU",
                "value" => "5",
                "route" => "products.index"
            ],
            [
                "id" => "6",
                "url" => "/images/assets/vehicles/vario.png",
                "label" => "Vario",
                "value" => "6",
                "route" => "products.index"
            ]
        ];
    }

    public function render()
    {
        return view('livewire.components.product-radio-filter');
    }
}
