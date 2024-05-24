<?php

use App\Enums\UserStatus;
use App\Enums\UserTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('account_type', UserTypes::values())->default(UserTypes::ADMIN->value);
            $table->enum('status', UserStatus::values());
            $table->string('profile_picture')->default('no_image.png');
            $table->unsignedBigInteger('division')->nullable();
            $table->foreign('division')->references('id')->on('divisions');
            $table->boolean('is_online')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
