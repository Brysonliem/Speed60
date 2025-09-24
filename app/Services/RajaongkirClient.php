<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirClient
{
    private string $base;
    private string $costKey;
    private string $waybillKey;

    public function __construct()
    {
        $this->base = config('rajaongkir.base_url');
        $this->costKey = config('rajaongkir.cost_key');
        $this->waybillKey = config('rajaongkir.waybill_key');
    }

    private function headers(string $type = 'cost'): array
    {
        return ['key' => $type === 'waybill' ? $this->waybillKey : $this->costKey];
    }

    // --- Lokasi (boleh di-cache) ---
    public function provinces()
    {
        return cache()->remember('raja.provinces', now()->addDays(7), function () {
            return Http::withHeaders($this->headers())
                ->get("{$this->base}/destination/province")
                ->throw()->json();
        });
    }

    public function cities(?string $provinceId = null)
    {
        $key = "raja.cities.$provinceId";
        return cache()->remember($key, now()->addDays(7), function () use ($provinceId) {
            return Http::withHeaders($this->headers())
                ->get("{$this->base}/destination/city/{$provinceId}", array_filter(['province' => $provinceId]))
                ->throw()->json();
        });
    }

    public function districts(string $cityId)
    {
        $key = "raja.districts.$cityId";
        return cache()->remember($key, now()->addDays(7), function () use ($cityId) {
            return Http::withHeaders($this->headers())
                ->get("{$this->base}/destination/district/{$cityId}", ['city' => $cityId])
                ->throw()->json();
        });
    }

    public function subdistricts(string $districtId)
    {
        $key = "raja.subdistricts.$districtId";
        return cache()->remember($key, now()->addDays(7), function () use ($districtId) {
            return Http::withHeaders($this->headers())
                ->get("{$this->base}/destination/sub-district/{$districtId}", ['city' => $districtId])
                ->throw()->json();
        });
    }

    // --- Hitung ongkir (REAL-TIME) ---
    public function cost(array $payload)
    {
        // dd($payload);
        return Http::withHeaders($this->headers())
            ->asForm()
            ->post("{$this->base}/calculate/district/domestic-cost", $payload)
            ->throw()
            ->json();
    }

    // --- Tracking resi ---
    public function waybill(string $awb, string $courier)
    {
        return Http::withHeaders($this->headers('waybill'))
            ->asForm()
            ->post("{$this->base}/waybill", [
                'waybill' => $awb,
                'courier' => $courier,
            ])->throw()->json();
    }
}
