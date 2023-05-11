<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class Liquidation extends Model
{
    use HasFactory;

    protected $table = 'liquidations';
    protected $fillable = [
        'id',
        'device_id',
        'price',
        'note'
    ];

    public function device()
    {
        return $this->hasOne(Device::class);
    }
}
