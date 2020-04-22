<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNewsAddResourceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('recourse_id')->default('1');
            $table->foreign('recourse_id')
                ->references('id')
                ->on('resources')
                ->onDelete('cascade');;
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropforeign(['recourse_id']);
            $table->dropColumn(['recourse_id']);

        });
    }
}
