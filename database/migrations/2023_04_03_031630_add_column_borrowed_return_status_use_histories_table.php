<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBorrowedReturnStatusUseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_histories', function (Blueprint $table) {
            $table->tinyInteger('status')->after('request_id');
            $table->dateTime('borrowed_date')->after('status');
            $table->dateTime('return_date')->after('borrowed_date')->nullable();
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
            $table->dropColumn(['status', 'borrowed_date', 'return_date']);
        });
    }
}
