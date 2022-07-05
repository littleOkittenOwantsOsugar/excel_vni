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

    public function __construct()
    {
        $this -> osvoenie_temp = StepenOsvoenia::select('id_osvoenie', 'NameStepen')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
            {
                StepenOsvoenia::firstorcreate([//unique
                    'NameStepen'=> $row[2]
                ]);

                $osvoenie_temp = $this->osvoenie_temp->where('NameStepen', $row[2])->first();
                if($row[0]!=null)
                {
                    MineralDeposit::create([
                        'id_osvoenie' => $osvoenie_temp -> id_osvoenie,
                        'DepostName',//3
                        'Coordinates' => $row[6]
                    ]);
                }
                
                MineralDepositTwo::create([
                    'id_deposit',
                    'id_subject'
                ]);
                MestLU::create([
                    'id_deposit',
                    'id_license_area'
                ]);
            }
    }
}
