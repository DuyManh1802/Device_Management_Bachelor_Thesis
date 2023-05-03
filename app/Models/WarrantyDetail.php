<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warranty;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarrantyDetail extends Model
{
    use HasFactory;

    protected $table = 'warranty_details';
    protected $fillable = [
        'content',
        'result',
        'warranty_id'
    ];

    public function waranty()
    {
        return $this->belongsTo(Warranty::class);
    }

    public function device()
    {
        return $this->hasOneThrough(Device::class, Warranty::class);
    }
}
