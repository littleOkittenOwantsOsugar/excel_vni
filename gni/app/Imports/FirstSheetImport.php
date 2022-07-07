<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport //implements ToCollection, WithHeadingRow
{
    
    /**
    * @param Collection $collection
    */

    // private $company_temp;

    // public function __construct()
    // {
    //     $this -> company_temp = Company::select('id_company', 'NameCompany')->get();//??
    // }

    public function collection(Collection $rows)
    {
        return;
        foreach ($rows as $row){
            Company::create([
                'NameCompany' => $row[0],
                'Address'  => $row[1],
                'INN'  => $row[2],
                'CodeOKPO'  => $row[3],
                'CodeOKATO'  => $row[4],
                'OGRN'  => $row[7],
                'Addition'  => $row[8],
                'CurrentState'  => $row[9]
            ]);
        }
    }
    //     foreach ($rows as $row) //in progress
    //         {
    //             $company_temp = $this->company_temp->where('NameCompany', $row[10])->first();

    //             if ($row[10]='Самостоятельные' || $row[10]=null){
    //                 Company::updateorcreate([
    //                     'ManagementCompany' => $company_temp -> id_company, //different foreach
    //                 ]);
    //             }
    //         }
    //}
}
