<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->id();

            $table->string('valuteID', 10);
            $table->unsignedInteger('numCode');
            $table->string('сharCode', 5);
            $table->string('name');
            $table->unsignedDecimal('value', 10, 4);

            $table->dateTime('date');
            $table->dateTime('updated_at');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curencies');
    }
}
