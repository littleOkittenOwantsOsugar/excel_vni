<?php

namespace App\Imports;

use App\Models\FederalDistrict;
use App\Models\LicenseArea;
use App\Models\MestLU;
use App\Models\MineralDeposit;
use App\Models\MineralDepositTwo;
use App\Models\StepenOsvoenia;
use App\Models\SubjectRussia;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FourthSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $osvoenie_temp;

    private $mdt_temp;
    private $mlu_temp;
    

    public function __construct()
    {
        $this -> osvoenie_temp = StepenOsvoenia::select('id_osvoenie', 'NameStepen')->get();

        //not right
        //$this -> mdt_temp = StepenOsvoenia::select('id_subject', '')->get();
        //$this -> mlu_temp = StepenOsvoenia::select('id_license_area', '')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {
                //dd($row);
                $MDtemp=explode(" (", $row["mestorozdenie_deistvuiushhie_licenzii"] );

                if (array_key_exists(1, $MDtemp)){//see secondimport
                    array_pop($MDtemp);
                    $MDtemp=implode(' (', $MDtemp);
                };

                StepenOsvoenia::firstorcreate([//unique
                    'NameStepen'=> $row["stepen_osvoeniia"]
                ]);

                $osvoenie_temp = $this->osvoenie_temp->where('NameStepen', $row["stepen_osvoeniia"])->first();
                if($row["federalnyi_okrug"]!=null)
                {
                    MineralDeposit::create([
                        'id_osvoenie' => $osvoenie_temp -> id_osvoenie,
                        'DepostName' => $MDtemp,
                        'Coordinates' => $row["geom_geometrymultipolygon"]
                    ]);
                }
                
                MineralDepositTwo::create([//rollback done
                    'id_deposit',
                    'id_subject'
                ]);
                MestLU::create([//rollback done
                    'id_deposit',
                    'id_license_area'
                ]);
            }
    }
}
