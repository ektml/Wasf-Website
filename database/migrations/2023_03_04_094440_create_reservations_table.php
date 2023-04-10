<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('random_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();
            $table->string('occasion');
            $table->date('date_time');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('location')->nullable();
            $table->enum('status', ['Pending', 'Waiting', 'In Process', 'Finished', 'Accepted', 'Rejected', 'Completed', 'Cancel by customer', 'Cancel by freelancer','Posted by freelancer'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
