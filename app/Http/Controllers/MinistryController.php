<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mail;
use Session;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\Ministry;
use App\Models\MinistryActivity;
use App\Models\MinistryExco;

class MinistryController extends Controller
{
    public function getMinistry() {
        $data = Ministry::where('status',1)->orderBy('id', 'DESC')->get();
        return view('front/ministries', compact('data'));
    }

    public function getDetails($id) {
        $data = Ministry::where('slug',$id)->first();
        return view('front/ministry-details', compact('data'));
    }
}
