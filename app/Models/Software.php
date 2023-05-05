<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
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

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'device_softwares', 'device_id', 'software_id');
    }

    public function device_softwares()
    {
        return $this->hasMany(DeviceSoftware::class);
    }
}
