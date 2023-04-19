<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLicenseKeyUsageCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softwares', function (Blueprint $table) {
            $table->string('license_key')->after('version');
            $table->integer('usage_count')->after('license_key');
            $table->dropConstrainedForeignId('device_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('softwares', 'license_key'))
        {
            Schema::table('softwares', function (Blueprint $table) {
                $table->dropColumn('license_key');
            });
        }

        if (Schema::hasColumn('softwares', 'usage_count'))
        {
            Schema::table('softwares', function (Blueprint $table) {
                $table->dropColumn('usage_count');
            });
        }
    }
}
