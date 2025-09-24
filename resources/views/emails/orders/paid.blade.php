@component('mail::message')
# Pembayaran Berhasil

Halo **{{ $user->name }}**, pembayaran untuk pesanan **{{ $code }}** sudah kami terima.

- **Kode Pesanan:** {{ $code }}
- **Total Bayar:** Rp {{ number_format($amount, 0, ',', '.') }}
@if($method)
- **Metode:** {{ $method }}
@endif

@component('mail::button', ['url' => url('/orders/'.$code)])
Lihat Detail Pesanan
@endcomponent

Terima kasih sudah berbelanja di {{ config('app.name') }}!
@endcomponent
