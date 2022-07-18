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

    private $dps_temp;
    //private $mdt_temp;
    //private $mlu_temp;
    

    public function __construct()
    {
        $this -> osvoenie_temp = StepenOsvoenia::select('id_osvoenie', 'NameStepen')->get();

        $this -> dps_temp = MineralDeposit::select('id_deposit', 'DepostName')->get();
        //$this -> mdt_temp = SubjectRussia::select('id_subject', 'Name')->get();
        //$this -> mlu_temp = LicenseArea::select('id_license_area', 'NameLicenseArea')->get();
    }

    public function collection(Collection $rows)
    {
        // foreach ($rows as $row) 
        //     {
        //         StepenOsvoenia::firstorcreate([//unique
        //             'NameStepen'=> $row["stepen_osvoeniia"]
        //         ]);
        //     }
        // foreach ($rows as $row) 
        //     {
        //         $MDtemp1="";
        //         $MDtemp=explode(" (", $row["mestorozdenie_deistvuiushhie_licenzii"] );
        //         array_pop($MDtemp);
        //         if (array_key_exists(1, $MDtemp)){//see secondimport
                    
        //             $MDtemp1=implode(" (", $MDtemp);
        //         }
        //         elseif (array_key_exists(0, $MDtemp) && !array_key_exists(1, $MDtemp)) {
        //             $MDtemp1=$MDtemp[0]; 
        //         }
        //         else{
        //             $MDtemp1=$row["mestorozdenie_deistvuiushhie_licenzii"];
        //         }

        //         $osvoenie_temp = $this->osvoenie_temp->where('NameStepen', $row["stepen_osvoeniia"])->first();

        //         if($row["federalnyi_okrug"]!=null)
        //         {
        //             MineralDeposit::create([
        //                 'id_osvoenie' => $osvoenie_temp -> id_osvoenie,
        //                 'DepostName' => $MDtemp1,
        //                 'Coordinates' => $row["geom_geometrymultipolygon"]
        //             ]);
        //         }
        //     }

            foreach ($rows as $row) 
            {
                $MDtemp1="";
                $MDtemp=explode(" (", $row["mestorozdenie_deistvuiushhie_licenzii"] );
                array_pop($MDtemp);
                if (array_key_exists(1, $MDtemp)){//see secondimport
                    
                    $MDtemp1=implode(" (", $MDtemp);
                }
                elseif (array_key_exists(0, $MDtemp) && !array_key_exists(1, $MDtemp)) {
                    $MDtemp1=$MDtemp[0]; 
                }
                else{
                    $MDtemp1=$row["mestorozdenie_deistvuiushhie_licenzii"];
                }

                $dps_temp = $this->dps_temp->where('DepositName',$row["mestorozdenie_deistvuiushhie_licenzii"])->first();
                //$mdt_temp = $this->mdt_temp->where('Name', )->first();
                //$mlu_temp = $this->mlu_temp->where('NameLicenseArea', )->first();
                
                //var_dump($dps_temp);

                MineralDepositTwo::firstorcreate([//rollback done
                    'id_deposit' => $dps_temp -> id_deposit,//here
                    //'id_subject' => $mdt_temp -> id_subject//5
                ]);
                MestLU::firstorcreate([//rollback done
                    'id_deposit' => $dps_temp -> id_deposit,//here
                    //'id_license_area' => $mlu_temp -> id_license_area//2
                ]);
            }
    }
}
