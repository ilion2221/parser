<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('imdp_title_id')->nullable($value = true);
            $table->string('title')->nullable($value = true);
            $table->string('duration')->nullable($value = true);
            $table->mediumText('description')->nullable($value = true);
            $table->double('avg_vote')->nullable($value = true);
            $table->integer('votes')->nullable($value = true);
            $table->string('year')->nullable($value = true);
            $table->string('decade')->nullable($value = true);
            $table->string('reviews_from_users')->nullable($value = true);
            $table->string('reviews_from_critics')->nullable($value = true);
            $table->boolean('is_top')->nullable($value = true);
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
        Schema::dropIfExists('movies');
    }
}
