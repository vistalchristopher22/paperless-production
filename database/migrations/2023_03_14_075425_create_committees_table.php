<?php

use App\Enums\CommitteeStatus;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('display_index')->nullable();
            $table->unsignedBigInteger('lead_committee')->nullable();
            $table->foreign('lead_committee')->references('id')->on('agendas');
            $table->unsignedBigInteger('expanded_committee')->nullable();
            $table->foreign('expanded_committee')->references('id')->on('agendas');
            $table->foreignId('expanded_committee_2')->nullable()->references('id')->on('agendas');
            $table->foreignId('expanded_committee_3')->nullable()->references('id')->on('agendas');
            $table->string('file_path')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('invited_guests')->default(0);
            $table->enum('status', CommitteeStatus::values())->default('review');
            $table->text('returned_message')->nullable();
            $table->foreignIdFor(User::class, 'submitted_by')->nullable();
            $table->foreignIdFor(Schedule::class)->nullable();
            $table->date('date')->default(now());
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committees');
    }
};
