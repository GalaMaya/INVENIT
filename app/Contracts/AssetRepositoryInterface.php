<?php

namespace App\Contracts;


interface AssetRepositoryInterface {
    public function GetAllAssets();
    public function Paginate(int $perpage = 10, array $filter = []);
    public function GetRecentAssets(int $limit = 0);
    public function GetById(int $id);
    public function Create(array $data);
    public function Update(int $id, array $data);
    public function Delete(int $id);
    public function CountByStatus(String $status);
    public function GetAvailable();
}