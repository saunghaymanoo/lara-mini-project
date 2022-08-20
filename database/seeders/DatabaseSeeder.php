<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

       
        \App\Models\User::factory()->create([
            'name' => 'Su Pon',
            'email' => 'supon@gmail.com',
            'password' => Hash::make('asdffdsa'),
        ]);
        $categories=["IT News","Sport","Food & Drink","Travel"];
        foreach($categories as $c){
            Category::factory()->create([
                "title" => $c,
                "user_id" => User::inRandomOrder()->first()->id
            ]);
        }

        SubCategory::factory()->count(7)->create();
        Item::factory()->count(15)->create();
    }
}
