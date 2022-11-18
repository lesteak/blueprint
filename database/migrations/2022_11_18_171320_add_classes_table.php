<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('published')->default(false)->index();
            $table->datetime('publish_at')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->unsignedBigInteger('hero_image_id')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
