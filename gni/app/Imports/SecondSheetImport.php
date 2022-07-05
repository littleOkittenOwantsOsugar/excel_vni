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
                $LAtemp=explode(" (", $row[3] );//Таволожская (Блок А) (СРТ01113НР)
                //Таволожская, Блок А), СРТ01113НР)
        
                StatusOfLicense::firstorcreate([
                    'NameStatus' => $row[0]
                ]);
                
                if (array_key_exists(2, $LAtemp)){
                    $LAtemp=(string)$LAtemp;
                    $LAtemp=substr($LAtemp, 0, -1);
                    $LAtemp=(object)$LAtemp;
                    $LAtemp->implode(" (", );
                };
                    //$LAtemp->implode(" (", )
                

                LicenseArea::create([
                    'NameLicenseArea' //the last() 
                ]);
            }
    }
}
