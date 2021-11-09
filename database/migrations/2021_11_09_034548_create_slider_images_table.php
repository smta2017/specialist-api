<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderImagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->id('id');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('caption')->nullable();
            $table->text('url')->nullable();
            $table->text('image_name');
            $table->dateTime('start_date')->default(date("Y-m-d H:i:s"));
            $table->dateTime('end_date')->default(date("Y-m-d H:i:s"));
            $table->boolean('is_active')->default(1);
            $table->integer('slider_id');
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
        Schema::drop('slider_images');
    }
}
