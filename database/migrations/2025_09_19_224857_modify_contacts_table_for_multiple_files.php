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
        Schema::table('contacts', function (Blueprint $table) {
            // Change cv_path to JSON to store multiple file paths
            $table->json('attachment_paths')->nullable()->after('message');
            $table->dropColumn('cv_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('cv_path')->nullable()->after('message');
            $table->dropColumn('attachment_paths');
        });
    }
};
