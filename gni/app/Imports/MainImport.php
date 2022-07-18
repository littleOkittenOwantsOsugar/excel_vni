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
            //0 => new FirstSheetImport(), //last part not working
            //1 => new SecondSheetImport(),  //working, MestLU is not done
            2 => new ThirdSheetImport(), //update license area doesnt working, geometry not needed, Agency is downloaded
            //3 => new FourthSheetImport(), //MineralDepositTwo, MestLU is not done
            //4 => new FifthSheetImport(), //MineralDepositTwo is not done
        ];
    }
}
