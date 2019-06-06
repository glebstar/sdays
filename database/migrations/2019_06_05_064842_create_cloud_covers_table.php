<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloudCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloud_covers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->date('date');
            $table->float('value');
            $table->index(['city_id']);
            $table->index(['date']);
            $table->index(['value']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cloud_covers');
    }
}
