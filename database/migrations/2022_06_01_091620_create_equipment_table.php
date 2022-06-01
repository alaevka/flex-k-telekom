<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('equipment_type_code')
                ->comment('код типа оборудования')
            ;
            $table
                ->string('serial_number')
                ->unique()
                ->comment('серийный номер')
            ;
            $table
                ->text('comment')
                ->nullable()
                ->comment('примечание')
            ;
            $table
                ->foreign('equipment_type_code')
                ->references('id')
                ->on('equipment_type')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
