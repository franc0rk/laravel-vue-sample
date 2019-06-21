<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'test@test.com',
        ]);

        $user->profile()->save(new \App\UserProfile([
            'bio' => 'lorem',
        ]));

        $user->addresses()->save(new \App\UserAddress([
            'line_1' => 'lorem',
        ]));

        factory(\App\PostCategory::class, 3)->create();

        factory(\App\Post::class, 10)->create();

        factory(\App\PostAttachment::class, 100)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
