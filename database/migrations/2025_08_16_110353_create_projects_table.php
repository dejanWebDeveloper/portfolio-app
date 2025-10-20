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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 255);
            $table->string('preheading', 500);
            $table->text('text');
            $table->string('photo')->nullable();
            $table->string('github_link')->nullable();
            $table->string('demo_link')->nullable();
            $table->integer('category_id');
            $table->integer('author');
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('enable')->default(1);
            $table->integer('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
