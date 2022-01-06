<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_provinsi', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_usaha_id')->default(0);
            $table->integer('provinsi_id')->default(0);
            $table->integer('jenis_ikan_id')->default(0);
            $table->year('tahun')->default('2000');
            $table->bigInteger('volume_produksi')->default(0);
            $table->bigInteger('nilai_produksi')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pp_provinsi');
    }
}
