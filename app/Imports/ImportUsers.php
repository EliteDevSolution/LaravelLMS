<?php

namespace App\Imports;

use App\User;
use App\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportUsers implements ToCollection
{
    public function collection(Collection $rows)
    {
        $index = 0;
        foreach ($rows as $row) 
        {
            if(strval($row[3]) == "" || strval($row[5]) == "") continue;
            if ($index == 0){
                ++$index;
                continue;
            } else ++$index;
            $users = User::where("email", $row[3])->get()->toArray();
            if (sizeof($users) > 0) continue;
            
            $companies = Company::where("name", $row[5])->get()->toArray();
            $company_id = 0;
            if (sizeof($companies) > 0)
            {
                $company_id = $companies[0]['id'];
            } else {
                $company = Company::create(['name' => $row[5]]);
                $company_id = $company->id;
            }
            $user = User::create([
                'first_name' => $row[1],
                'last_name' => $row[2],
                'email' => $row[3],
                'password' => $row[4],
                'company_id' => $company_id,
                'business' => $row[6],
                'department' => $row[7],
                'market_stall' => $row[8],
                'home' => $row[9],
                'city' => $row[10],
                'state' => $row[11],
                'phone' => $row[12],
                'notes' => $row[13]
            ]);
            $user->assignRole('Student');
        }
    }
}
