<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\Department;
use App\Models\User;
use App\Models\Request;
use App\Models\UsageCount;
use Illuminate\Database\Eloquent\SoftDeletes;

class UseHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'use_histories';
    protected $fillable = [
        'user_id',
        'department_id',
        'device_id',
        'request_id',
        'status',
        'borrowed_date',
        'return_date'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function usageCount()
    {
        return $this->hasOne(UsageCount::class);
    }
}
