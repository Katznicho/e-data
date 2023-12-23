<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use Cheesegrits\FilamentPhoneNumbers;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneInputColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;



    protected static ?string $navigationIcon = 'heroicon-s-arrow-path';

    protected static ?string $navigationGroup = 'Payments';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->prefix("UGX")
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                    ->required()
                    ->numeric()
                    ->placeholder("enter amount")
                    ->maxLength(255)
                    ->minValue(500)
                    ->label("Amount"),
                // Forms\Components\TextInput::make('phone_number')
                //     ->tel()
                //     ->required()
                //     ->placeholder("enter phone number")
                //     ->maxLength(255)
                //     ->label("Phone Number"),
                // FilamentPhoneNumbers\Forms\Components\PhoneNumber::make('phone'),
                PhoneInput::make('phone_number')
                    ->displayNumberFormat(PhoneInputNumberType::E164)
                    ->inputNumberFormat(PhoneInputNumberType::NATIONAL)

                    ->required()
                    ->label("Phone Number")
                    ->placeholder("Enter Phone Number"),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->placeholder("enter description")
                    ->label("Description"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->copyMessage('Name copied!')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('type copied')
                    ->label('Type')
                    ->color(
                        fn (Transaction $record): string => match ($record->type) {
                            config('transaction_type.types.credit') => 'success',
                            config("transaction_type.types.debit") => 'danger',
                        }
                    ),
                Tables\Columns\TextColumn::make('amount')
                    ->currency('UGX')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->label("Amount")
                    ->copyMessage('amount')
                    ->color("success"),
                PhoneInputColumn::make('phone_number')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('phone number copied')
                    ->label('Phone Number'),
                Tables\Columns\TextColumn::make('payment_mode')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('payment mode copied')
                    ->label('Payment Mode'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('payment method copied')
                    ->label('Payment Method'),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('reference copied')
                    ->label('Payment Reference'),
                Tables\Columns\TextColumn::make('order_tracking_id')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('tracking id copied')
                    ->label('Tracking Id'),
                Tables\Columns\TextColumn::make('OrderNotificationType')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('notification id copied')
                    ->label('Notification Type'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        "pending" => "Pending",
                        "completed" => "Completed",
                        "failed" => "Failed",

                    ])
                    ->label('Status'),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([

                //ExportBulkAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
