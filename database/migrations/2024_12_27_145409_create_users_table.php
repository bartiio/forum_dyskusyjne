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
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // Automatyczne ID
        $table->string('nick')->unique(); // Unikalna nazwa użytkownika
        $table->string('profile_picture_url')->nullable(); // URL zdjęcia profilowego
        $table->text('description')->nullable(); // Opis użytkownika
        $table->timestamp('joined_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Data dołączenia
        $table->string('password'); // Hasło użytkownika
        $table->rememberToken(); // Token zapamiętania
        $table->timestamps(); // Znaczniki czasu (created_at, updated_at)
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
