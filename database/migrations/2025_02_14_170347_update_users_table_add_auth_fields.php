<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('phone_number')->after('email');
            $table->text('address')->after('phone_number');
            $table->string('province')->after('address');
            $table->string('city')->after('province');
            $table->string('district')->after('city');
            $table->string('block')->nullable()->after('district');
            $table->string('rt')->after('block');
            $table->string('rw')->after('rt');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 'phone_number', 'address', 'province',
                'city', 'district', 'block', 'rt', 'rw'
            ]);
        });
    }
};
