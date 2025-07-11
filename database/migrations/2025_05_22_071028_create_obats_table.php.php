<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\callback;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema:: create('obats',callback: function (Blueprint $table):void{
            $table->id();
            $table->string('nama_obat');
            $table->string('kemasan');
            $table->integer('harga');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('obats', function (Blueprint $table) {
        $table->dropSoftDeletes();
        });
    }
};
