<?php

namespace App\Livewire\Assets;

use App\Contracts\AssetServiceInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // state Filter & Search
    public $search = '';
    public $filterStatus = 'all';
    public $filterCategory = 'all';
    public $perPage = 5;

    // query string
    public $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'filterCategory' => ['except' => ''],
    ];

    // resets 
    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingFilterStatus() {
        $this->resetPage();
    }

    public function updatingFilterCategory() {
        $this->resetPage();
    }

    public function UpdatingPerPage() {
        $this->resetPage();
    }

    // method
    public function render(AssetServiceInterface $assetServiceInterface)
    {

        $filter = [
            'search' => $this->search,
            'status' => $this->filterStatus,
            'category_id' => $this->filterCategory,
        ];

        $assets = $assetServiceInterface->GetPaginateAssets($this->perPage, $filter);
        $category = $assetServiceInterface->GetCategory();

        return view('livewire.assets.index', [
            'assets' => $assets,
            'categories' => $category,
        ])->layout('layouts.app');
    }
}
