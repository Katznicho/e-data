<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverView extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Balance', User::count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.users.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),
            Stat::make('Total Users', User::count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.users.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),
            Stat::make('Total Transactions', Transaction::count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.transactions.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),
            Stat::make('Completed Transactions', Transaction::where("status", config("status.payment_status.completed"))->count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.transactions.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),

            Stat::make('Pending Transactions', Transaction::where("status", config("status.payment_status.pending"))->count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.transactions.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),

            Stat::make('Failed Transactions', Transaction::where("status", config("status.payment_status.failed"))->count())
                ->icon('heroicon-o-arrow-trending-up')
                ->description('Total number of transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 9])
                ->url(route("filament.admin.resources.transactions.index"))
                ->extraAttributes([
                    'class' => 'text-white text-lg cursor-pointer',
                ]),
        ];
    }
}
