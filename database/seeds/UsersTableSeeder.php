<?php

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
        User::updateOrCreate([
        	'id' => 1,
        ], [
        	'name' => 'admin',
        	'email' => 'admin@admin.com',
        	'password' => 'admin123'
        ]);
    }
}
