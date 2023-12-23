<?php

namespace App\Filament\Resources\BundleDataTypeResource\Pages;

use App\Filament\Resources\BundleDataTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBundleDataType extends EditRecord
{
    protected static string $resource = BundleDataTypeResource::class;

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
