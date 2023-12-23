<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'payment_mode',
        'reference',
        'amount',
        'description',
        'phone_number',
        'status',
        'order_tracking_id',
        'OrderNotificationType',

    ];

    // a transaction belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
