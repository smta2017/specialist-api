<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared( file_get_contents( "database/areas.sql" ) );

        Schema::table('cities', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("name");
        //     $table->string("name_ar")->nullable();
            $table->boolean("active")->default(1);
            $table->boolean("country_id")->default(1);
        //     $table->text("deactivation_notes")->nullable();
            $table->decimal("delivery_fees", 8, 2)->nullable();
        //     $table->timestamps();
        });


        Schema::table('areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("name");
        //     $table->string("name_ar")->nullable();
            $table->boolean("active")->default(1);
        //     $table->text("deactivation_notes")->nullable();
            $table->decimal("delivery_fees", 8, 2)->nullable();
        //     $table->timestamps();
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('areas');
        Schema::dropIfExists('cities');
    }
}
