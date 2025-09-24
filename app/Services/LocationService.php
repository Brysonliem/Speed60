<?php

namespace App\Services;

use App\Services\RajaOngkirClient;

class LocationService
{
    public function __construct(private RajaOngkirClient $ro) {}

    public function provinces(): array
    {
        $rows = data_get($this->ro->provinces(), 'data', []);
        return array_map(fn($r) => [
            'id'   => (int)$r['id'],
            'name' => $r['name'],
        ], $rows);
    }

    public function cities(int $provinceId): array
    {
        $rows = data_get($this->ro->cities($provinceId), 'data', []);
        // kalau API sudah gabungkan type di name, kita langsung pakai 'name'
        return array_map(fn($r) => [
            'id'   => (int)$r['id'],
            'name' => $r['name'],   // contoh: "KOTA TANGERANG" atau "KABUPATEN TANGERANG"
        ], $rows);
    }

    public function districts(int $cityId): array
    {
        $rows = data_get($this->ro->districts($cityId), 'data', []);
        return array_map(fn($r) => [
            'id'   => (int)$r['id'],
            'name' => $r['name'],
        ], $rows);
    }

    public function subdistricts(int $districtId): array
    {
        $rows = data_get($this->ro->subdistricts($districtId), 'data', []);
        return array_map(fn($r) => [
            'id'   => (int)$r['id'],
            'name' => $r['name'],
            'zip'  => $r['zip_code'] ?? ($r['postal_code'] ?? ''),
        ], $rows);
    }

    private function normalize($s) {
        return strtoupper(preg_replace('/\s+/', '', $s ?? ''));
    }

    public function resolveIdsFromNames(string $provinceName, string $cityName, string $districtName, string $subdistrictName): array
    {
        // dd([
        //     'province' => $provinceName,
        //     'city' => $cityName,
        //     'district' => $districtName,
        //     'subdistrict' => $subdistrictName,
        // ]);
        $prov = collect($this->provinces())->first(fn($p) => $this->normalize($p['name']) === $this->normalize($provinceName));
        if (!$prov) throw new \RuntimeException('Province not found');

        $cities = $this->cities($prov['id']);
        $city = collect($cities)->first(fn($c) => $this->normalize($c['name']) === $this->normalize($cityName));
        if (!$city) throw new \RuntimeException('City not found');

        $dists = $this->districts($city['id']);
        $dist = collect($dists)->first(fn($d) => $this->normalize($d['name']) === $this->normalize($districtName));
        if (!$dist) throw new \RuntimeException('District not found');

        $subs = $this->subdistricts($dist['id']);
        $sub  = collect($subs)->first(fn($s) => $this->normalize($s['name']) === $this->normalize($subdistrictName));
        if (!$sub) throw new \RuntimeException('Subdistrict not found');
        return [
            'province_id'   => $prov['id'],
            'city_id'       => $city['id'],
            'district_id'   => $dist['id'],
            'subdistrict_id'=> $sub['id'],
            'postal_code'   => $sub['zip'] ?? null,
        ];
    }
}
