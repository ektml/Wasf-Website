<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('phone')->unique();
            $table->string('id_number', 50)->nullable();
            $table->string('business_register', 50)->nullable();
            $table->string('profile_image', 100)->nullable();
            $table->enum('type', ['admin', 'customer', 'freelancer'])->default('customer');
            $table->enum('is_photographer', [0, 1])->default(0);  // 0 is not aphotographer  // 1 is photographer
            $table->string('device_token')->nullable();
            $table->string('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
