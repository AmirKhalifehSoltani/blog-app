<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserType;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Client;
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
        Admin::factory()->create(['email'     => 'admin@alibaba.ir', 'password' => 'password']);
//        User::factory()->admin()->create();
//        User::factory()->client()->create();
        Article::factory()->count(1)->forAuthor(['email' => 'client1@alibaba.ir', 'password' => 'password'])->create();
        Article::factory()->count(3)->forAuthor(['email' => 'client2@alibaba.ir', 'password' => 'password'])->create();
    }
}
