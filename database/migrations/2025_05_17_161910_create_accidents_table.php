<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->dateTime('date');
            $table->enum('type', ['الاصطدام', 'الانهيار', 'اخرى']);
            $table->text('description');
            $table->foreignId('truck_id')->constrained()->onDelete('cascade');
            $table->foreignId('sensor_data_id')->nullable()->constrained('sensor_data')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
