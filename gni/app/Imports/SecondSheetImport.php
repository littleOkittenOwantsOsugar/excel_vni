<?php

namespace App\Imports;

use App\Models\LicenseArea;
use App\Models\StatusOfLicense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SecondSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows) //unproofed done
    {    
        foreach ($rows as $row)
            {

                $LAtemp=explode(" (", $row["licenzionnyi_ucastok_licenziia"] );
                $LAtemp1="";

                //Восточно - Ачисинский (Улашкент) (МАХ00704НР)
                //Восточно - Ачисинский, Улашкент), МАХ00704НР)

                StatusOfLicense::firstorcreate([
                    'NameStatus' => $row["sostoianie_licenzii"]
                ]);
                
                array_pop($LAtemp);
                //[Восточно - Ачисинский, Улашкент)]

                if (array_key_exists(1, $LAtemp)){
                    
                    $LAtemp1 = implode(" (", $LAtemp);
                }
                else {
                    //var_dump($LAtemp);
                    $LAtemp1=$LAtemp[0];
                }
                    //[Восточно - Ачисинский (Улашкент)]
                
                LicenseArea::create([
                    'NameLicenseArea' => $LAtemp1
                ]);
            }
    }
}
