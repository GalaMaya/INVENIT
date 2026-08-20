<?php

namespace App\Contracts;

interface AssetServiceInterface {
    public function Dashboard();
    public function GetRecentAssets(int $limit = 0);
    public function GetPaginateAssets(int $paginate = 5, array $filter = []);
    public function GetCategory();
    // Additional methods can be added here
    // public function AssignAsset(int $id, int $userId, ?string $note = null);
    // public function ReturnAsset(int $id, string $condition = "Available", ?string $note = null);
    // public function MarkDamage(int $id, ?string $note = null);
}