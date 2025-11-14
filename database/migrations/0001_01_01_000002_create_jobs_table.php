<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Onemogućava transaction block za ovu migraciju
    public $withinTransaction = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('queue'); // ime queue-a
            $table->text('payload'); // longText -> text
            $table->smallInteger('attempts')->default(0)->check('attempts >= 0'); // zamena za unsignedTinyInteger
            $table->integer('reserved_at')->nullable()->check('reserved_at >= 0'); // zamena za unsignedInteger
            $table->integer('available_at')->check('available_at >= 0');
            $table->integer('created_at')->check('created_at >= 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
