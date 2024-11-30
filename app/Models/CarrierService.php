<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierService extends Model
{
    use HasFactory;

    protected $fillable = ['carrier_id', 'name', 'scope'];

    /**
     * Relationship to Carrier.
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    /**
     * Relationship to ServicePricing.
     */
    public function pricing()
    {
        return $this->hasMany(ServicePricing::class);
    }
}
