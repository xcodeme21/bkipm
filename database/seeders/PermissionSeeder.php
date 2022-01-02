<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ROLES
        Permission::updateOrCreate([ 'name' => "role-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "role-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "role-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "role-delete", 'guard_name' => "web" ]);
        
        //USERS
        Permission::updateOrCreate([ 'name' => "users-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "users-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "users-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "users-delete", 'guard_name' => "web" ]);
        
        //CUSTOMERS
        Permission::updateOrCreate([ 'name' => "customers-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "customers-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "customers-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "customers-delete", 'guard_name' => "web" ]);
        
        //BRANDS
        Permission::updateOrCreate([ 'name' => "brands-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "brands-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "brands-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "brands-delete", 'guard_name' => "web" ]);
        
        //SIZE
        Permission::updateOrCreate([ 'name' => "size-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "size-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "size-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "size-delete", 'guard_name' => "web" ]);
        
        //STOCK IN
        Permission::updateOrCreate([ 'name' => "stock-in-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-in-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-in-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-in-delete", 'guard_name' => "web" ]);
        
        //STOCK LIST
        Permission::updateOrCreate([ 'name' => "stock-list-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-list-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-list-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-list-delete", 'guard_name' => "web" ]);
        
        //SOURCE
        Permission::updateOrCreate([ 'name' => "source-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "source-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "source-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "source-delete", 'guard_name' => "web" ]);
        
        //DELIVERY
        Permission::updateOrCreate([ 'name' => "delivery-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "delivery-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "delivery-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "delivery-delete", 'guard_name' => "web" ]);
        
        //STOCK OUT
        Permission::updateOrCreate([ 'name' => "stock-out-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-out-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-out-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-out-delete", 'guard_name' => "web" ]);
        
        //ORDERS
        Permission::updateOrCreate([ 'name' => "orders-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "orders-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "orders-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "orders-delete", 'guard_name' => "web" ]);
        
        //STOCK OPNAME
        Permission::updateOrCreate([ 'name' => "stock-opname-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-opname-create", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-opname-edit", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-opname-delete", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "stock-opname-approve", 'guard_name' => "web" ]);
        
        //REPORTS
        Permission::updateOrCreate([ 'name' => "report-stock-in-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "report-stock-out-list", 'guard_name' => "web" ]);
        Permission::updateOrCreate([ 'name' => "report-orders-list", 'guard_name' => "web" ]);
    }
}
