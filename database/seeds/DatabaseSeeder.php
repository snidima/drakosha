<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
    }
}


class UsersTableSeeder extends Seeder {

    public function run()
    {
        App\User::create([
            'email' => 'snidima@mail.ru',
            'name' => 'Дмитрий',
            'surname' => 'Снигур',
            'lastname' => 'Александрович',
            'password' =>  bcrypt('123456789'),
        ]);
    }

}