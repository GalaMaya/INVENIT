<?php

namespace App\Services;

use App\Contracts\AssetRepositoryInterface;
use App\Contracts\AssetServiceInterface;
use App\Models\Category;

class AssetService implements AssetServiceInterface {

    protected AssetRepositoryInterface $assetRepository;

    public function __construct(AssetRepositoryInterface $assetRepository){
        $this->assetRepository = $assetRepository;
    }

   
    public function Dashboard()
    {
        return [
            'TotalAssets' => $this->assetRepository->GetAllAssets()->count(),
            'TotalAvailable' => $this->assetRepository->CountByStatus('available'),
            'TotalDamaged' => $this->assetRepository->CountByStatus('damaged'),
            'TotalInUse' => $this->assetRepository->CountByStatus('in_use')
        ];
    }

    public function GetRecentAssets(int $limit =  0)
    {
        return $this->assetRepository->GetRecentAssets($limit);
    }

    public function GetPaginateAssets(int $paginate = 5, array $filter = []){
        return $this->assetRepository->Paginate($paginate, $filter);
    }

    public function GetCategory() {
        return Category::all();
    }
}