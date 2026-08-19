<?php

namespace App\Livewire;

use App\Contracts\AssetServiceInterface;
use Livewire\Component;

class Dashboard extends Component
{

    public function render(AssetServiceInterface $assetService)
    {
        $getStat = $assetService->Dashboard();

        $recentAssets = $assetService->GetRecentAssets(5);


        return view('livewire.dashboard', [
            'totalAssets' => $getStat['TotalAssets'],
            'availableAssets' => $getStat['TotalAvailable'],
            'inUseAssets' => $getStat['TotalInUse'],
            'damagedAssets' => $getStat['TotalDamaged'],
            'recentAssets' => $recentAssets
        ])->layout('layouts.app');
    }
}