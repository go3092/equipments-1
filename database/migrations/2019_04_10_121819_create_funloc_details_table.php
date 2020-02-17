<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunlocDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funloc_details', function (Blueprint $table) {
            $table->string('idfunlocdetails');
            $table->string('idfunlocs');
            $table->string('idlevels');
            $table->string('number');
            $table->text('description');
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
        Schema::dropIfExists('funloc_details');
    }
}
