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
        Schema::create('free_opens', function (Blueprint $table) {
            $table->id();
            $table->string('device_uuid')->indexed();
            $table->enum('category', ['rune', 'scroll'])->nullable();
            $table->timestamp('used_at');
            $table->timestamps();
            
            $table->unique(['device_uuid', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_opens');
    }
};
