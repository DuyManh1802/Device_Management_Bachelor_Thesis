<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\UseHistory;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'requests';
    protected $fillable = [
        'status',
        'result',
        'user_id',
        'device_id',
        'department_id',
        'type',
        'start_date',
        'note',
        'confirm'
    ];

    // protected $device_ = [
    //     'device_id' => 'array'
    // ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function useHistory()
    {
        return $this->hasOne(UseHistory::class);
    }
}
