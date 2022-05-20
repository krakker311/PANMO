<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Province;
use App\Models\ModelUser;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
   

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

    
        

        DB::table('provinces')->insert([
            ['name'=>'Sulawesi Utara'],
            ['name'=>'Sulawesi Barat'],
            ['name'=>'Sulawesi Tenggara'],
            ['name'=>'Sulawesi Tengah'],
            ['name'=>'Sulawesi Selatan'],
            ['name'=> 'Aceh'],
            ['name'=> 'Bali'],
            ['name'=> 'Banten'],
            ['name'=> 'Bengkulu'],
            ['name'=> 'DI Yogyakarta'],
            ['name'=> 'Gorontalo'],
            ['name'=> 'DKI Jakarta'],
            ['name'=> 'Jambi'],
            ['name'=> 'Jawa Barat'],
            ['name'=> 'Jawa Tengah'],
            ['name'=> 'Jawa Timur'],
            ['name'=> 'Kalimantan Tengah'],
            ['name'=> 'Kalimantan Utara'],
            ['name'=> 'Kalimantan Barat'],
            ['name'=> 'Kalimantan Selatan'],
            ['name'=> 'Kalimantan Timur'],
            ['name'=> 'Kepulauan Bangka Belitung'],
            ['name'=> 'Kepulauan Riau'],
            ['name'=> 'Maluku'],
            ['name'=> 'Maluku Utara'],
            ['name'=> 'Papua'],
            ['name'=> 'Papua Barat'],
            ['name'=> 'Riau'],
            ['name'=> 'Sumatera Selatan'],
            ['name'=> 'Sumatera Barat'],
            ['name'=> 'Sumater Utara'],
        ]);


        Post::factory(20)->create();
    }
}