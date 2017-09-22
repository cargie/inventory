<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['administrator', 'cashier'];

        foreach ($roles as $role) {
        	Role::updateOrCreate([
        		'name' => $role,
        	], [
        		'name' => $role,
        	]);
        }
    }
}
