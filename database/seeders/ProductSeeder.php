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
                'description' => 'Sepatu lari performa tinggi dengan bantalan Kinetic-React Foam yang empuk dan sol karet berdaya cengkeram optimal untuk jarak maraton.',
                'price' => 1899000,
                'image' => 'images/products/shoe.jpg',
            ],
            [
                'name' => 'AeroSprint Pro Elite Runners',
                'description' => 'Sepatu kompetisi ultra ringan dengan pelat serat karbon responsif dan material mesh breathable untuk kenyamanan maksimal.',
                'price' => 2450000,
                'image' => 'images/products/shoe-action.jpg',
            ],
            [
                'name' => 'BreathePro Seamless Training Tee',
                'description' => 'Kaos olahraga atletik berteknologi cepat kering (anti-odor & quick-dry) dengan rajutan mikro tanpa keliman samping.',
                'price' => 389000,
                'image' => 'images/products/tee.jpg',
            ],
            [
                'name' => 'Core Compression High-Waist Tights',
                'description' => 'Celana kompresi elastis dengan saku samping untuk ponsel, memberikan topangan otot optimal dan kenyamanan sepanjang hari.',
                'price' => 699000,
                'image' => 'images/products/tights.jpg',
            ],
            [
                'name' => 'Velocity Wind Shield Lightweight Jacket',
                'description' => 'Jaket lari tahan angin dan percikan air (water-repellent) dengan strip reflektif untuk keamanan latihan di malam hari.',
                'price' => 1250000,
                'image' => 'images/products/jacket.jpg',
            ],
            [
                'name' => 'Titan Grip Silicone Lifting Gloves',
                'description' => 'Sarung tangan angkat beban berkekuatan tinggi dengan strap pergelangan tangan terintegrasi dan bantalan silikon anti-slip.',
                'price' => 279000,
                'image' => 'images/products/gloves.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
