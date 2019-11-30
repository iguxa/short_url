<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__services', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->string('title',100);
            $table->string('description',500);
            $table->integer('workflow_id',false, true);
            $table->integer('state',false, true);
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
        Schema::dropIfExists('services');
    }
}
