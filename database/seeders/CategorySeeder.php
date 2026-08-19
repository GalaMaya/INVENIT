<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laptop',
                'description' => 'Laptop karyawan untuk mobilitas tinggi'
            ],
            [
                'name' => 'PC Desktop',
                'description' => 'Komputer desktop untuk workstation'
            ],
            [
                'name' => 'Monitor',
                'description' => 'Layar eksternal untuk workstation'
            ],
            [
                'name' => 'Printer',
                'description' => 'Printer untuk kebutuhan cetak dokumen'
            ],
            [
                'name' => 'Networking',
                'description' => 'Perangkat jaringan seperti router, switch, access point'
            ],
            [
                'name' => 'Peripheral',
                'description' => 'Aksesoris seperti keyboard, mouse, webcam, headset'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}