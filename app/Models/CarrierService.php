<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierService extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pricing()
    {
        return $this->hasMany(Pricing::class);
    }
}
