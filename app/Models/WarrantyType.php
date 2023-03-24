<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warranty;

class WarrantyType extends Model
{
    use HasFactory;

    protected $table = 'usage_counts';
    protected $fillable = [
        'type',
        'start',
        'end',
        'warranty_id'
    ];

    public function waranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
