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
    private $company_temp;

    public function __construct()
    {
        $this -> company_temp = Company::select('id_company', 'NameCompany')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {

                License::create([
                    'id_company',
                    'id_license_area',
                    'id_agency',
                    'id_status',
                    'PreviousLicense',//links to another license
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
                    'Geometry'
                ]);
            }
    }
}
