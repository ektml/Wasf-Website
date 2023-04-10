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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('freelancer_id')->references('id')->on('users')->nullable();
            $table->enum("status",['pending','purchase','withdraw','refund']);
            $table->enum("pay_type",['bank','applepay','wallet']);
            $table->decimal('total', 10, 2);
            $table->string('discount')->default(0);
            $table->morphs('paymentsable');
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
        Schema::dropIfExists('payments');
    }
};
