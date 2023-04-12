<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Device;
use App\Models\Software;

class DeviceSoftware extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'device_softwares';
    protected $fillable = [
        'device_id',
        'software_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
