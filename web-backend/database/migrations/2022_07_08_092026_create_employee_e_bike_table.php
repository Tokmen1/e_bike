<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEBikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_e_bike', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
                ->constrained('employee')
                ->onDelete('cascade');
            $table->foreignId('e_bike_id')
                ->constrained('e_bike')
                ->onDelete('cascade');
            $table->date('date_from');
            $table->date('date_to');
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
        Schema::dropIfExists('employee_e_bike');
    }
}
