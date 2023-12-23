<?php

namespace App\Filament\Resources\NetworkProviderResource\Pages;

use App\Filament\Resources\NetworkProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNetworkProviders extends ListRecords
{
    protected static string $resource = NetworkProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
