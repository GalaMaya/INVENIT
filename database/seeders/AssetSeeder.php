<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\Category;
use Faker\Factory as Faker;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $categories = Category::all();
        
        // Distribusi status: 15 available, 10 in_use, 5 damaged
        $statuses = array_merge(
            array_fill(0, 15, 'available'),
            array_fill(0, 10, 'in_use'),
            array_fill(0, 5, 'damaged')
        );
        
        shuffle($statuses); // Acak urutan status
        
        $locations = [
            'Gudang Lantai 1',
            'Gudang Lantai 2',
            'Rak Server A',
            'Rak Server B',
            'Ruang Meeting Lt. 2',
            'Ruang Meeting Lt. 3',
            'Meja Kerja - Divisi IT',
            'Meja Kerja - Divisi Finance',
            'Meja Kerja - Divisi HR',
            'Meja Kerja - Divisi Marketing',
        ];
        
        $brands = [
            'Laptop' => ['Apple', 'Dell', 'Lenovo', 'HP', 'Asus'],
            'PC Desktop' => ['Dell', 'HP', 'Lenovo', 'Custom Build'],
            'Monitor' => ['Dell', 'LG', 'Samsung', 'Asus', 'AOC'],
            'Printer' => ['HP', 'Canon', 'Epson', 'Brother'],
            'Networking' => ['Cisco', 'Mikrotik', 'TP-Link', 'Ubiquiti'],
            'Peripheral' => ['Logitech', 'Razer', 'Microsoft', 'Apple'],
        ];
        
        for ($i = 0; $i < 30; $i++) {
            $category = $categories->random();
            $status = $statuses[$i];
            
            $brandList = $brands[$category->name] ?? ['Generic'];
            $brand = $faker->randomElement($brandList);
            
            Asset::create([
                'category_id' => $category->id,
                'name' => $this->generateAssetName($category->name, $brand, $faker),
                'brand' => $brand,
                'model' => $faker->bothify('Model-###??'),
                'serial_number' => $faker->unique()->bothify('SN-##########'),
                'status' => $status,
                'location' => $faker->randomElement($locations),
                'purchase_date' => $faker->dateTimeBetween('-3 years', 'now'),
                'notes' => $this->generateNotes($status, $faker),
            ]);
        }
    }
    
    private function generateAssetName($category, $brand, $faker): string
    {
        return match($category) {
            'Laptop' => "$brand " . $faker->randomElement(['MacBook Pro', 'XPS', 'ThinkPad', 'EliteBook', 'VivoBook']),
            'PC Desktop' => "$brand " . $faker->randomElement(['OptiPlex', 'ProDesk', 'ThinkCentre', 'ProDesk']),
            'Monitor' => "$brand " . $faker->randomElement(['UltraSharp 27"', 'UltraGear 32"', 'Curved 24"', '4K Display']),
            'Printer' => "$brand " . $faker->randomElement(['LaserJet Pro', 'Pixma', 'EcoTank', 'HL-L series']),
            'Networking' => "$brand " . $faker->randomElement(['Router RB series', 'Switch 24-Port', 'Access Point', 'Firewall']),
            'Peripheral' => "$brand " . $faker->randomElement(['Keyboard Mechanical', 'Mouse Wireless', 'Webcam HD', 'Headset']),
            default => "$brand Device",
        };
    }
    
    private function generateNotes($status, $faker): ?string
    {
        return match($status) {
            'available' => $faker->randomElement([
                'Unit baru dari vendor, masih segel',
                'Ex-karyawan, sudah direset factory',
                'Siap untuk deployment',
                null,
            ]),
            'in_use' => $faker->randomElement([
                'Digunakan untuk project A',
                'Unit utama untuk daily operation',
                null,
            ]),
            'damaged' => $faker->randomElement([
                'Layar retak, perlu replacement',
                'Port USB tidak berfungsi, sedang di-service',
                'Battery drop, perlu penggantian',
                'Tidak bisa booting, diduga hardware failure',
                'Keyboard beberapa tombol macet',
            ]),
            default => null,
        };
    }
}