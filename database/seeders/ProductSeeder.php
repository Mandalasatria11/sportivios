<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'AeroGlide Pro X Running Shoes',
                'category' => 'shoes',
                'sub_category' => "Men's Running Shoes",
                'description' => 'Sepatu lari performa tinggi dengan bantalan Kinetic-React Foam yang empuk dan sol karet berdaya cengkeram optimal untuk jarak maraton.',
                'price' => 1899000,
                'stock' => 18,
                'badge' => 'NEW RELEASE',
                'badge_type' => 'cyan',
                'sizes' => '39, 40, 41, 42, 43, 44',
                'image' => 'images/products/shoe.jpg',
            ],
            [
                'name' => 'AeroSprint Pro Elite Runners',
                'category' => 'shoes',
                'sub_category' => 'Footwear • Racing',
                'description' => 'Sepatu kompetisi ultra ringan dengan pelat serat karbon responsif dan material mesh breathable untuk kenyamanan maksimal.',
                'price' => 2450000,
                'stock' => 12,
                'badge' => 'POPULAR',
                'badge_type' => 'cyan',
                'sizes' => '39, 40, 41, 42, 43, 44',
                'image' => 'images/products/shoe-action.jpg',
            ],
            [
                'name' => 'BreathePro Seamless Training Tee',
                'category' => 'apparel',
                'sub_category' => 'Training Apparel',
                'description' => 'Kaos olahraga atletik berteknologi cepat kering (anti-odor & quick-dry) dengan rajutan mikro tanpa keliman samping.',
                'price' => 389000,
                'stock' => 25,
                'badge' => null,
                'badge_type' => 'cyan',
                'sizes' => 'S, M, L, XL, XXL',
                'image' => 'images/products/tee.jpg',
            ],
            [
                'name' => 'Core Compression High-Waist Tights',
                'category' => 'apparel',
                'sub_category' => "Women's Training",
                'description' => 'Celana kompresi elastis dengan saku samping untuk ponsel, memberikan topangan otot optimal dan kenyamanan sepanjang hari.',
                'price' => 699000,
                'stock' => 15,
                'badge' => 'SALE',
                'badge_type' => 'red',
                'sizes' => 'S, M, L, XL',
                'image' => 'images/products/tights.jpg',
            ],
            [
                'name' => 'Velocity Wind Shield Lightweight Jacket',
                'category' => 'apparel',
                'sub_category' => 'Outerwear Jacket',
                'description' => 'Jaket lari tahan angin dan percikan air (water-repellent) dengan strip reflektif untuk keamanan latihan di malam hari.',
                'price' => 1250000,
                'stock' => 10,
                'badge' => null,
                'badge_type' => 'cyan',
                'sizes' => 'S, M, L, XL, XXL',
                'image' => 'images/products/jacket.jpg',
            ],
            [
                'name' => 'HydroFlow Smart Thermal Flask',
                'category' => 'accessories',
                'sub_category' => 'Sports Accessories',
                'description' => 'Botol minum pintar dengan display LED temperatur dan isolasi suhu dingin hingga 24 jam.',
                'price' => 350000,
                'stock' => 30,
                'badge' => 'HOT',
                'badge_type' => 'red',
                'sizes' => 'All Size',
                'image' => 'images/products/flask.jpg',
            ],
            [
                'name' => 'Titan Grip Silicone Lifting Gloves',
                'category' => 'accessories',
                'sub_category' => 'Gym Accessories',
                'description' => 'Sarung tangan angkat beban berkekuatan tinggi dengan strap pergelangan tangan terintegrasi dan bantalan silikon anti-slip.',
                'price' => 279000,
                'stock' => 20,
                'badge' => 'LIMITED STOCK',
                'badge_type' => 'red',
                'sizes' => 'M, L, XL',
                'image' => 'images/products/gloves.jpg',
            ],
            [
                'name' => 'Core Duffel Sport Bag 40L',
                'category' => 'accessories',
                'sub_category' => 'Gym & Travel Bag',
                'description' => 'Tas gym waterproof 40 liter dengan kompartemen khusus sepatu berventilasi dan saku pakaian basah.',
                'price' => 599000,
                'stock' => 14,
                'badge' => 'SALE',
                'badge_type' => 'red',
                'sizes' => 'All Size',
                'image' => 'images/products/duffel.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
