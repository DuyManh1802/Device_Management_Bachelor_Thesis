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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('device_id')->nullable()->constrained('devices');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('confirm')->default(0);
            $table->integer('user_confirm')->nullable();
            $table->tinyInteger('result')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
