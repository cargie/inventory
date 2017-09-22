<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
        	'category', 'tag', 'product', 'supplier',
        	'inventory', 'stock adjustment', 'customer',
        	'user', 'role', 'payment', 'order'
       	];

       	$verbs = ['create', 'update', 'delete'];

       	foreach ($routes as $route) {

       		foreach ($verbs as $verb) {
       			Permission::updateOrCreate([
       				'name' => $verb . '-' . $route
       			], [
       				'name' => $verb . '-' . $route
       			]);
       		}
       	}
    }
}
