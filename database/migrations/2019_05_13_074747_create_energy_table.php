<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energys', function (Blueprint $table) {
            $table->string('idenergys');
            $table->enum('type',['l','a','s']); // listrik,air pam ,solar
            $table->double('volume');
            $table->dateTime('period');
            $table->text('desc');
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
        Schema::dropIfExists('energys');
    }
}
