<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RepairDetail;
use App\Models\TypeRepair;
use App\Models\Device;

class Repair extends Model
{
    use HasFactory;

    protected $table = 'repairs';

    protected $fillable = ['repair_count',
        'device_id'
    ];

    public function repairDetail()
    {
        return $this->hasOne(RepairDetail::class);
    }

    public function typeRepairs()
    {
        return $this->hasMany(TypeRepair::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}