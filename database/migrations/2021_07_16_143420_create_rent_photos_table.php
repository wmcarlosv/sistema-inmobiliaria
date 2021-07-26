<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rent_id');
            $table->string('url', 100)->nullable(false);
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_photos');
    }
}
