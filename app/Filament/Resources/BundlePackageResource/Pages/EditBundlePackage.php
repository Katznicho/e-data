<?php

namespace App\Filament\Resources\BundlePackageResource\Pages;

use App\Filament\Resources\BundlePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBundlePackage extends EditRecord
{
    protected static string $resource = BundlePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
