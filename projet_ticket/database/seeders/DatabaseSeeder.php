<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer 20 utilisateurs
        for ($i = 1; $i <= 20; $i++) {
            $name = Str::random(8);
            $email = $name . '@example.com';
            $password = Hash::make('password');
            $blocked = (bool) rand(0, 1);
            $admin = (bool) rand(0, 1);

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'blocked' => $blocked,
                'admin' => $admin,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

      
        // Créer des amitiés pour chaque utilisateur (sauf l'utilisateur avec l'ID 21)
        for ($userId = 1; $userId <= 20; $userId++) {
            // Sélectionner deux IDs d'amis aléatoires
            $friendIds = range(1, 20);
            unset($friendIds[$userId - 1]); // Exclure l'ID de l'utilisateur actuel
            shuffle($friendIds);
            $friendIds = array_slice($friendIds, 0, 2);

            // Créer les amitiés
            foreach ($friendIds as $friendId) {
                DB::table('friendships')->insert([
                    'user_id' => $userId,
                    'friend_id' => $friendId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

     
    }
}
