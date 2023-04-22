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
        'license_price',
        'license_key',
        'usage_count',
        'image'
    ];

    // public function devices()
    // {
    //     return $this->hasManyThrough(Device::class, DeviceSoftware::class);
    // }

    public function device_softwares()
    {
        return $this->hasMany(DeviceSoftware::class);
    }
}
