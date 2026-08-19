<?php

namespace App\Contracts;

interface AssetServiceInterface {
    public function Dashboard();
    public function GetRecentAssets(int $limit = 0);
    // public function AssignAsset(int $id, int $userId, ?string $note = null);
    // public function ReturnAsset(int $id, string $condition = "Available", ?string $note = null);
    // public function MarkDamage(int $id, ?string $note = null);
}