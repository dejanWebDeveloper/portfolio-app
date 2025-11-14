<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Onemogućava tranzakciju za ovu migraciju
    public $withinTransaction = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable(); // after() se ignoriše u PostgreSQL
            $table->string('profile_photo')->nullable();
            $table->boolean('status')->default(true); // dodaj default da bi bilo sigurno
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('profile_photo');
            $table->dropColumn('status');
        });
    }
};
