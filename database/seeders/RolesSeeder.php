<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\User;
use DB, Hash;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::updateOrCreate([ 'name' => "Admin", 'guard_name' => "web" ]);
        Roles::updateOrCreate([ 'name' => "Sales", 'guard_name' => "web" ]);
        Roles::updateOrCreate([ 'name' => "Warehouse", 'guard_name' => "web" ]);

        DB::table('role_has_permissions')->truncate();
        $data = [
            [ 'permission_id' => 1, 'role_id' => 1 ],
            [ 'permission_id' => 2, 'role_id' => 1 ],
            [ 'permission_id' => 3, 'role_id' => 1 ],
            [ 'permission_id' => 4, 'role_id' => 1 ],
            [ 'permission_id' => 5, 'role_id' => 1 ],
            [ 'permission_id' => 6, 'role_id' => 1 ],
            [ 'permission_id' => 7, 'role_id' => 1 ],
            [ 'permission_id' => 8, 'role_id' => 1 ],
            [ 'permission_id' => 9, 'role_id' => 1 ],
            [ 'permission_id' => 10, 'role_id' => 1 ],
            [ 'permission_id' => 11, 'role_id' => 1 ],
            [ 'permission_id' => 12, 'role_id' => 1 ],
            [ 'permission_id' => 13, 'role_id' => 1 ],
            [ 'permission_id' => 14, 'role_id' => 1 ],
            [ 'permission_id' => 15, 'role_id' => 1 ],
            [ 'permission_id' => 16, 'role_id' => 1 ],
            [ 'permission_id' => 17, 'role_id' => 1 ],
            [ 'permission_id' => 18, 'role_id' => 1 ],
            [ 'permission_id' => 19, 'role_id' => 1 ],
            [ 'permission_id' => 20, 'role_id' => 1 ],
            [ 'permission_id' => 21, 'role_id' => 1 ],
            [ 'permission_id' => 22, 'role_id' => 1 ],
            [ 'permission_id' => 23, 'role_id' => 1 ],
            [ 'permission_id' => 24, 'role_id' => 1 ],
            [ 'permission_id' => 25, 'role_id' => 1 ],
            [ 'permission_id' => 26, 'role_id' => 1 ],
            [ 'permission_id' => 28, 'role_id' => 1 ],
            [ 'permission_id' => 29, 'role_id' => 1 ],
            [ 'permission_id' => 30, 'role_id' => 1 ],
            [ 'permission_id' => 31, 'role_id' => 1 ],
            [ 'permission_id' => 32, 'role_id' => 1 ],
            [ 'permission_id' => 33, 'role_id' => 1 ],
            [ 'permission_id' => 34, 'role_id' => 1 ],
            [ 'permission_id' => 35, 'role_id' => 1 ],
            [ 'permission_id' => 36, 'role_id' => 1 ],
            [ 'permission_id' => 37, 'role_id' => 1 ],
            [ 'permission_id' => 38, 'role_id' => 1 ],
            [ 'permission_id' => 39, 'role_id' => 1 ],
            [ 'permission_id' => 40, 'role_id' => 1 ],
            [ 'permission_id' => 41, 'role_id' => 1 ],
            [ 'permission_id' => 42, 'role_id' => 1 ],
            [ 'permission_id' => 43, 'role_id' => 1 ],
            [ 'permission_id' => 44, 'role_id' => 1 ],
            [ 'permission_id' => 45, 'role_id' => 1 ],
            [ 'permission_id' => 46, 'role_id' => 1 ],
            [ 'permission_id' => 47, 'role_id' => 1 ],
            [ 'permission_id' => 48, 'role_id' => 1 ],
            [ 'permission_id' => 49, 'role_id' => 1 ],
            [ 'permission_id' => 50, 'role_id' => 1 ],
            [ 'permission_id' => 51, 'role_id' => 1 ],
            [ 'permission_id' => 52, 'role_id' => 1 ]
        ];

        DB::table('role_has_permissions')->insert($data);

        $insertadmin['name'] = "Admin";
        $insertadmin['email'] = "admin@gmail.com";
        $insertadmin['password'] = Hash::make("123456");
        $roleadmin = [
            0 => "Admin"
        ];

        $insertsales['name'] = "Sales";
        $insertsales['email'] = "sales@gmail.com";
        $insertsales['password'] = Hash::make("123456");
        $rolesales = [
            1 => "Sales"
        ];

        $insertwh['name'] = "Warehouse";
        $insertwh['email'] = "warehouse@gmail.com";
        $insertwh['password'] = Hash::make("123456");
        $rolewh = [
            2 => "Warehouse"
        ];

        User::truncate();
        $useradmin = User::create($insertadmin);
        $useradmin->assignRole($roleadmin);

        $usersales = User::create($insertsales);
        $usersales->assignRole($rolesales);

        $userwh = User::create($insertwh);
        $userwh->assignRole($rolewh);
        
        DB::table('model_has_roles')->truncate();

        $data = [
            [ 'role_id' => 1, 'model_type' => "App\Models\User", 'model_id' => 1 ],
            [ 'role_id' => 2, 'model_type' => "App\Models\User", 'model_id' => 2 ],
            [ 'role_id' => 3, 'model_type' => "App\Models\User", 'model_id' => 3 ]
        ];

        DB::table('model_has_roles')->insert($data);
        
    }
}
