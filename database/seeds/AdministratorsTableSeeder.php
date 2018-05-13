<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();

        DB::table('administrators')->insert([
            'username' => 'admin',
            'password' => md5('123456')
        ]);
    }
}
