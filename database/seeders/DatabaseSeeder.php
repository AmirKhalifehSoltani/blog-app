<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserType;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        DB::table('users')->insert([
//            [
//                'first_name' => Str::random(10),
//                'last_name'  => Str::random(10),
//                'email'      => 'client@alibaba.ir',
//                'user_type'  => UserType::CLIENT,
//                'password'   => Hash::make('12345678'),
//            ], [
//                'first_name' => Str::random(10),
//                'last_name'  => Str::random(10),
//                'email'      => 'admin@alibaba.ir',
//                'user_type'  => UserType::ADMIN,
//                'password'   => Hash::make('12345678'),
//            ]
//        ]);

        User::factory()->admin()->create();
//        User::factory()->client()->create();
        Article::factory()->count(10)->forAuthor(['email' => 'client1@alibaba.ir', 'password' => 'password'])->create();
        Article::factory()->count(10)->forAuthor(['email' => 'client2@alibaba.ir', 'password' => 'password'])->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
