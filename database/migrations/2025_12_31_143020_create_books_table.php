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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle')->nullable();

            $table->decimal('price', 10, 2)->nullable();

            $table->string('cover_image')->nullable();
            $table->string('back_image')->nullable();
            $table->string('file_pdf')->nullable();

            $table->text('short_description')->nullable();
            $table->text('details')->nullable();

            $table->text('about_author')->nullable();

            $table->float('rating_avg')->nullable();
            $table->integer('rating_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
