<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            // $table->id();
            $table->string('user_id');
            $table->string('city_search'); // ten cua thanh pho dc tra cuu
            $table->string('city_lat');
            $table->string('city_lon');
            //  tao mot ham getWeather moi khi truy van thanh pho va tra ve
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
        Schema::dropIfExists('search_histories');
    }
}
