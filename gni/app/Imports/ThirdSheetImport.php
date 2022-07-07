<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Company;
use App\Models\License;
use App\Models\LicenseArea;
use App\Models\SpecialPurpose;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ThirdSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {
                //first without PreviousLicense then lookup for license in another foreach update

                License::create([
                    'id_company',
                    'id_license_area',
                    'id_agency',
                    'id_status',
                    'TypeOfPrimaryMineral' => $row[7],
                    'DateOfRegistration' => $row[10],
                    'DateOfEnding' => $row[11],
                    'DateOfСancellation' => $row[12],
                    'Seria' =>$row[2],
                    'Number' => $row[3],
                    'Type' => $row[4],
                    'SpecialPurpose' => $row[6]
                ]);
                if ($row[13] != null){
                    Agency::firstorcreate([
                        'NameAgency' => $row[13]
                    ]);
                }
                LicenseArea::create([
                    'Geometry' => $row[14]
                ]);
            }
        foreach ($rows as $row) {
            //СЫК01069НП
            $tmp_row=array($row[5]);//3+5+2
            //(С, Ы, К, 0, 1, 0, 6, 9, Н, П)
            $tmp_row1=array($tmp_row[0], $tmp_row[1], $tmp_row[2]);
            //(С, Ы, К)
            $tmp_row1=implode("", $tmp_row1);
            //СЫК
            $tmp_row2=array($tmp_row[3], $tmp_row[4], $tmp_row[5], $tmp_row[6], $tmp_row[7]);
            //(0, 1, 0, 6, 9)
            $tmp_row2=implode("", $tmp_row2);
            //01069
            $tmp_row3=array($tmp_row[8], $tmp_row[9]);
            //(Н, П)
            $tmp_row3=implode("", $tmp_row3);
            //НП
            if ($row[2]=$tmp_row1 && $row[3]=$tmp_row2 && $row[4]=$tmp_row3){
                //update for specific row
                License::updateOrCreate(['PreviousLicense'=>$row[5]]);
                //=id_license
                //$user = User::where('email', request('email'))->first();
                // if ($user !== null) {

                //     $user->update(['name' => request('name')]);
                
                // }
            }
        }
    }
}
