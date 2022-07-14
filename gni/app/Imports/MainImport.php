<?php

namespace App\Imports;

use App\Imports\FirstSheetImport;
use App\Imports\SecondSheetImport;
use App\Imports\ThirdSheetImport;
use App\Imports\FourthSheetImport;
use App\Imports\FifthSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainImport implements WithMultipleSheets
{
    
    public function sheets(): array
    {
        return [
            //0 => new FirstSheetImport(),
            //1 => new SecondSheetImport(),  //working
            //2 => new ThirdSheetImport(), //update license area doesnt working
            //3 => new FourthSheetImport(), //MineralDepositTwo and MestLU isnt done yet, MineralDeposit and StepenOsvoenia is done
            //4 => new FifthSheetImport(), //working
        ];
    }
}
