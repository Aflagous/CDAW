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
        $name = 'banque';
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
      
        for ($i = 1; $i <= 10; $i++) {
            $name = 'Partie ' . $i;
            $publique = (bool) rand(0, 1);
            $temps = rand(30, 120); 
            $mdp = (rand(0, 1) == 1) ? Str::random(8) : 'null';
            $hote_id = rand(1, 20); 
            $commencer = (bool) rand(0, 1);
            $fini = 0;
            $debut = 0;
    
            DB::table('parties')->insert([
                'name' => $name,
                'publique' => $publique,
                'temps' => $temps,
                'mdp' => $mdp,
                'hote_id' => $hote_id,
                'commencer' => $commencer,
                'fini' => $fini,
                'debut' => $debut,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
      
        for ($userId = 1; $userId <= 20; $userId++) {
            $friendIds = range(1, 20);
            unset($friendIds[$userId - 1]);
            shuffle($friendIds);
            $friendIds = array_slice($friendIds, 0, 2);

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
