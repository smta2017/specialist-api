<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomeColumnAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('avatar')->nullable();
            $table->text('edu1')->nullable();
            $table->text('edu2')->nullable();
            $table->text('edu3')->nullable();
            $table->text('edu4')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('firebase_token')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->tinyInteger('is_admin')->nullable()->default(0);
            $table->enum('gender', ['mail','femail'])->nullable();
            $table->integer('user_type_id')->nullable();
            $table->date('dop')->nullable();
            $table->tinyInteger('sms_notification')->nullable();
            $table->string('lang')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            Schema::dropIfExists('facebook_id');
            Schema::dropIfExists('google_id');
            Schema::dropIfExists('firebase_token');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('is_active');
            $table->dropColumn('is_admin');
            $table->dropColumn('gender');
            $table->dropColumn('user_type_id');
            $table->dropColumn('dop');
            $table->dropColumn('sms_notification');
            $table->dropColumn('lang');
        });
    }
}
