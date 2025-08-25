<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('inquiry_type', ['Business', 'Job Seeker']);
            $table->text('message');
            $table->string('ip_address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('device_fingerprint');
            $table->float('spam_score')->default(0);
            $table->enum('status', ['open', 'processing', 'closed'])->default('open');
            $table->text('follow_up_notes')->nullable();
            $table->timestamp('last_follow_up')->nullable();
            $table->timestamps();
            $table->index('device_fingerprint');
            $table->index('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
