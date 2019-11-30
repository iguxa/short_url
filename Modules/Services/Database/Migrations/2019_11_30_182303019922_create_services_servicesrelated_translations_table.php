<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesServicesRelatedTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__servicesrelated_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('servicesrelated_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['servicesrelated_id', 'locale']);
            $table->foreign('servicesrelated_id')->references('id')->on('services__servicesrelateds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services__servicesrelated_translations', function (Blueprint $table) {
            $table->dropForeign(['servicesrelated_id']);
        });
        Schema::dropIfExists('services__servicesrelated_translations');
    }
}
