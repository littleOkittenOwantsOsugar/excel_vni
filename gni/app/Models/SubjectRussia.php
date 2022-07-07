<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectRussia extends Model
{
    use HasFactory;

    protected $primaryKey='id_subject';

    protected $fillable=[
        'Name',
        'ShortName',
        'id_district'
    ];
}
