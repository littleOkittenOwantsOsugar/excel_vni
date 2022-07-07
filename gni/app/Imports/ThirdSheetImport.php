<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Company;
use App\Models\License;
use App\Models\LicenseArea;
use App\Models\SpecialPurpose;
use App\Models\StatusOfLicense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ThirdSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    private $company_temp;
    private $la_temp;
    private $agency_temp;
    private $status_temp;

    public function __construct()
    {
        $this -> company_temp = Company::select('id_company', 'NameCompany')->get();//??
        $this -> la_temp = LicenseArea::select('id_license_area', 'NameLicenseArea')->get();
        $this -> agency_temp = Agency::select('id_agency', 'NameAgency')->get();
        $this -> status_temp = StatusOfLicense::select('id_status', 'NameStatus')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {
                if ($row[13] != null){
                    Agency::firstorcreate([//THIS SHOULD BE BEFORE LICENSE
                        'NameAgency' => $row[13]
                    ]);
                }

                LicenseArea::create([
                    'Geometry' => $row[14]
                ]);
            }
        foreach ($rows as $row) 
            {
                //first without PreviousLicense then lookup for license in another foreach update
                $company_temp = $this->company_temp->where('NameCompany', $row[0])->first();
                $la_temp = $this->la_temp->where('NameLicenseArea', $row[1])->first();
                $agency_temp = $this->agency_temp->where('NameAgency', $row[13])->first();
                $status_temp = $this->status_temp->where('NameStatus', $row[8])->first();

                License::create([
                    'id_company' => $company_temp -> id_company,// if nullable ?? NULL
                    'id_license_area' => $la_temp -> id_license_area,
                    'id_agency' => $agency_temp -> id_agency,
                    'id_status' => $status_temp -> id_status,
                    'TypeOfPrimaryMineral' => $row[7],
                    'DateOfRegistration' => $row[10],
                    'DateOfEnding' => $row[11],
                    'DateOfСancellation' => $row[12],
                    'Seria' =>$row[2],
                    'Number' => $row[3],
                    'Type' => $row[4],
                    'SpecialPurpose' => $row[6]
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
