<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services__workflow', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->string('description',500);
            //$table->nestedSet();
            \Kalnoy\Nestedset\NestedSet::columns($table);
            $table->index('parent_id', 'parent');
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
        Schema::dropIfExists('workflow');
    }
}
