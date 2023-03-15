<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repair;

class TypeRepair extends Model
{
    use HasFactory;

    protected $table = 'type_repairs';

    protected $fillable = ['type'];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}