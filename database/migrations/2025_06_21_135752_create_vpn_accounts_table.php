<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('vpn_accounts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mikrotik_id')->nullable(); // bisa null dulu
        $table->string('username')->unique();
        $table->string('password');
        $table->string('ip_address')->nullable(); // IP hasil dial L2TP
        $table->enum('vpn_type', ['L2TP', 'PPTP', 'SSTP'])->default('L2TP');
        $table->text('script')->nullable(); // script Mikrotik
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();

        $table->foreign('mikrotik_id')->references('id')->on('mikrotiks')->onDelete('set null');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vpn_accounts');
    }
};
