<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('SelectSeeder');
        $this->command->info('Select Default option created...');

        $this->call('PermissionSeeder');
        $this->command->info('Permission created...');

        $this->call('RoleSeeder');
        $this->command->info('Role created...');

        $this->call('UserSeeder');
        $this->command->info('User Admin created...');

        $this->call('StatusSeeder');
        $this->command->info('Status created...');

        $this->call('BulletinSeeder');
        $this->command->info('Bulletin created...');

        $this->command->info('Mission Complete!!');
  
    }
}
