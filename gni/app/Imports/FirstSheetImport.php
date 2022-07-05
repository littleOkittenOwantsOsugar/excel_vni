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
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {
                Company::create([
                    'NameCompany' => $row[0],
                    'Address'  => $row[1],
                    'INN'  => $row[2],
                    'CodeOKPO'  => $row[3],
                    'CodeOKATO'  => $row[4],
                    'OGRN'  => $row[7],
                    'Addition'  => $row[8],
                    'ManagementCompany', //different foreach
                    'CurrentState'  => $row[9]
                ]);

                Company::create([
                    'NameCompany' => $row[0],
                    'Address'  => $row[1],
                    'INN'  => $row[2],
                    'CodeOKPO'  => $row[3],
                    'CodeOKATO'  => $row[4],
                    'OGRN'  => $row[7],
                    'Addition'  => $row[8],
                    'ManagementCompany', //different foreach
                    'CurrentState'  => $row[9]
                ]);
            }
    }
}
