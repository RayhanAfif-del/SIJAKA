<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_website', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('site_icon');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_website', function (Blueprint $table) {
            $table->dropColumn('hero_image');
        });
    }
};
