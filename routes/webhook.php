<?php

use App\Http\Controllers\XenditWebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken; // <- ini yang dipakai di L11

Route::post('/webhooks/xendit/invoice', [XenditWebhookController::class, 'invoice'])
    ->withoutMiddleware([ValidateCsrfToken::class])
    ->name('webhooks.xendit.invoice');
