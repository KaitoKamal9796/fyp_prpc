<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'adilakamal9796@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'adila',
                'email' => 'adilakamal9796@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password') // ('password') tu kau ltak lah password suka hati kau.
            ]);
        }
    }
}
