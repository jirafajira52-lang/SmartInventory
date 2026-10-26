
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->id('id_distributor');
            $table->string('nama_distributor', 100);
            $table->string('alamat', 255)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distributors');
    }
};
