<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesLifeCircleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__lifecircle_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('lifecircle_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['lifecircle_id', 'locale']);
            $table->foreign('lifecircle_id')->references('id')->on('services__lifecircles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services__lifecircle_translations', function (Blueprint $table) {
            $table->dropForeign(['lifecircle_id']);
        });
        Schema::dropIfExists('services__lifecircle_translations');
    }
}
