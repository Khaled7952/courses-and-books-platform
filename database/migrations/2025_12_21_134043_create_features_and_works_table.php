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
        Schema::create('features_and_works', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['how_we_work', 'features'])->default('features');
            $table->text('question');
            $table->text('answer');
            $table->string('media');
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('features_and_works');
    }
};
