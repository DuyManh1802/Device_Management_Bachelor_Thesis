<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\UseHistory;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function scopeMonday($query)
    {
        $lastMonday = Carbon::parse('last monday');

        return $query->whereDate('created_at', $lastMonday);
    }

    public function scopeTuesday($query)
    {
        $lastTuesday = Carbon::parse('last tuesday');
        // $today = Carbon::today();
        // $daysDiff = $today->diffInDays($lastTuesday, true);
        // ($daysDiff < 7) ? $lastTuesday->subDays(7) : $lastTuesday;

        return $query->whereDate('created_at', $lastTuesday);
    }

    public function scopeWednesday($query)
    {
        $lastWednesday = Carbon::parse('last wednesday');

        return $query->whereDate('created_at', $lastWednesday);
    }

    public function scopeThursday($query)
    {
        $lastThursday = Carbon::parse('last thursday');

        return $query->whereDate('created_at', $lastThursday);
    }

    public function scopeFriday($query)
    {
        $lastFriday = Carbon::parse('last friday');

        return $query->whereDate('created_at', $lastFriday);
    }

    public function scopeSaturday($query)
    {
        $lastSaturday = Carbon::parse('last saturday');

        return $query->whereDate('created_at', $lastSaturday);
    }

    public function scopeSunday($query)
    {
        $lastSunday = Carbon::parse('last sunday');

        return $query->whereDate('created_at', $lastSunday);
    }
}
