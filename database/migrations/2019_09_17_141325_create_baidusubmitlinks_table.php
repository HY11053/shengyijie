<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaidusubmitlinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baidusubmitlinks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('remain')->default(0);
            $table->integer('success')->default(0);
            $table->integer('success_realtime')->default(0);
            $table->integer('remain_realtime')->default(0);
            $table->string('type')->nullable();
            $table->integer('error')->default(0);
            $table->integer('mid')->default(0);
            $table->string('message')->nullable();
            $table->string('url')->nullable();
            $table->index('remain');
            $table->index('success');
            $table->index('success_realtime');
            $table->index('remain_realtime');
            $table->index('type');
            $table->index('mid');
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
        Schema::dropIfExists('baidusubmitlinks');
    }
}
