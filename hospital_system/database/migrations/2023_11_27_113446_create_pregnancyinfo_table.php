<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancyinfo', function (Blueprint $table) {
            $table->string('patientnumber');
            $table->integer('Duration');
            $table->date('checkindate')->nullable();
            $table->date('checkoutdate')->nullable();
            $table->string('ward');
            $table->integer('bedNo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnancyinfo');
    }
};
