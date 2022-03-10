<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class CreateUserSystemAdminSeeder extends Seeder
{
    use HasRoles, HasPermissions;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'name' => 'User System Admin',
            'address' => '',
            'phone' => '',
            'email' => 'root@gmail.com',
            'password' => Hash::make('root'),
        ];
        $user = User::create(
            $data,
        );
        $user->assignRole('System Admin');
        $this->command->info('Account User System Admin has been created');
    }
}
