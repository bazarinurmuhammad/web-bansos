<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProporsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proporsers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rt_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('rw_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('income_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nik');
            $table->string('kk');
            $table->string('name');
            $table->string('province');
            $table->string('regency');
            $table->string('district');
            $table->string('village');
            $table->string('address');
            $table->string('phone');
            $table->string('photo');
            $table->double('latitude');
            $table->double('longitude');
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
        Schema::dropIfExists('proporsers');
    }
}
