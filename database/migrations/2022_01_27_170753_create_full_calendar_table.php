<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_calendar', function (Blueprint $table) {

            $table->id();
            $table->string('title', 1000);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color')->nullable();
            $table->string('textColor')->nullable();

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
        Schema::dropIfExists('full_calendar');
    }
}
