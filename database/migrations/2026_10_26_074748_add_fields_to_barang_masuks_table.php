
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            if (!Schema::hasColumn('barang_masuks', 'barang_id')) {
                $table->unsignedBigInteger('barang_id')->nullable();
            }

            if (!Schema::hasColumn('barang_masuks', 'jumlah')) {
                $table->unsignedInteger('jumlah')->default(0);
            }

            if (!Schema::hasColumn('barang_masuks', 'tanggal_masuk')) {
                $table->date('tanggal_masuk')->nullable();
            }

            if (!Schema::hasColumn('barang_masuks', 'keterangan')) {
                $table->string('keterangan')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Tidak menghapus kolom agar data tetap aman.
    }
};
