<?php

namespace App\Imports;

use App\Models\FederalDistrict;
use App\Models\MineralDepositTwo;
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
    
    private $mdt_temp;

    public function __construct()
    {
        $this -> federal_temp = FederalDistrict::select('id_district', 'NameDistrict')->get();

        $this -> mdt_temp = SubjectRussia::select('id_subject', 'Name')->get();
    }
    

    public function collection(Collection $rows) //undone
    {
        // foreach ($rows as $row) 
        //     {
        //         //dd($row);
                
        //         FederalDistrict::firstorcreate([
        //             'NameDistrict' => $row["federalnyi_okrug"]
        //         ]);
        //     }
        // foreach ($rows as $row) 
        //     {
        //         $federal_temp = $this->federal_temp->where('NameDistrict', $row["federalnyi_okrug"])->first();
                
        //         SubjectRussia::create([
        //             'Name' => $row["nazvanie"],
        //             'ShortName' => $row["nazvanie_korotkoe"],
        //             'id_district' => $federal_temp -> id_district
        //         ]);
        //     }
        foreach ($rows as $row)
        {
            $mdt_temp = $this->mdt_temp->where('Name', $row["nazvanie"])->first();
                
            MineralDepositTwo::updateorcreate([
                //'id_deposit' => $dps_temp -> id_deposit,//4
                'id_subject' => $mdt_temp -> id_subject//5
            ]);
        }
    }
}

