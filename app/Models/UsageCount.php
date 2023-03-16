<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UseHistory;

class UsageCount extends Model
{
    use HasFactory;

    protected $table = 'usage_counts';
    protected $fillable = [
        'usage_count'
    ];

    public function useHistory()
    {
        return $this->belongsTo(UseHistory::class);
    }
}