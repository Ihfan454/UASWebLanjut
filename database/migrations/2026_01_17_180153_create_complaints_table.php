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
    Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('nim');
        $table->string('email');
        $table->string('phone');
        $table->enum('category', ['Kebersihan', 'Fasilitas Rusak', 'Keamanan', 'Layanan', 'Lainnya']);
        $table->string('location');
        $table->text('description');
        $table->string('photo')->nullable();
        $table->enum('status', ['Pending', 'Diproses', 'Selesai'])->default('Pending');
        $table->enum('priority', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
        $table->timestamps();
    });
}
};
