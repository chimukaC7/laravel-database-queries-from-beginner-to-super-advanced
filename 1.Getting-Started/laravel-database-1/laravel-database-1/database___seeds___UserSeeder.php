<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();

        $connection = 'sqlite';
        $users = factory(App\User::class, 3)->make();
        $users->each(function($model) use($connection) {
            $model->setConnection($connection);
            $model->save();
        });
    }
}

