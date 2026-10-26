
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agens', function (Blueprint $table) {
            $table->id('id_agen');
            $table->string('nama_agen', 100);
            $table->string('alamat', 255)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agens');
    }
};
