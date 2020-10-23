<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandcontainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brandcontainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('type');
            $table->integer('status');
            $table->integer('num');
            $table->string('url');
            $table->string('referer');
            $table->index('brand');
            $table->index('type');
            $table->index('status');
            $table->index('num');
            $table->index('referer');
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
        Schema::dropIfExists('brandcontainers');
    }
}
