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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('template_id')
                ->references('id')
                ->on('templates')
                ->cascadeOnDelete();
            $table->foreignId('group_id')
                ->references('id')
                ->on('groups')
                ->cascadeOnDelete();
            $table->dateTime('scheduled_at')->index();
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_scheduled')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
