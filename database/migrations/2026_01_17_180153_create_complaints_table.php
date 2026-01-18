<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->string('email');
            $table->string('phone');

            $table->enum('category', ['wifi', 'ac', 'kebersihan', 'listrik', 'lainnya']);

            $table->string('location');
            $table->text('description');
            $table->string('photo')->nullable();

            $table->enum('status', ['baru', 'proses', 'selesai'])->default('baru');
            $table->enum('priority', ['rendah', 'sedang', 'tinggi'])->default('sedang');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
