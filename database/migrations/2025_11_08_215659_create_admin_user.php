<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void {
        // Proveri da li već postoji admin
        if (!DB::table('users')->where('email', 'admin@example.com')->exists()) {
            DB::table('users')->updateOrInsert(
                ['email' => 'admin@example.com'], // ključna kolona
                [
                    'name' => 'Admin',
                    'password' => Hash::make('Sifra123!'),
                    'phone' => '0641234567',
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),

            ]);
        }
    }

    public function down(): void {
        DB::table('users')->where('email', 'admin@example.com')->delete();
    }
};
