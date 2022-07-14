<?php

namespace App\Imports;

use App\Models\LicenseArea;
use App\Models\StatusOfLicense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SecondSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows) //done
    {    
        foreach ($rows as $row)
            {

                $LAtemp=explode(" (", $row["licenzionnyi_ucastok_licenziia"] );
                //dd($LAtemp);
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
                elseif (array_key_exists(0, $LAtemp) && !array_key_exists(1, $LAtemp)) {//skip part where no license
                    $LAtemp1=$LAtemp[0]; 
                }
                else {
                    //var_dump($LAtemp);
                    $LAtemp1=$row["licenzionnyi_ucastok_licenziia"];
                }
                    //[Восточно - Ачисинский (Улашкент)]
                
                LicenseArea::create([
                    'NameLicenseArea' => $LAtemp1
                ]);
            }
    }
}
