<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(BrandTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

        Model::reguard();
    }
}


class BrandTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('brands')->delete();
        App\Brand::create(['brand_name' => 'Bose']);
    }
}


class CategoryTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('categories')->delete();
        App\Category::create(['category_name' => 'Headphones']);
    }
}