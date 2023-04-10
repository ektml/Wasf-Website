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
        Schema::create('freelancer_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('service_id');
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
        Schema::dropIfExists('freelancer_services');
    }
};
