<?php

use Database\Seeders\CreateUserSystemAdminSeeder;
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
        $this->call(ListFunctionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(LogReleaseSeeder::class);
        $this->call(CreateUserSystemAdminSeeder::class);
    }
}
