<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repair;

class RepairDetail extends Model
{
    use HasFactory;

    protected $table = 'repair_details';
    protected $fillable = ['content',
        'cost',
        'result',
        'repair_id'
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}