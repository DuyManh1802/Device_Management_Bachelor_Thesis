<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DeviceSoftware;

class Software extends Model
{
    use HasFactory;

    protected $table = 'softwares';
    protected $fillable = [
        'name',
        'version',
        'start',
        'end',
        'device_id',
        'license_price',
        'image'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function device_softwares()
    {
        return $this->hasMany(DeviceSoftware::class);
    }
}
