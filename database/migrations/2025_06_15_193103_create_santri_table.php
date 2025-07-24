<?php

// Lokasi: database/migrations/xxxx_xx_xx_xxxxxx_create_santri_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 50)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('no_telepon_wali', 20)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->enum('status', ['Aktif', 'Lulus', 'Berhenti'])->default('Aktif');

            // Kolom untuk Foreign Key ke tabel 'kelas'
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};