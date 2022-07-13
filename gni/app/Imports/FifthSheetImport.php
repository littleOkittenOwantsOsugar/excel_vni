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
        $this -> federal_temp = FederalDistrict::select('id_district', 'NameDistrict')->get();
    }

    public function collection(Collection $rows) //undone
    {
        foreach ($rows as $row) 
            {
                //dd($row);
                $federal_temp = $this->federal_temp->where('NameDistrict', $row["federalnyi_okrug"])->first();
                
                FederalDistrict::firstorcreate([
                    'NameDistrict' => $row["federalnyi_okrug"]
                ]);
                SubjectRussia::create([
                    'Name' => $row["nazvanie"],
                    'ShortName' => $row["nazvanie_korotkoe"],
                    'id_district' => $federal_temp -> id_district
                ]);
            }
    }
}
