<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundlePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'validity_id',
        'network_provider_id',
        'name',
        'data_amount',
        'minutes',
        'sms',
        'price',
        'discount',
        'type',
        'description'
    ];
}
