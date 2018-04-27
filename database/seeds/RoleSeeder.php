<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(['name' => 'admin', 'display_name' => 'Admin','description' => 'System Admin']);
        
        $role = Role::all()->first();

        $permission = Permission::all();
        foreach ($permission as $data) {
        	$role->attachPermission($data->id);
        }


        Role::create(['name' => 'newbie', 'display_name' => 'Newbie','description' => 'New register User']);
        


    }
}
