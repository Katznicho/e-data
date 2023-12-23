<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "phone_number"
    ];

    //message belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}