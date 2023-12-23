<?php

namespace App\Filament\Resources\BundlePackageResource\Pages;

use App\Filament\Resources\BundlePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBundlePackage extends ViewRecord
{
    protected static string $resource = BundlePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
