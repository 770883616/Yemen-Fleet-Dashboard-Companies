<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('deadline');
            $table->string('status'); // e.g., pending, in_progress, completed
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('truck_id')->nullable()->constrained()->onDelete('set null');
            // $table->foreignId('destination_id')->nullable()->constrained('destinations')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
