<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::table('orders', function (Blueprint $t) {
            $t->timestamp('paid_notified_at')->nullable()->index();
        });
    }
    public function down(): void {
        Schema::table('orders', function (Blueprint $t) {
            $t->dropColumn('paid_notified_at');
        });
    }
};
