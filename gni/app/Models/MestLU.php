<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MestLU extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_deposit',
        'id_license_area'
    ];
}
