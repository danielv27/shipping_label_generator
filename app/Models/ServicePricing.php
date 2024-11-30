<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrier_service_id',
        'min_weight',
        'max_weight',
        'price',
    ];

    public function service()
    {
        return $this->belongsTo(CarrierService::class);
    }
}
