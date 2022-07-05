<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectRussia extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_subject',
        'Name',
        'ShortName',
        'id_district'
    ];
}
