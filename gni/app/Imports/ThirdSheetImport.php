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
                //dd($row);
                if ($row["organ_vydavsii_licenziiu"] != null){
                    Agency::firstorcreate([//THIS SHOULD BE BEFORE LICENSE
                        'NameAgency' => $row["organ_vydavsii_licenziiu"]
                    ]);
                }

                LicenseArea::updateOrCreate([// license area or license?
                    'Geometry' => $row["geom_geometrymultipolygon"]
                    //Page::where('id', $id)->update(array('image' => 'asdasd'));
                    //LicenseArea::update(array('Geometry' => $row["geom_geometrymultipolygon"]));
                ]);

                //LicenseArea::updateorcreate(array('Geometry' => $row["geom_geometrymultipolygon"]));
            }
        foreach ($rows as $row) 
            {
                //first without PreviousLicense then lookup for license in another foreach update
                $company_temp = $this->company_temp->where('NameCompany', $row["nedropolzovatel"])->first();
                $la_temp = $this->la_temp->where('NameLicenseArea', $row["licenzionnyi_ucastok"])->first();
                $agency_temp = $this->agency_temp->where('NameAgency', $row["organ_vydavsii_licenziiu"])->first();
                $status_temp = $this->status_temp->where('NameStatus', $row["status_licenzii"])->first();

                License::create([
                    'id_company' => $company_temp -> id_company,// if nullable ?? NULL
                    'id_license_area' => $la_temp -> id_license_area,
                    'id_agency' => $agency_temp -> id_agency,
                    'id_status' => $status_temp -> id_status,
                    'TypeOfPrimaryMineral' => $row["vid_osnovnogo_poleznogo_iskopaemo"],
                    'DateOfRegistration' => $row["data_registracii"], //something wrong with the output
                    'DateOfEnding' => $row["data_okoncaniia"],
                    'DateOfСancellation' => $row["data_annulirovaniia"],
                    'Seria' =>$row["seriia"],
                    'Number' => $row["nomer"],
                    'Type' => $row["vid"],
                    'SpecialPurpose' => $row["celevoe_naznacenie"]
                ]);
            }
        foreach ($rows as $row) {//in progress
            //СЫК01069НП
            $tmp_row=array($row["predydushhaia_licenziia"]);//3+5+2
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
            if ($row["seriia"]=$tmp_row1 && $row["nomer"]=$tmp_row2 && $row["vid"]=$tmp_row3){
                //update for specific row
                License::updateOrCreate(['PreviousLicense'=>$row["predydushhaia_licenziia"]]);
                //=id_license
                //$user = User::where('email', request('email'))->first();
                // if ($user !== null) {

                //     $user->update(['name' => request('name')]);
                
                // }
            }
            else{
                //
            }
        }
    }
}
