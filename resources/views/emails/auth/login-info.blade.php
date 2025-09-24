@component('mail::message')
# Login Berhasil

Halo **{{ $user->name }}**, ada aktivitas login ke akunmu.

- **Waktu**: {{ $when }}
- **IP**: {{ $ip }}
- **Perangkat/Browser**: {{ $agent }}

Jika ini bukan kamu, segera ubah password.

Terima kasih,  
{{ config('app.name') }}
@endcomponent
