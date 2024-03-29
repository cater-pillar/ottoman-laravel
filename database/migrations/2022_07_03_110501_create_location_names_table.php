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
        Schema::create('location_names', function (Blueprint $table) {
            $table->id();
            $table->string('name_tr');
            $table->foreignId('location_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('location_name_id')->nullable()->constrained()->restrictOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_names');
    }
};
