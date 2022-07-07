<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $primaryKey='id_license';

    protected $fillable=[
        'id_company',
        'id_license_area',
        'id_agency',
        'id_status',
        'PreviousLicense',//links to another license
        'TypeOfPrimaryMineral',
        'DateOfRegistration',
        'DateOfEnding',
        'DateOfСancellation',
        'Seria',
        'Number',
        'Type',
        'SpecialPurpose'
    ];
}
