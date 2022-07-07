<?php

namespace App\Imports;

use App\Models\FederalDistrict;
use App\Models\SubjectRussia;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FifthSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $federal_temp;

    public function __construct()
    {
        $this -> federal_temp = FederalDistrict::select('id_district', 'NameDistrict')->get();//??
    }

    public function collection(Collection $rows) //unproofed done
    {
        foreach ($rows as $row) 
            {
                $federal_temp = $this->federal_temp->where('NameDistrict', $row[2])->first();//??
                
                FederalDistrict::firstorcreate([
                    'NameDistrict' => $row[2]
                ]);
                SubjectRussia::create([
                    'Name' => $row[0],
                    'ShortName' => $row[1],
                    'id_district' => $federal_temp -> id_district//??
                ]);
            }
    }
}
