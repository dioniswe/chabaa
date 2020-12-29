<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointedDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointed_dates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->text('subject');
            $table->text('preacher');
            $table->text('conduct');
            $table->text('technician');
            $table->text('childrens_ministry');
            $table->text('other_notes');
            $table->text('miscellaneous');
            $table->boolean('publish');
            $table->boolean('communion');
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
        Schema::dropIfExists('appointed_dates');
    }
}
