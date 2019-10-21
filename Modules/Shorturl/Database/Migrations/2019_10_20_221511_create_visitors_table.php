<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shorturl__visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',500);
            $table->json('server');
            $table->integer('short_url_id',false, true);
            $table->integer('counter')->default(0);
            $table->timestamps();
            $table->foreign('short_url_id')->references('id')->on('shorturl__short_url')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shorturl__visitors');
    }
}
