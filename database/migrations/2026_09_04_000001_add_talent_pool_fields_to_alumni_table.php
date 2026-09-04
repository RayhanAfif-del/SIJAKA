<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->string('email')->nullable()->unique()->after('nama');
            $table->string('password')->nullable()->after('email');
            $table->rememberToken();
            $table->string('headline')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('portfolio_path')->nullable();
            $table->boolean('is_visible')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn([
                'email', 'password', 'remember_token', 'headline', 'ringkasan',
                'keahlian', 'portfolio_url', 'cv_path', 'portfolio_path', 'is_visible',
            ]);
        });
    }
};
