<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shorturl__short_url', function (Blueprint $table) {
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_descriptions', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('shorturl__short_url', 'meta_title')) {
            Schema::table('shorturl__short_url', function (Blueprint $table) {
                $table->dropColumn('meta_title');
                $table->dropColumn('meta_descriptions');
            });
        }
    }
}
