<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $moderatorRole = Role::where('name', 'Moderator')->first();
        $userRole = Role::where('name', 'User')->first();

        User::all()->each(function ($user) use ($adminRole, $moderatorRole, $userRole) {
            $user->roles()->attach($userRole->id);

            if (rand(0, 1)) {
                $user->roles()->attach($moderatorRole->id);
            } else {
                $user->roles()->attach($adminRole->id);
            }
        });
    }
}
