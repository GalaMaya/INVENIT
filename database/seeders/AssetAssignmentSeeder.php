<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\User;
use App\Models\AssetAssignment;
use Faker\Factory as Faker;

class AssetAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // 1. Ambil semua aset yang statusnya 'in_use'
        $inUseAssets = Asset::where('status', 'in_use')->get();
        
        // 2. Ambil SEMUA user, lalu skip user pertama (admin) menggunakan Collection method `slice`
        // Ini menghindari error MySQL "OFFSET without LIMIT"
        $allUsers = User::all();
        $users = $allUsers->count() > 1 ? $allUsers->slice(1) : $allUsers;
        
        // Fallback jika user kosong (seharusnya tidak terjadi karena UserSeeder jalan duluan)
        if ($users->isEmpty()) {
            $users = $allUsers;
        }
        
        $adminUser = $allUsers->first(); // Untuk kolom assigned_by
        
        // 3. Loop untuk assign aset yang sedang 'in_use'
        foreach ($inUseAssets as $asset) {
            $user = $users->random();
            
            AssetAssignment::create([
                'asset_id' => $asset->id,
                'user_id' => $user->id,
                'assigned_by' => $adminUser?->id, 
                'assigned_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'returned_at' => null, // Masih aktif
                'handover_notes' => $faker->randomElement([
                    'Unit sudah direset dan diinstall software standar',
                    'Diserahkan beserta charger dan tas laptop',
                    'Lengkap dengan mouse dan keyboard eksternal',
                    'Unit baru, masih garansi resmi',
                    null,
                ]),
            ]);
        }
        
        // 4. Tambahkan riwayat assignment lama (untuk simulasi history)
        $availableAssets = Asset::where('status', 'available')->take(5)->get();
        
        foreach ($availableAssets as $asset) {
            $user = $users->random();
            
            AssetAssignment::create([
                'asset_id' => $asset->id,
                'user_id' => $user->id,
                'assigned_by' => $adminUser?->id,
                'assigned_at' => $faker->dateTimeBetween('-2 years', '-1 year'),
                'returned_at' => $faker->dateTimeBetween('-1 year', '-6 months'),
                'handover_notes' => 'Dikembalikan saat user resign / mutasi',
            ]);
        }
    }
}