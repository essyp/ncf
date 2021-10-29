<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programme;
use App\Models\Activity;

class ProgrammeController extends Controller
{
    public function getProgrammes() {
        $data = Programme::where('status',1)->whereNull('ministry_id')->orderBy('id', 'asc')->get();
        $category = Activity::where('status',1)->orderBy('id', 'asc')->get();
        return view('front/programmes', compact('data','category'));
    }

    public function getDetails($id) {
        $data = Programme::where('slug',$id)->first();
        return view('front/programme-details', compact('data'));
    }
}
