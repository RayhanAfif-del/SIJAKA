<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->foreignId('mitra_id')->constrained('mitra')->cascadeOnDelete();
            $table->foreignId('lowongan_id')->nullable()->constrained('lowongan')->nullOnDelete();
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->text('response_note')->nullable();
            $table->timestamp('proposed_at')->nullable();
            $table->timestamps();

            $table->unique(['alumni_id', 'mitra_id', 'lowongan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_requests');
    }
};
