<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = Admin::first();
        if(!$check){
            $admin = new Admin();
            $admin->id = 1;
            $admin->fname = 'Admin';
            $admin->lname = 'User';
            $admin->tel = '08011111111';
            $admin->email = 'info@optisoft.ng';
            $admin->role = 3;
            $admin->status = 1;
            $admin->password = bcrypt('qwert');
            $admin->created_by = 1;
            $admin->save();
        }
    }
}
