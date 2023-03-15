<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('request_id')->change();
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
            if (Schema::hasColumn('use_histories', 'request_id')){
                Schema::table('use_histories', function (Blueprint $table) {
                    $table->dropColumn('request_id');
                });
            }
        });
    }
};