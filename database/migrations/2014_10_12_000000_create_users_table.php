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
            $table->uuid()->index()->unique();
            $table->string('name')->nullable();
            $table->string('mobile_prefix', 20)->nullable()->index();
            $table->string('mobile')->index();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->unique([
                'mobile_prefix',
                'mobile',
            ]);
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
