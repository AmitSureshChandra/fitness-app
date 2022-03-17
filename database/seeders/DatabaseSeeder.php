<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Branch::create([
            "name" => "ABC",
            "longitude" => "101.11",
            "lattitude" => "45.67"
        ]);

        $roles = [
            [
                "name" => config("constants.roles")["user"],
                "display_name" => "User"
            ],
            [
                "name" => config("constants.roles")["admin"],
                "display_name" => "Admin"
            ]
        ];

        Role::insert($roles);

        $users = [
            [
                "name" => "Amit",
                "email" => "akumar00029@gmail.com",
                "password" => bcrypt('password'),
                "role_id" => Role::select("id")->whereName(config("constants.roles")["user"])->first()->id
            ],
            [
                "name" => "Abhimanyu",
                "email" => "abhi@gmail.com",
                "password" => bcrypt('password'),
                "role_id" => Role::select("id")->whereName(config("constants.roles")["user"])->first()->id
            ],
            [
                "name" => "Mausam",
                "email" => "mausam@gmail.com",
                "password" => bcrypt('password'),
                "role_id" => Role::select("id")->whereName(config("constants.roles")["user"])->first()->id
            ],
            [
                "name" => "Rohit",
                "email" => "rohit@gmail.com",
                "password" => bcrypt('password'),
                "role_id" => Role::select("id")->whereName(config("constants.roles")["user"])->first()->id
            ],
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt('password'),
                "role_id" => Role::select("id")->whereName(config("constants.roles")["admin"])->first()->id
            ]
        ];

        User::insert($users);
    }
}
