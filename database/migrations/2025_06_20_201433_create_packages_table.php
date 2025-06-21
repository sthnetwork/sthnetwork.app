<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // contoh: TurboConnect
            $table->integer('kecepatan'); // Mbps
            $table->integer('harga'); // harga bulanan
            $table->integer('durasi')->default(30); // durasi hari (default 30 hari)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

