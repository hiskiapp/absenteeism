<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Students;
use App\Models\Rombels;
use App\Models\Rayons;

class StudentsImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
    	foreach ($rows as $key => $row){
    		if ($row[0] != '') {
    			$check = Students::simpleQuery()
    			->where('nis',$row[0])
    			->first();

    			if ($check == NULL) {
    				$new = New Students;
    				$new->setNis($row[0]);
    				$new->setName(ucwords(strtolower($row[1])));

    				$rombels = Rombels::findByName(strtoupper($row[2]));
    				if ($rombels) {
    					$new->setRombelsId($rombels->getId());
    				}else{
    					$new->setRombelsId(1);
    				}

    				$rayons = Rayons::findByName(ucwords(strtolower($row[3])));
    				if ($rayons) {
    					$new->setRayonsId($rayons->getId());
    				}else{
    					$new->setRayonsId(1);
    				}

    				if ($row[4] == 'L') {
    					$new->setGender('Laki - Laki');
    				}else{
    					$new->setGender('Perempuan');
    				}

    				$new->setBirthCity(ucwords(strtolower($row[5])));
    				$new->setBirthDate(dateExcel($row[6]));
    				$new->setReligion(ucwords(strtolower($row[7])));

                    $address['city'] = ucwords(strtolower($row[8]));
    				$address['district'] = ucwords(strtolower($row[9]));
    				$address['village'] = ucwords(strtolower($row[10]));
    				$address['rt'] = $row[11];
    				$address['rw'] = $row[12];

    				$new->setAddress(json_encode($address));
    				$new->setNameOfGuardian(ucwords(strtolower($row[13])));
    				$new->save();
    			}
    		}
    	}


    }

    public function startRow(): int
    {
    	return 3;
    }
}