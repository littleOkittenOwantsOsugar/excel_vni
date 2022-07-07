<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalDistrict extends Model
{
    use HasFactory;

    protected $primaryKey='id_district';

    protected $fillable=[
        'NameDistrict'
    ];
}
