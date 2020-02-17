<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('approvals', function (Blueprint $table) {
          $table->string('idapprovals');
          $table->string('idequipmentdetails');
          $table->enum('status',['p','a','r']); //pending , approved, rejected
          $table->boolean('seen');
          $table->string('idusers');
          $table->timestamps();
          $table->SoftDeletes();
          // $table->string('updated_by')->nullable();
          // $table->string('deleted_by')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals');
    }
}
