<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UseHistory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsageCount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'usage_counts';
    protected $fillable = [
        'usage_count',
        'resale_price',
        'use_hitory_id'
    ];

    public function useHistory()
    {
        return $this->belongsTo(UseHistory::class);
    }
}
