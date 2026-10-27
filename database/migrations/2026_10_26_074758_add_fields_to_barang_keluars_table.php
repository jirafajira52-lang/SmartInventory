
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            if (!Schema::hasColumn('barang_keluars', 'barang_id')) {
                $table->unsignedBigInteger('barang_id')->nullable();
            }

            if (!Schema::hasColumn('barang_keluars', 'jumlah')) {
                $table->unsignedInteger('jumlah')->default(0);
            }

            if (!Schema::hasColumn('barang_keluars', 'tanggal_keluar')) {
                $table->date('tanggal_keluar')->nullable();
            }

            if (!Schema::hasColumn('barang_keluars', 'keterangan')) {
                $table->string('keterangan')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Tidak menghapus kolom yang sudah ada.
    }
};
