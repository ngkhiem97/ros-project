<?php

use App\Enums\UserType;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Create an Admin user ID = 1 */
        App\User::create([
            'name' => 'Admin',
            'type' => UserType::Admin,
            'email' => 'admin@admin.com',
            'password' => '123456'
        ]);
        factory(App\User::class, 50)->create();
    }
}
