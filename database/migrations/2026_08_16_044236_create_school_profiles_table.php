<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration (Membuat tabel).
     */
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id(); // Primary Key (ID 1)
            $table->string('school_name');
            $table->string('headmaster_name');
            $table->string('headmaster_photo')->nullable(); // Boleh kosong jika belum ada foto
            $table->text('headmaster_welcome'); // text digunakan karena isinya panjang
            $table->text('vision');
            $table->text('mission');
            $table->text('history');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->timestamps(); // create_at & updated_at
        });
    }

    /**
     * Membatalkan migration (Menghapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};