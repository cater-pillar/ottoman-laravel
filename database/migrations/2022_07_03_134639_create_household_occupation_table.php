<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_occupation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupation_id')->constrained()->restrictOnDelete();
            $table->foreignId('household_id')->constrained()->cascadeOnDelete();
            $table->integer('income')->nullable();
            $table->enum('type',['kalfa','usta','cirak'])->default(null)->nullable();
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
        Schema::dropIfExists('household_occupation');
    }
};
