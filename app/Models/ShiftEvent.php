<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'use_id','name',
        'start_date',
        'end_date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
