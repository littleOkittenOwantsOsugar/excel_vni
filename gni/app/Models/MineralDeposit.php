<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MineralDeposit extends Model
{
    use HasFactory;

    protected $primaryKey='id_deposit';

    protected $fillable=[
        'id_osvoenie',
        'DepostName',
        'Coordinates'
    ];
}
