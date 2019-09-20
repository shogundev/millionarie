<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'first_name' =>'John',
            'last_name' =>'Doe',
            'email' => 'admin@millionarie.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' =>  \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $role = Role::create([
            'title' =>'Admin',
            'description' => 'Site Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $user = User::whereEmail('admin@millionarie.com')->first();
        $user->roles()->attach($role);
    }
}
