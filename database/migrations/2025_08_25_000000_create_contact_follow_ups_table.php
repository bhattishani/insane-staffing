<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contact_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->text('notes')->nullable();
            $table->datetime('follow_up_date');
            $table->datetime('next_follow_up_date')->nullable();
            $table->string('outcome')->nullable();
            $table->string('follow_up_type')->default('call');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_follow_ups');
    }
};
