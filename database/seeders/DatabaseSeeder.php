<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class
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

        $photos = Storage::allFiles("public");
        array_shift($photos);
        Storage::delete($photos);
        echo "storage cleared";
    }
}
