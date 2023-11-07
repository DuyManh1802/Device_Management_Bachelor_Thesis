<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repair;
use App\Models\Request;
use App\Models\UseHistory;
use App\Models\User;
use App\Models\Department;
use App\Models\Category;
use App\Models\RepairDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\WarrantyDetail;
use App\Models\Warranty;
use App\Models\Software;
use App\Models\DeviceSoftware;
use App\Models\Liquidation;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'devices';
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'image',
        'color',
        'configuration',
        'status',
        'condition',
        'purchase_price',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'deleted_at'
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function repairDetails()
    {
        return $this->hasManyThrough(RepairDetail::class, Repair::class);
    }

    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }

    // public function softwares()
    // {
    //     return $this->hasManyThrough(Software::class, DeviceSoftware::class);
    // }

    public function device_softwares()
    {
        return $this->hasMany(DeviceSoftware::class);
    }

    public function warrantyDetails()
    {
        return $this->hasManyThrough(WarrantyDetail::class, Warranty::class);
    }

    public function typeRepairs()
    {
        return $this->hasManyThrough(TypeRepair::class, Repair::class);
    }

    public function softwares()
    {
        return $this->belongsToMany(Software::class, 'device_softwares', 'device_id', 'software_id');
    }

    public function liquidation()
    {
        return $this->hasOne(Liquidation::class);
    }
}
