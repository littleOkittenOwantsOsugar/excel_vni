<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseArea extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_license_area',
        'NameLicenseArea',
        'Geometry'
    ];
}
