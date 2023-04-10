<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('random_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('freelancer_id')->nullable()->constrained('users');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('title', 50);
            $table->string('attachment', 50);
            $table->text('description');
            $table->date('due_date');
            $table->enum('type', ['public', 'private'])->default('public');
            $table->enum('status', ['Pending', 'In Process', 'Finished', 'Completed','Cancel by customer','Cancel by freelancer','Reject'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
