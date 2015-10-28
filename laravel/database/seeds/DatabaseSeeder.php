<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Brand;
use App\Category;
use App\Feature_Rating;
use App\Feature_Rating_Total;
use App\Product;
use App\User;

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
        $this->call(ProductTableSeeder::class);
        Model::reguard();
    }
}


// Brands
class BrandTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('brands')->delete();
        Brand::create(['brand_name' => 'Bose']);
    }
}


// Categories
class CategoryTableSeeder extends Seeder 
{
    public function run()
    {
        DB::table('categories')->delete();
        Category::create(['category_name' => 'Headphones']);
    }
}


// Products
class ProductTableSeeder extends Seeder 
{
    public function run()
    {
        //DB::table('products')->delete();
        $brand_id = DB::table('brands')->where('brand_name', 'Bose')->first()->brand_id;
        $category_id = DB::table('categories')->where('category_name', 'Headphones')->first()->category_id ;
        Product::create(
            [
             'prod_name'        => 'QuietComfort® 25 Acoustic Noise Cancelling Headphones',
             'prod_model'       => 'QUIETCOMFORT 25 HEADPHONES BLK',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "QuietComfort 25 Acoustic Noise Cancelling headphones are the best-performing around-ear headphones from Bose. They give you crisp, powerful sound--and quiet that lets you hear your music better. Bose advances their industry-leading headphones with the latest proprietary Bose Active EQ and TriPort technology, giving the music you love deep, clear sound. At the same time, Bose noise cancelling technology monitors the noise around you and cancels it out, helping you focus on what you want to hear--whether it’s your music, your calls or simply peace and quiet. With a distinctive design and two color options to match your style, these headphones look as good as they sound. They’re also comfortable, durably made and easy to stow, with earcups that pivot to fit in a small carrying case. Customized for Apple devices. Included: QuietComfort 25 headphones; 56-inch QC25 inline remote and microphone cable; airline adapter; carrying case; AAA battery.",
             'overall_rating'   => 6,
             'prod_img_path'  => "http://ecx.images-amazon.com/images/I/71%2BHRQB7YCL._SX425_.jpg"

            ]

        );

    }
}