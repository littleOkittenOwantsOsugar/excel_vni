<?php

namespace App\Imports;

use App\Imports\FirstSheetImport;
use App\Imports\SecondSheetImport;
use App\Imports\ThirdSheetImport;
use App\Imports\FourthSheetImport;
use App\Imports\FifthSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TestingImport implements WithMultipleSheets
{
    
    public function sheets(): array
    {
        //dd('123');
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
            2 => new ThirdSheetImport(),
            3 => new FourthSheetImport(),
            4 => new FifthSheetImport(),
        ];
    }
}
