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
use App\Models\UsageCount;
use App\Models\Software;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'devices';
    protected $fillable = [
        'name',
        'configuration',
        'image',
        'status',
        'color',
        'configuration',
        'category_id',
        'purchase_price'
    ];

    public function imageUrl(){
        return 'public/image/device/' .$this->image;
    }
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

    public function repairDetail()
    {
        return $this->hasOneThrough(RepairDetail::class, Repair::class);
    }

    public function warrantyDetail()
    {
        return $this->hasOneThrough(WarrantyDetail::class, Warranty::class);
    }

    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }

    public function usageCount()
    {
        return $this->hasOneThrough(UsageCount::class, UseHistory::class);
    }

    public function softwares()
    {
        return $this->hasMany(Software::class);
    }
}
