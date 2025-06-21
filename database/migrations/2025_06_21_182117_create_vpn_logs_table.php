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
    Schema::create('vpn_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vpn_account_id')->constrained()->onDelete('cascade');
        $table->string('action'); // created, updated, deleted, disconnected
        $table->string('ip_address')->nullable(); // optional
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vpn_logs');
    }
};
