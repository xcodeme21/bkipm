<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdministratorUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => "Administrator",
            'username'    => "administrator",
            'email'    => "admin@sistem.com",
            'password'    => bcrypt('yui678')
        ]);
    }
}
