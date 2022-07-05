<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOfLicense extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_status',
        'NameStatus'
    ];
}
