<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    public function up()
{
    Schema::create('administrators', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('role')->default('admin');
        $table->timestamps();
    });

    // Dodanie domyślnego administratora
    $userId = DB::table('users')->insertGetId([
        'nick' => 'admin',
        'password' => Hash::make('admin'),
        'profile_picture_url' => null,
        'description' => 'Domyślny administrator',
        'joined_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('administrators')->insert([
        'user_id' => $userId,
        'role' => 'super_admin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}

