<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(CategoriesTableSeeder::class);
        \App\Models\Contact::factory(35)->create();

        User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'デモユーザー',
                'password' => Hash::make('demo1234'),
            ]
        );
    }
}
