<?php

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
        DB::table('users')->insert(
            [
                'name'=>'Admin',
                'email'=>'admin@its.az',
                'password'=>bcrypt('123456'),
                'phone'=>012
            ]
        );
        factory(App\User::class, 5000)->create();
    }
}
