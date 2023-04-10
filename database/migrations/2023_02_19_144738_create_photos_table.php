<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();
            $table->string('photo', 100);
            $table->string('name', 20);
            $table->double('price')->default(0);
            $table->text('description');
            $table->string('camera_brand', 20)->nullable();
            $table->string('lens_type', 20)->nullable();
            $table->double('size_width');
            $table->double('size_height');
            $table->enum('size_type', ['px', 'rem', 'inch'])->default('px');
            $table->string('location')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
