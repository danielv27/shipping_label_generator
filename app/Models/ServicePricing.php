<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePricing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'carrier_service_id',
        'min_weight',
        'max_weight',
        'price',
    ];

    /**
     * Relationship to CarrierService.
     */
    public function carrierService()
    {
        return $this->belongsTo(CarrierService::class);
    }
}
