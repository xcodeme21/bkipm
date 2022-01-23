<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEksporFrekuensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekspor_frekuensi', function (Blueprint $table) {
            $table->id();
            $table->integer('ekspor_id')->default(0);
            $table->bigInteger('frekuensi')->default(0);
            $table->year('tahun')->default('2000');
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
        Schema::dropIfExists('ekspor_frekuensi');
    }
}
