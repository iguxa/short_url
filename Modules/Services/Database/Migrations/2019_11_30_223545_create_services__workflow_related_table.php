<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesWorkflowRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__workflow_related', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workflow_id', false, true);
            $table->integer('related_workflow_id', false, true);
            $table->foreign('workflow_id')->references('id')->on('services__workflow')->onDelete('cascade');
            $table->foreign('related_workflow_id')->references('id')->on('services__workflow')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services__workflow_related');
    }
}
