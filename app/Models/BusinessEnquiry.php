<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquirer_name',
        'enquirer_email',
        'enquirer_mobile',
        'enquirer_message',
        'enquirer_check',
        'enquirer_status'
    ];

    protected $casts = [
        'enquirer_check' => 'boolean',
    ];
}
