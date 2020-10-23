<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEditorToBrandarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brandarticles', function (Blueprint $table) {
            $table->string('editor')->nullable();
            $table->integer('editor_id')->default(0);
            $table->timestamp('received_at')->nullable();
            $table->index('editor');
            $table->index('editor_id');
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
            $table->dropColumn(['editor','editor_id','received_at']);
        });
    }
}
