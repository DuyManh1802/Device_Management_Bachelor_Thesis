<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\WarrantyDetail;

class Warranty extends Model
{
    use HasFactory;

    protected $table = 'warranties';

    protected $fillable = [
        'warranty_count',
        'device_id',
        'type',
        'start',
        'end'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function warrantyDetail()
    {
        return $this->hasOne(WarrantyDetail::class);
    }

}
