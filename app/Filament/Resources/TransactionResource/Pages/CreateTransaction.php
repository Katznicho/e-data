<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Payments\Pesapal;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateTransaction extends CreateRecord
{

    private string $redirectUrl;
    protected static string $resource = TransactionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->redirectUrl;
        if ($this->redirectUrl) {
            return $this->redirectUrl;
        }
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Transaction registered successfully')
            ->body('The transaction has been registered successfully');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $reference =  Str::uuid();
        $customer_names  = Auth::user()->name;
        $customer_email  =  Auth::user()->email;
        $customer_id  =  Auth::user()->id;
        $callback_url  =  "https://124f-41-75-176-200.ngrok-free.app/finishPayment";
        $cancel_url  =  "https://124f-41-75-176-200.ngrok-free.app/cancelPayment";



        $data['user_id'] = Auth::user()->id;
        $data['type'] = config("transaction_type.types.credit");
        $data['payment_mode'] = "Web";
        $data['reference'] =  $reference;
        $data['status'] = config("status.payment_status.pending");

        $res =  Pesapal::orderProcess($reference, $data['amount'], $data['phone_number'], $data['description'], $callback_url, $customer_names, $customer_email, $customer_id, $cancel_url);


        if ($res->success) {
            $this->redirectUrl = $res->message->redirect_url;
        }
        return $data;
    }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated with their default values.
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated with their default values.
    }

    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is submitted.
    }

    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is submitted.
    }

    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
    }

    protected function afterCreate(): void
    {
    }
}
