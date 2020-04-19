<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class); //After dah insert kat dlam PostsTableSeeder , jgan lupa call dkat DatabaseSeeder
        $this->call(ProductsTableSeeder::class);
    }
}
