<?php

namespace App\Imports;

use App\Models\LicenseArea;
use App\Models\StatusOfLicense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SecondSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    

    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) 
            {
                $LAtemp=explode(" (", $row[4] );//Восточно - Ачисинский (Улашкент) (МАХ00704НР)
                //Восточно - Ачисинский, Улашкент), МАХ00704НР)
        
                StatusOfLicense::firstorcreate([
                    'NameStatus' => $row[0]
                ]);
                
                if (array_key_exists(1, $LAtemp)){
                    $LAtemp=(string)$LAtemp;
                    $LAtemp=substr($LAtemp, 0, -1);
                    //Восточно - Ачисинский, Улашкент)
                    $LAtemp=(object)$LAtemp;
                    $LAtemp->implode(' (', $LAtemp);//??? implode(separator,array) 
                    //Восточно - Ачисинский (Улашкент)
                };

                LicenseArea::create([
                    'NameLicenseArea' => $LAtemp//the last() 
                ]);
            }
    }
}
