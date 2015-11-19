<?php

use App\RolesUsers;
use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{

    Public Function run()
    {
        RolesUsers::create(
            [
                'role_id' => '5',
                'user_id' => '1',
            ]
        );

        RolesUsers::create(
            [
                'role_id' => '3',
                'user_id' => '1',
            ]
        );

    }
}