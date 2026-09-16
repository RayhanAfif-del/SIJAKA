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
            if (! Schema::hasColumn('alumni', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (! Schema::hasColumn('alumni', 'classroom')) {
                $table->string('classroom')->nullable()->after('jurusan');
            }
            if (! Schema::hasColumn('alumni', 'sipintu_last_synced_at')) {
                $table->timestamp('sipintu_last_synced_at')->nullable()->after('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $dropColumns = [];
            if (Schema::hasColumn('alumni', 'phone')) {
                $dropColumns[] = 'phone';
            }
            if (Schema::hasColumn('alumni', 'classroom')) {
                $dropColumns[] = 'classroom';
            }
            if (Schema::hasColumn('alumni', 'sipintu_last_synced_at')) {
                $dropColumns[] = 'sipintu_last_synced_at';
            }
            if (! empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
