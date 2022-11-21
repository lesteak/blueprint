<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLocationToLocationField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['hero_image_id']);
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->json('geo')->nullable()->after('thumbnail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['geo']);
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->unsignedBigInteger('hero_image_id')->nullable()->after('thumbnail_id');
        });
    }
}
