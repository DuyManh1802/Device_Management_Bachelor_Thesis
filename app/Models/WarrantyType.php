<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warranty;

class WarrantyType extends Model
{
    use HasFactory;

    public function waranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
