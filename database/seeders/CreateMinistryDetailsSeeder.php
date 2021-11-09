<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CreateMinistryDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = Company::first();
        if(!$check){
            $data = new Company;
            $data->fullname = 'NCF Commission';
            $data->shortname = 'NCF';
            $data->save();
        }
    }
}
