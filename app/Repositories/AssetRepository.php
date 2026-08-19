<?php 

namespace App\Repositories;
use App\Contracts\AssetRepositoryInterface;
use App\Models\Asset;

class AssetRepository implements AssetRepositoryInterface {
    public function GetAllAssets(){
        return Asset::with('category')->get();
    }

    public function Paginate(int $perpage = 10, array $filter = []){
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
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Filter by location
        if (!empty($filters['location'])) {
            $query->where('location', 'like', "%{$filters['location']}%");
        }

        return $query->latest()->paginate($perPage);
    }

    public function GetById(int $id){
        return Asset::with(['category', 'assignments.user', 'currentAssignment.user'])->find($id);
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