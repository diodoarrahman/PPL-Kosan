<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudeLongitudeToKosansTable extends Migration
{
    public function up()
    {
        Schema::table('kosans', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable();  // Format untuk latitude
            $table->decimal('longitude', 10, 7)->nullable(); // Format untuk longitude
        });
    }

    public function down()
    {
        Schema::table('kosans', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
