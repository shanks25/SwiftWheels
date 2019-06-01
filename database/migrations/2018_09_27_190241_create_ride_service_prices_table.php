<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_service_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ride_type_id');
            $table->integer('service_type_id');
            $table->integer('fixed');
            $table->integer('price');
            $table->integer('minute');
            $table->integer('distance');
            $table->integer('max_distance');
            $table->integer('max_distance_price');
            $table->enum('calculator', ['MIN', 'HOUR', 'DISTANCE', 'DISTANCEMIN', 'DISTANCEHOUR']);
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
        Schema::dropIfExists('ride_service_prices');
    }
}
