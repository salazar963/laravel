<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$usuarios = [
    	[
    	'name' => 'Luis Salazar',
    	'email' => 'luisalazar@unicauca.edu.co',
    	'password' => bcrypt('12345')
    	]
    	];

    	foreach ($usuarios as $usuario) {
    		\App\Models\User::create($usuario);
    	}
    }
}
