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
        Schema::table('alumni', function (Blueprint $table) {
            $table->string('linkedin_url')->nullable()->after('portfolio_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->string('tiktok_url')->nullable()->after('instagram_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn(['linkedin_url', 'instagram_url', 'tiktok_url']);
        });
    }
};
