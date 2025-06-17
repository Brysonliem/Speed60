<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ProductRadioFilter extends Component
{


    public array $vehicles = [];

    public function mount(array $images = []) 
    {
        $this->vehicles = [
            [
                "id" => "1",
                "url" => "/images/assets/vehicles/nm.jpg",
                "label" => "N-MAX",
                "value" => "nmax",
                "route" => "products.index"
            ],
            [
                "id" => "2",
                "url" => "/images/assets/vehicles/mio.png",
                "label" => "Mio M3",
                "value" => "mio-m3",
                "route" => "products.index"
            ],
            [
                "id" => "3",
                "url" => "/images/assets/vehicles/pcx.png",
                "label" => "PCX 160",
                "value" => "pcx-160",
                "route" => "products.index"
            ],
            [
                "id" => "4",
                "url" => "/images/assets/vehicles/rx_king.png",
                "label" => "Rx-King",
                "value" => "rx-king",
                "route" => "products.index"
            ],
            [
                "id" => "5",
                "url" => "/images/assets/vehicles/satria.png",
                "label" => "Satria FU",
                "value" => "satria-fu",
                "route" => "products.index"
            ],
            [
                "id" => "6",
                "url" => "/images/assets/vehicles/vario.png",
                "label" => "Vario 160",
                "value" => "vario-160",
                "route" => "products.index"
            ]
        ];
    }

    public function render()
    {
        return view('livewire.components.product-radio-filter');
    }
}
