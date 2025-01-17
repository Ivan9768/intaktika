<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name', 20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('telephone', 12)->unique();
            $table->string('code', 6);
            $table->string('role')->default(0);
            $table->boolean('active')->default(true);

            $table->string('password');
            $table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
