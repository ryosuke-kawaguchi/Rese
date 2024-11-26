<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_name', 'date', 'time', 'member'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }
}
