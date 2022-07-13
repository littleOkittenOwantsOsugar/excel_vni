<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    private $company_temp;

    public function __construct()
    {
        $this -> company_temp = Company::select('id_company', 'NameCompany')->get();
    }

    public function collection(Collection $rows) //in progress
    {
        foreach ($rows as $row){
            Company::create([
                'NameCompany' => $row["nazvanie"],
                'Address'  => $row["poctovyi_adres"],
                'INN'  => $row["inn"], 
                'CodeOKPO'  => $row["kod_okpo"], 
                'CodeOKATO'  => $row["kod_okato"], 
                'OGRN'  => $row["ogrn"], 
                'Addition'  => $row["primecanie"],
                'CurrentState'  => $row["tekushhee_sostoianie"] 
            ]);
        }

        foreach ($rows as $row) // needs to be done
            {
                $company_temp = $this->company_temp->where('NameCompany', $row["upravliaiushhaia_kompaniia"])->first();

                if ($row["upravliaiushhaia_kompaniia"]='Самостоятельные' || $row["upravliaiushhaia_kompaniia"]=null){
                    Company::updateorcreate([
                        'ManagementCompany' => $company_temp -> id_company, 
                    ]);
                }
            }
    }
}
