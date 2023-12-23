<?php

namespace App\Filament\Resources\BundleDataTypeResource\Pages;

use App\Filament\Resources\BundleDataTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBundleDataType extends ViewRecord
{
    protected static string $resource = BundleDataTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
