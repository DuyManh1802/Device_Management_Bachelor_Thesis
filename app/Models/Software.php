<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class Software extends Model
{
    use HasFactory;

    protected $table = 'softwares';
    protected $fillable = [
        'name',
        'version',
        'start',
        'end',
        'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}