<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIspushToBrandarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brandarticles', function (Blueprint $table) {
            $table->integer('ispush')->default(0);
            $table->index('ispush');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brandarticles', function (Blueprint $table) {
            $table->dropColumn(['ispush']);
        });
    }
}
