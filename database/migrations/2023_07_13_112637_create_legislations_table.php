<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('legislations', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->string('reference_no')->unique();
            $table->string('title');
            $table->text('description');
            $table->enum('classification', ['ordinance', 'resolution']);
            $table->integer('legislable_id');
            $table->string('legislable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legislations');
    }
};
