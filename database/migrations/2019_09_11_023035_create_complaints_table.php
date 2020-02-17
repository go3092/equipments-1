<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('complaints', function (Blueprint $table) {
          $table->string('idcomplaints');
          $table->dateTime('date');
          $table->time('time_header');
          $table->string('location');
          $table->enum('type',['e','m','s','l']);//eletrikal, mekanikal, sipil, lain-lain
          $table->enum('param',['j','n']);//job, non-job
          $table->enum('status',['o','d','p','c']);//open , done, pending ,cancel
          $table->dateTime('action_date')->nullable();
          $table->time('start_time')->nullable();
          $table->time('end_time')->nullable();
          $table->text('desc');
          $table->string('informer_param')->nullable();
          $table->string('informer_name')->nullable();
          $table->string('informer_department')->nullable();
          $table->string('informer_position')->nullable();
          $table->text('work')->nullable();
          $table->text('solution')->nullable();
          $table->string('img_before')->nullable();
          $table->string('img_after')->nullable();
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
        Schema::dropIfExists('complaints');
    }
}
