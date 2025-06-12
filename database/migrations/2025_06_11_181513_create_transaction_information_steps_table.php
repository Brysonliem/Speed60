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
        Schema::create('transaction_information_steps', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('order');
            $table->string('title');
            $table->datetime('confirmed_at');
            $table->foreignId('pic_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_information_steps');
    }
};
