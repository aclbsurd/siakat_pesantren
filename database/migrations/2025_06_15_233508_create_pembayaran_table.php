<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel santri. Jika santri dihapus, pembayarannya juga terhapus.
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            
            // Foreign key ke tabel users. Jika admin dihapus, datanya di-set ke NULL.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('jenis_pembayaran');
            $table->string('bulan_pembayaran')->nullable();
            $table->integer('jumlah_bayar');
            $table->date('tanggal_bayar');
            $table->enum('status', ['Lunas', 'Belum Lunas', 'Cicil'])->default('Lunas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};