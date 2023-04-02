<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\UseHistory;
use App\Models\User;
use App\Models\Department;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'status',
        'description',
        'result',
        'user_id',
        'device_id',
        'department_id'
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

    public function useHistory()
    {
        return $this->hasOne(UseHistory::class);
    }
}
