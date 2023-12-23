<?php

namespace App\Filament\Resources\BundlePackageResource\Pages;

use App\Filament\Resources\BundlePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBundlePackages extends ListRecords
{
    protected static string $resource = BundlePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
