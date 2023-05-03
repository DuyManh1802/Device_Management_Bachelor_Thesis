<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repair;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'repair_details';
    protected $fillable = ['content',
        'cost',
        'result',
        'content',
        'repair_id'
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }

    public function device()
    {
        return $this->hasOneThrough(Device::class, Repair::class);
    }
}
