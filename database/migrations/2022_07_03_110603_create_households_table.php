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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('forname')->nullable();
            $table->string('surname')->nullable();
            $table->foreignId('member_type_id')->constrained();
            $table->foreignId('location_name_id')->constrained();
            $table->integer('number');
            $table->text('notes')->nullable();
            $table->string('archive_code');
            $table->integer('page');
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
        Schema::dropIfExists('households');
    }
};
