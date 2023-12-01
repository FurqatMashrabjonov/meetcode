<?php

use App\Enums\ProblemStatus;
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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('problem_category_id')->constrained()->onDelete('cascade');
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->string('starter_code');
            $table->string('template_code');
            $table->string('input');
            $table->string('output');
            $table->string('image')->nullable();
            $table->string('status')->default(ProblemStatus::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
