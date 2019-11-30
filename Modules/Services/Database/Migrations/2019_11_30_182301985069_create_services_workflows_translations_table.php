<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesWorkFlowsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__workflows_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('workflows_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['workflows_id', 'locale']);
            $table->foreign('workflows_id')->references('id')->on('services__workflows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services__workflows_translations', function (Blueprint $table) {
            $table->dropForeign(['workflows_id']);
        });
        Schema::dropIfExists('services__workflows_translations');
    }
}
