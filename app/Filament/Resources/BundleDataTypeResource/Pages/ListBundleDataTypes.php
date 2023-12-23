<?php

namespace App\Filament\Resources\BundleDataTypeResource\Pages;

use App\Filament\Resources\BundleDataTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBundleDataTypes extends ListRecords
{
    protected static string $resource = BundleDataTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
