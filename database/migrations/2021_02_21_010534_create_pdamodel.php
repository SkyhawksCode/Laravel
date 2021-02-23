<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdamodel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdas', function (Blueprint $table) {
            $table->id();
            $table->string('wifimac');
            $table->string('pdaname');
            $table->string('description');
            $table->date('purchaseddate');
            $table->string('reference');
            $table->integer('batterylevel');
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
        Schema::dropIfExists('pdas');
    }
}
