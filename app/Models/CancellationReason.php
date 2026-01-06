<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationReason extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'active'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public static function getActiveReasons()
    {
        return self::active()->get();
    }
}
