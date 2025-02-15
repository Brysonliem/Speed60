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
            $table->string('email')->nullable()->change();
            $table->string('username')->nullable()->after('name')->change();
            $table->string('phone_number')->nullable()->after('email')->change();
            $table->text('address')->nullable()->after('phone_number')->change();
            $table->string('province')->nullable()->after('address')->change();
            $table->string('city')->nullable()->after('province')->change();
            $table->string('district')->nullable()->after('city')->change();
            $table->string('rt')->nullable()->after('block')->change();
            $table->string('rw')->nullable()->after('rt')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
