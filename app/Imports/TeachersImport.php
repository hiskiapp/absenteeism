<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Teachers;
use App\Models\TeachersRepository;

class TeachersImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
    	foreach ($rows as $key => $row){
    		if ($row[0] != '') {
    			$check = Teachers::simpleQuery()
    			->where('code',$row[0])
    			->first();

    			if (!$check) {
    				$new = New Teachers;
    				$new->setCode($row[0]);
    				$new->setName(ucwords(strtolower($row[1])));
    				$new->setSubjects($row[2]);
    				$new->setPosition($row[3]);

    				$address['city'] = ucwords(strtolower($row[4]));
    				$address['district'] = ucwords(strtolower($row[5]));
    				$address['village'] = ucwords(strtolower($row[6]));
    				$address['rt'] = $row[7];
    				$address['rw'] = $row[8];

    				$new->setAddress(json_encode($address));

    				$schedule = explode(',', $row[9]);
    				$weekdays = [];
    				foreach ($schedule as $key => $val) {
    					$arg = ucwords(strtolower($val));

    					if ($arg == "Senin") {
    						$day = "Mondays";
    					}elseif ($arg == "Selasa") {
    						$day = "Tuesday";
    					}elseif ($arg == "Rabu"){
    						$day = "Wednesday";
    					}elseif ($arg == "Kamis"){
    						$day = "Thursday";
    					}elseif ($arg == "Jumat" || $arg == "Jum'at"){
    						$day = "Friday";
    					}elseif ($arg == "Sabtu"){
    						$day = "Saturday";
    					}else{
    						$day = "Sunday";
    					}

    					$weekdays[] = $day;
    				}

    				$new->setWeekdays(implode(',',$weekdays));
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
