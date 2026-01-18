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
        Schema::table('packages', function (Blueprint $table) {
            $table->string('protein_ratio')->nullable()->change();
            $table->string('carb_ratio')->nullable()->change();
            $table->string('fat_ratio')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedTinyInteger('protein_ratio')->default(0)->change();
            $table->unsignedTinyInteger('carb_ratio')->default(0)->change();
            $table->unsignedTinyInteger('fat_ratio')->default(0)->change();
        });
    }
};
