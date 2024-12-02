<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'recipient_name',
        'recipient_street',
        'recipient_postal_code',
        'recipient_city',
        'recipient_country',
        'carrier_service_id',
    ];

    public function carrierService()
    {
        return $this->belongsTo(CarrierService::class);
    }
}

