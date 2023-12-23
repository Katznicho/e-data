<?php

namespace App\Filament\Resources\NetworkProviderResource\Pages;

use App\Filament\Resources\NetworkProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNetworkProvider extends EditRecord
{
    protected static string $resource = NetworkProviderResource::class;

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
