<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\WarrantyDetail;
use App\Models\WarrantyType;

class Warranty extends Model
{
    use HasFactory;

    protected $table = 'warranties';

    protected $fillable = [
        'warranty_count',
        'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function warrantyDetail()
    {
        return $this->hasOne(WarrantyDetail::class);
    }

    public function warrantyTypes()
    {
        return $this->hasMany(WarrantyType::class);
    }
}
