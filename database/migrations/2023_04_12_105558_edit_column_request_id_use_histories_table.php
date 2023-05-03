<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnRequestIdUseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_histories', function (Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_histories', function (Blueprint $table) {
            $table->dropColumn('request_id');
        });
    }
}
