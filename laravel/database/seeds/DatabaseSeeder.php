<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Brand;
use App\Category;
use App\Feature;
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
        $this->call(FeatureTableSeeder::class);
        Model::reguard();
    }
}


// -- Brands -- //
class BrandTableSeeder extends Seeder 
{
    public function run()
    {
        // Delete current brands
        DB::table('brands')->delete();

        // Add these brands
        Brand::create(['brand_name' => 'Bose']);
        Brand::create(['brand_name' => 'Sony']);
        Brand::create(['brand_name' => 'Samsung']);

    }
}


// -- Categories -- //
class CategoryTableSeeder extends Seeder 
{
    public function run()
    {
        //Delete current categories
        DB::table('categories')->delete();

        //Add these categories
        Category::create(['category_name' => 'Headphones']);
        Category::create(['category_name' => 'TVs']);
        Category::create(['category_name' => 'Cell Phones']);
    }
}


// -- Products -- //
class ProductTableSeeder extends Seeder 
{
    public function run()
    {
        // Delete current products
        DB::table('products')->delete();

        // Bose - Headphones
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

        // Sony - Headphones
        $brand_id       =   DB::table('brands')-> 
                            where('brand_name', 'Sony')->
                            first()->brand_id;
        $category_id    =   DB::table('categories')-> 
                            where('category_name', 'Headphones')->
                            first()->category_id ;
        Product::create(
            [
             'prod_name'        => 'Wireless FM Over-the-Ear Headphones',
             'prod_model'       => 'MDRRF985RK',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "Enjoy clear sound with these Sony MDRRF985RK over-the-ear headphones that include a transmitter and feature automatic tuning, so you can easily listen to music and more at a range of up to 150'. The easy-adjust headband offers comfort.",
             'overall_rating'   => 3,
             'prod_img_path'  => "http://pisces.bbystatic.com/image2/BestBuy_US/images/products/6582/6582193_sd.jpg"
            ]
        );


        // Sony - Television
        $brand_id       =   DB::table('brands')-> 
                            where('brand_name', 'Sony')->
                            first()->brand_id;
        $category_id    =   DB::table('categories')-> 
                            where('category_name', 'TVs')->
                            first()->category_id ;
        Product::create(
            [
             'prod_name'        => 'BRAVIA - 48"',
             'prod_model'       => 'KDL48W600B',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "Enjoy clear sound with these Sony MDRRF985RK over-the-ear headphones that include a transmitter and feature automatic tuning, so you can easily listen to music and more at a range of up to 150'. The easy-adjust headband offers comfort.",
             'overall_rating'   => 3,
             'prod_img_path'  => "http://pisces.bbystatic.com/image2/BestBuy_US/images/products/3418/3418083_sd.jpg"
            ]
        );


        // Samsung - Television
        $brand_id       =   DB::table('brands')-> 
                            where('brand_name', 'Samsung')->
                            first()->brand_id;
        $category_id    =   DB::table('categories')-> 
                            where('category_name', 'TVs')->
                            first()->category_id ;
        Product::create(
            [
             'prod_name'        => 'Samsung - 60" ',
             'prod_model'       => 'UN60J6200AFXZA',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "Samsung UN60J6200AFXZA LED Smart HDTV: Enjoy Full HD viewing and enriched colors on this Samsung HDTV. Its Smart TV features let you stream videos and music, surf the Internet, download apps and more. Plus, watch your TV entertainment on your mobile device or vice versa.",
             'overall_rating'   => 3,
             'prod_img_path'  => "http://pisces.bbystatic.com/image2/BestBuy_US/images/products/5412/5412152_rd.jpg"
            ]
        );


        // Samsung - Cell Phones
        $brand_id       =   DB::table('brands')-> 
                            where('brand_name', 'Samsung')->
                            first()->brand_id;
        $category_id    =   DB::table('categories')-> 
                            where('category_name', 'Cell Phones')->
                            first()->category_id ;
        Product::create(
            [
             'prod_name'        => 'Galaxy S6 edge+" ',
             'prod_model'       => 'SMG928VZDA',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "This smartphone includes the features you loved about the Galaxy S6 edge, but with a larger screen and a slimmer build. The popular edge-wrapping screen is back, and since you can set the Edge Handle menu to the left or right edge of the screen, the apps and contacts you use most sit at the tip of your thumb whether you're left- or right-handed.",
             'overall_rating'   => 3,
             'prod_img_path'  => "http://pisces.bbystatic.com/image2/BestBuy_US/images/products/4313/4313104_sd.jpg"
            ]
        );
        Product::create(
            [
             'prod_name'        => 'Galaxy Note 5" ',
             'prod_model'       => 'SPHN92032BKS',
             'prod_brand'       => $brand_id,
             'prod_category'    => $category_id,
             'prod_description' => "Built for convenience and productivity, the Note5 includes a high-precision, pressure-sensitive S Pen stylus that stays safely tucked inside the phone's body until you click it. Once you slide the S Pen out, you can write notes on the screen, regardless of whether the screen is powered on or off. Plus, the Note5 is compatible with wireless charging pads (sold separately,) letting you quickly charge the battery without a cord.",
             'overall_rating'   => 3,
             'prod_img_path'  => "http://pisces.bbystatic.com/image2/BestBuy_US/images/products/4311/4311302_sd.jpg"
            ]
        );
    }
}


// -- Features -- //
class FeatureTableSeeder extends Seeder 
{
    public function run()
    {
        // Delete current products
        DB::table('features')->delete();

        // Setup some basic features
        $screen_id      = DB::table('features')->insertGetId(['feature_name' => 'Screen']);
        $battery_id     = DB::table('features')->insertGetId(['feature_name' => 'Battery']);
        $processor_id   = DB::table('features')->insertGetId(['feature_name' => 'Processor']);
        $memsize_id     = DB::table('features')->insertGetId(['feature_name' => 'Memory Size']);

        // Delete feature rating totals
        DB::table('feature_rating_totals')->delete();

        // Samsung Galaxy S6 Edge+ -> Features
        $product_id = Product::where('prod_model', 'SMG928VZDA')->first()->prod_id;
        DB::table('feature_rating_totals')->insert(
            [
             'prod_id'      => $product_id,
             'feature_id'   => $screen_id,
             'score'        => 9000,
             'total_votes'  => 9999
            ]
        );
        DB::table('feature_rating_totals')->insert(
            [
             'prod_id'      => $product_id,
             'feature_id'   => $battery_id,
             'score'        => 5000,
             'total_votes'  => 9000
            ]
        );
        DB::table('feature_rating_totals')->insert(
            [
             'prod_id'      => $product_id,
             'feature_id'   => $processor_id,
             'score'        => 5000,
             'total_votes'  => 9000
            ]
        );
        DB::table('feature_rating_totals')->insert(
            [
             'prod_id'      => $product_id,
             'feature_id'   => $memsize_id,
             'score'        => 5000,
             'total_votes'  => 9000
            ]
        );
    }
}

