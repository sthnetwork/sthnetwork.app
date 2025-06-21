<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();

            $table->unsignedBigInteger('mikrotik_id');
            $table->string('cluster');
            $table->string('paket');
            $table->integer('harga_paket')->nullable();

            $table->string('username_pppoe')->unique();
            $table->string('password_pppoe');

            $table->string('onu_serial')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // $table->foreign('mikrotik_id')->references('id')->on('mikrotiks')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('customers');
    }
};
