
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->unsignedInteger('jumlah')->default(0);
            $table->date('tanggal_keluar')->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->dropColumn([
                'barang_id',
                'jumlah',
                'tanggal_keluar',
                'keterangan',
            ]);
        });
    }
};
