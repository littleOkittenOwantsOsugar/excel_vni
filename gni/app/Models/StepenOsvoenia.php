<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepenOsvoenia extends Model
{
    use HasFactory;

    protected $primaryKey='id_osvoenie';

    protected $fillable=[
        'NameStepen'
    ];
}
