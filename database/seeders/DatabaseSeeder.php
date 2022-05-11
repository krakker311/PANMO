<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Province;
use App\Models\ModelUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'verdy',
            'username' => 'verdy',
            'email' => 'verdy@binus.ac.id',
            'password' => bcrypt('12345')        
        ]);

        User::factory(3)->create();
        ModelUser::factory(3)->create();
        Category::create([
            'name'=> 'Make-up Model',
            'slug' => 'make-up-model'
        ]);
        Category::create([
            'name'=> 'Commercial Model',
            'slug' => 'commercial-model'
        ]);
        Category::create([
            'name'=> 'Mature Model',
            'slug' => 'mature-model'
        ]);
        Province::create([
            'name'=> 'DKI Jakarta'
        ]);
        Province::create([
            'name'=> 'Jawa Barat'
        ]);

        Post::factory(20)->create();
    }
}