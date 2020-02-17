<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('workplans', function (Blueprint $table) {
          $table->string('idworkplans');
          $table->string('idequipmentdetails');
          $table->string('workplan_type');
          $table->integer('workplan_week');
          $table->dateTime('workplan_date');
          $table->enum('type',['i','e']);//intenal , external
          $table->text('desc');
          $table->string('image_before')->nullable();
          $table->string('image_after')->nullable();
          $table->string('worker')->nullable();
          $table->timestamps();
          $table->SoftDeletes();
          $table->string('created_by');
          $table->string('updated_by')->nullable();
          $table->string('deleted_by')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workplans');
    }
}
