<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShorturlShortUrlTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shorturl__shorturl_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('shorturl_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['shorturl_id', 'locale']);
            $table->foreign('shorturl_id')->references('id')->on('shorturl__shorturls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shorturl__shorturl_translations', function (Blueprint $table) {
            $table->dropForeign(['shorturl_id']);
        });
        Schema::dropIfExists('shorturl__shorturl_translations');
    }
}
