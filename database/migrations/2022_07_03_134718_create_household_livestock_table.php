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
        Schema::create('household_livestock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livestock_id')->constrained()->restrictOnDelete();
            $table->foreignId('household_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->integer('income')->nullable();
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
        Schema::dropIfExists('household_livestock');
    }
};
