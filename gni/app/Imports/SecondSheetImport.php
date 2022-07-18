<?php

namespace App\Imports;

use App\Models\LicenseArea;
use App\Models\MestLU;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SecondSheetImport implements ToCollection, WithHeadingRow
{
    
    private $mlu_temp;
    

    public function __construct()
    {
        $this -> mlu_temp = LicenseArea::select('id_license_area', 'NameLicenseArea')->get();
    }

    public function collection(Collection $rows) //done
    {    
        // foreach ($rows as $row)
        //     {

        //         $LAtemp=explode(" (", $row["licenzionnyi_ucastok_licenziia"] );
        //         //dd($LAtemp);
        //         $LAtemp1="";

        //         //Восточно - Ачисинский (Улашкент) (МАХ00704НР)
        //         //Восточно - Ачисинский, Улашкент), МАХ00704НР)
                
        //         array_pop($LAtemp);
        //         //[Восточно - Ачисинский, Улашкент)]

        //         if (array_key_exists(1, $LAtemp)){
                    
        //             $LAtemp1 = implode(" (", $LAtemp);
        //         }
        //         elseif (array_key_exists(0, $LAtemp) && !array_key_exists(1, $LAtemp)) {//skip part where no license
        //             $LAtemp1=$LAtemp[0]; 
        //         }
        //         else {
        //             //var_dump($LAtemp);
        //             $LAtemp1=$row["licenzionnyi_ucastok_licenziia"];
        //         }
        //             //[Восточно - Ачисинский (Улашкент)]
                
        //         LicenseArea::create([
        //             'NameLicenseArea' => $LAtemp1
        //         ]);
        //     }

            foreach ($rows as $row) {
                $LAtemp=explode(" (", $row["licenzionnyi_ucastok_licenziia"] );
                $LAtemp1="";

                array_pop($LAtemp);

                if (array_key_exists(1, $LAtemp)){
                    
                    $LAtemp1 = implode(" (", $LAtemp);
                }
                elseif (array_key_exists(0, $LAtemp) && !array_key_exists(1, $LAtemp)) {
                    $LAtemp1=$LAtemp[0]; 
                }
                else {
                    $LAtemp1=$row["licenzionnyi_ucastok_licenziia"];
                }

                //$dps_temp = $this->dps_temp->where('DepostName', )->first();
                $mlu_temp = $this->mlu_temp->where('NameLicenseArea', $LAtemp1)->first();

                MestLU::updateorcreate([
                    //'id_deposit' => $dps_temp -> id_deposit,//4
                    'id_license_area' => $mlu_temp -> id_license_area//2
                ]);
            }
    }
}
