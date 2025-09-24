<?php

return [
    'base_url' => env('RAJAONGKIR_BASE_URL'),
    'cost_key' => env('SHIPPING_COST_RAJAONGKIR_API_KEY'),
    'waybill_key' => env('SHIPPING_DELIVERY_RAJAONGKIR_API_KEY'),
    'default_couriers' => 'jnt',
    'origin_id' => env("ORIGIN_SUBDISTRICT_ID"),
    'origin_district_id' => env("ORIGIN_DISTRICT_ID"),
    'origin_city_id' => env("ORIGIN_CITY_ID"),
];