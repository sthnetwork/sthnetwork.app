<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mikrotiks', function (Blueprint $table) {
            $table->id();
            $table->string('router_name');
            $table->string('ip_address');
            $table->integer('port_api')->default(8728);
            $table->string('username');
            $table->text('password');
            $table->string('cluster')->nullable();
            $table->enum('site_type', ['pppoe', 'hotspot', 'core', 'vpn'])->default('pppoe');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mikrotiks');
    }
};

