<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_comments', function (Blueprint $table) {
            $table->id('id');
            $table->integer('request_id');
            $table->integer('user_id');
            $table->string('body');
            $table->float('offer');
            $table->date('delivery_date');
            $table->integer('user_id')->nullable();
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
        Schema::drop('request_comments');
    }
}
