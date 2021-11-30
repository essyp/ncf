<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageBanner;

class createPageBanner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = PageBanner::first();
        if(!$check){
            $data = new PageBanner;
            $data->ncf_in_brief = null;
            $data->save();
        }
    }
}
