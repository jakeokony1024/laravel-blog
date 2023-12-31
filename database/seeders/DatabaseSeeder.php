<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
//      User::truncate();
//      Category::truncate();
//      Post::truncate();

        $user = User::factory()->create([
            'name' => 'John Exception',
      ]);

      Post::factory(10)->create([
          'user_id' => $user->id
      ]);
    }
}
