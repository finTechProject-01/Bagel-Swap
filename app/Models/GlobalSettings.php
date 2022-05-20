<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_invested',
        'cost',
        'opening_date'
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {

        return $this->belongsTo(User::class,'user_id');
    }
}
