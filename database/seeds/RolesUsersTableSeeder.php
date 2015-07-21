<?php

use App\RolesUsers;
use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{

    Public Function run()
    {
        RolesUsers::create(
            [
                'role_id' => '1',
                'user_id' => '1',
            ]
        );

    }
}