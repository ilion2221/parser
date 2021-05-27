<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casts', function (Blueprint $table) {
            $table->id();
            $table->string('imdb_name_id')->nullable($value = true);;
            $table->string('name')->index();;
            $table->string('height')->nullable($value = true);;
            $table->text('bio')->nullable($value = true);;
            $table->string('data_of_birth')->nullable($value = true);;
            $table->string('place_of_birth')->nullable($value = true);;
            $table->integer('children')->nullable($value = true);;
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
        Schema::dropIfExists('casts');
    }
}
