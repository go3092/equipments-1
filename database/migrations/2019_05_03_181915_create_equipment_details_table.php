<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->string('idequipmentdetails');
            $table->string('idequipments');//foreign key
            $table->string('iditems');//foreign key
            $table->string('idfunlocdetails');//foreign key
            $table->string('equipment_number');
            $table->string('model_number');
            $table->string('rate_number');
            $table->string('month_construction');
            $table->integer('year_construction');
            $table->dateTime('date_instalation');
            $table->text('description');
            $table->enum('status',['p','a','r']); //pending , approved, rejected
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
        Schema::dropIfExists('equipment_details');
    }
}
