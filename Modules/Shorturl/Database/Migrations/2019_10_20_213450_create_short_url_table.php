<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shorturl__short_url', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->string('description',500);
            $table->string('redirect',500);
            $table->integer('counter')->default(0);
            $table->integer('state')->default(0);
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
        if (Schema::hasColumn('shorturl__visitors', 'short_url_id')) {
            Schema::table('shorturl__visitors', function (Blueprint $table) {
                $table->dropForeign('shorturl__visitors_short_url_id_foreign');
            });
        }
        Schema::dropIfExists('shorturl__short_url');
    }
}
