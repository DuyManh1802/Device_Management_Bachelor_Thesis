<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repair;
use App\Models\Request;
use App\Models\UseHistory;
use App\Models\User;
use App\Models\Department;
use App\Models\SubCategory;
use App\Models\RepairDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'devices';
    protected $fillable = [
        'name',
        'configuration',
        'image',
        'status',
        'quantity',
        'start',
        'end'
    ];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function useHistories()
    {
        return $this->hasMany(UseHistory::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function repairDetail()
    {
        return $this->hasOneThrough(RepairDetail::class, Repair::class);
    }
}