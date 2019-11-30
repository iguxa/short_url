<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesServicesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__services_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('services_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['services_id', 'locale']);
            $table->foreign('services_id')->references('id')->on('services__services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services__services_translations', function (Blueprint $table) {
            $table->dropForeign(['services_id']);
        });
        Schema::dropIfExists('services__services_translations');
    }
}
