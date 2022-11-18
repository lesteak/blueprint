<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('published')->default(false)->index();
            $table->datetime('publish_at')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('role')->nullable();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->unsignedBigInteger('hero_image_id')->nullable();
            $table->text('description')->nullable();
            $table->json('description_json')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });

        Schema::create('class_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id')->index();
            $table->unsignedBigInteger('trainer_id')->index();
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
        Schema::dropIfExists('class_trainer');
        Schema::dropIfExists('trainers');
    }
}
