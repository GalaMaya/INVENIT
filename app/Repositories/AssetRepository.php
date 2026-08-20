<?php 

namespace App\Repositories;
use App\Contracts\AssetRepositoryInterface;
use App\Models\Asset;

class AssetRepository implements AssetRepositoryInterface {
    public function GetAllAssets(){
        return Asset::with('category')->get();
    }

    public function Paginate(int $perPage = 10, array $filters = []){
        $query = Asset::with(['category', 'currentAssignment.user']);

        // Filter by search
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        // Filter by category
        if (!empty($filters['category_id']) && $filters['category_id'] !== 'all') {
            $query->where('category_id', $filters['category_id']);
        }

        // Filter by location
        if (!empty($filters['location']) && $filters['location']) {
            $query->where('location', 'like', "%{$filters['location']}%");
        }

        return $query->latest()->simplePaginate($perPage);
    }

    public function GetById(int $id){
        return Asset::with(['category', 'assignments.user', 'currentAssignment.user'])->find($id);
    }

    public function GetRecentAssets(int $limit = 0){
        return Asset::with('category')->latest()->take($limit)->get();
    }

    public function Create(array $data){
        return Asset::create($data);
    }

    public function Update(int $id, array $data){
        $asset = Asset::findOrFail($id);
        return $asset->update($data);
    }

    public function Delete(int $id){
        return Asset::destroy($id);
    }

    public function CountByStatus(String $status){
        return Asset::where('status', $status)->count();
    }

    public function GetAvailable(){
        return Asset::available()->with('category')->get();
    }
}