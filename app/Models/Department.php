<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Request;
use App\Models\Device;
use App\Models\UseHistory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departments';
    protected $fillable = [
        'name',
        'manager',
        'address',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class);
    }

    public function useHistories()
    {
        return $this->hasMany(UseHistory::class);
    }
}