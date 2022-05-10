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
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Blog;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Event;
use App\Models\ActivityLog;
use App\Models\BlogCategory;
use App\Models\Company;
use App\Models\ProductCategory;
use App\Models\Banner;
use App\Models\Bank;
use App\Models\Donation;
use App\Models\ParishMessage;
use App\Models\Enquiry;
use App\Models\Newsletter;
use App\Models\Testimony;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\Benefit;
use App\Models\Message;
use App\Models\Report;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function log($action){
		$user_key = Auth::guard("admin")->user()->id;
		$sess = \Session::getId();
		$computer_ip = \Request::ip();

		$log = new ActivityLog();
		$log->user_id = $user_key;
		$log->type = ADMIN;
		$log->action = $action;
		$log->computer_ip = $computer_ip;
		$log->session_id = $sess;
		$log->save();
    }

    public function broadcast(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                ParishMessage::where('status',1)->update(array('status' => 0));
                ParishMessage::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("activated parish broadcast");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                ParishMessage::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("deactivated parish broadcast");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                ParishMessage::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("deleted parish broadcast");
            }
        }
		return Response::json($response);
    }

    public function ProductCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                ProductCategory::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = ProductCategory::where('id',$idd)->first();
                $this->log("activated product category with name - $log->name");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                ProductCategory::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = ProductCategory::where('id',$idd)->first();
                $this->log("deactivated product category with name - $log->name");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = ProductCategory::where('id',$idd)->first();
                $this->log("deleted product category with name  - $log->name");
                ProductCategory::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
               
            }
        }
		return Response::json($response);
    }

    public function product(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Product::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Product::where('id',$idd)->first();
                $this->log("activated product with ID - $log->key");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Product::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Product::where('id',$idd)->first();
                $this->log("deactivated product with ID - $log->key");
            }
        }elseif($request->submit == "featured"){
            foreach ($id as $idd) {
                Product::where('id',$idd)->update(array('featured' => YES));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Product::where('id',$idd)->first();
                $this->log("featured product with ID - $log->key");
            }
        }elseif($request->submit == "unfeatured"){
            foreach ($id as $idd) {
                Product::where('id',$idd)->update(array('featured' => NO));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Product::where('id',$idd)->first();
                $this->log("unfeatured product with ID - $log->key");
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Product::where('id',$idd)->first();
                $this->log("deleted product with ID - $log->key");
                Product::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function blog(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Blog::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Blog::where('id',$idd)->first();
                $this->log("activated blog with Title - $log->title");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Blog::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Blog::where('id',$idd)->first();
                $this->log("deactivated blog with Title - $log->title");
            }
        }elseif($request->submit == "featured"){
            foreach ($id as $idd) {
                Blog::where('id',$idd)->update(array('featured' => YES));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Blog::where('id',$idd)->first();
                $this->log("featured blog with Title - $log->title");
            }
        }elseif($request->submit == "unfeatured"){
            foreach ($id as $idd) {
                Blog::where('id',$idd)->update(array('featured' => NO));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Blog::where('id',$idd)->first();
                $this->log("unfeatured blog with Title - $log->title");
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Blog::where('id',$idd)->first();
                $this->log("deleted blog with Title - $log->title");
                Blog::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function BlogCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                BlogCategory::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = BlogCategory::where('id',$idd)->first();
                $this->log("activated blog category with name - $log->name");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                BlogCategory::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = BlogCategory::where('id',$idd)->first();
                $this->log("deactivated blog category with name - $log->name");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = BlogCategory::where('id',$idd)->first();
                $this->log("deleted blog category with name  - $log->name");
                BlogCategory::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function user(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                User::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = User::where('id',$idd)->first();
                $this->log("activated user with ID - $log->ref_id");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                User::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = User::where('id',$idd)->first();
                $this->log("deactivated user with ID - $log->ref_id");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = User::where('id',$idd)->first();
                $this->log("deleted user with ID  - $log->ref_id");
                User::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function admin(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Admin::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Admin::where('id',$idd)->first();
                $this->log("activated admin user with email - $log->email");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Admin::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Admin::where('id',$idd)->first();
                $this->log("deactivated admin user with email - $log->email");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Admin::where('id',$idd)->first();
                $this->log("deleted admin user with email  - $log->email");
                Admin::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function bank(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Bank::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Bank::where('id',$idd)->first();
                $this->log("activated bank with name - $log->bank_name");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Bank::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Bank::where('id',$idd)->first();
                $this->log("deactivated bank with name - $log->bank_name");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Bank::where('id',$idd)->first();
                $this->log("deleted bank with name  - $log->bank_name");
                Bank::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function banner(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Banner::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("activated home banner");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Banner::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("deactivated home banner");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $this->log("deleted home banner");
                Banner::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function logStatus(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
        if($request->submit == "delete"){
            foreach ($id as $idd) {
                ActivityLog::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
            $this->log("deleted log history");
        }
		return Response::json($response);
    }

    public function enquiry(Request $request) {
        $id = $request->id;
        if($request->submit == "processing") {
            foreach ($id as $idd) {
                $item = Enquiry::where('id',$idd)->update(array('status' => PROCESSING));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("enquiry status changed to processing");
            }
        }elseif($request->submit == "processed"){
            foreach ($id as $idd) {
            $item = Enquiry::where('id',$idd)->update(array('status' => PROCESSED));
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            $this->log("enquiry status changed to processed");
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
            $item = Enquiry::where('id',$idd)->delete();
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            $this->log("enquiry deleted");
            }
        }

        return Response::json($response); //return status response as json
    }

    public function event(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Event::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Event::where('id',$idd)->first();
                $this->log("activated event with title - $log->title");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Event::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Event::where('id',$idd)->first();
                $this->log("deactivated event with title - $log->title");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Event::where('id',$idd)->first();
                $this->log("deleted event with title - $log->title");
                Event::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function paymentGateway(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                PaymentGateway::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = PaymentGateway::where('id',$idd)->first();
                $this->log("activated payment gateway with name - $log->name");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                PaymentGateway::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = PaymentGateway::where('id',$idd)->first();
                $this->log("deactivated payment gateway with name - $log->name");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = PaymentGateway::where('id',$idd)->first();
                $this->log("deleted payment gateway with name - $log->name");
                PaymentGateway::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function testimony(Request $request) {
        $id = $request->id;
        if($request->submit == "active") {
            foreach ($id as $idd) {
                $item = Testimony::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                // $this->log("enquiry status changed to processing");
            }
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
            $item = Testimony::where('id',$idd)->update(array('status' => INACTIVE));
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            // $this->log("enquiry status changed to processed");
            }
        } elseif($request->submit == "featured"){
            foreach ($id as $idd) {
            $item = Testimony::where('id',$idd)->update(array('featured' => YES));
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            // $this->log("enquiry status changed to processed");
            }
        } elseif($request->submit == "unfeatured"){
            foreach ($id as $idd) {
            $item = Testimony::where('id',$idd)->update(array('featured' => NO));
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            // $this->log("enquiry status changed to processed");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
            $item = Testimony::where('id',$idd)->delete();
            $response = array(
                "status" => "success",
                "message" => "Operation Successful",
            );
            $this->log("deleted testimony");
            }
        }

        return Response::json($response); //return status response as json
    }

    public function team(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Team::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Team::where('id',$idd)->first();
                $this->log("activated team member with name - $log->name");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Team::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Team::where('id',$idd)->first();
                $this->log("deactivated team member with name - $log->name");
            }
        }elseif($request->submit == "featured"){
            foreach ($id as $idd) {
                Team::where('id',$idd)->update(array('featured' => YES));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Team::where('id',$idd)->first();
                $this->log("featured team member with name - $log->name");
            }
        }elseif($request->submit == "unfeatured"){
            foreach ($id as $idd) {
                Team::where('id',$idd)->update(array('featured' => NO));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $log = Team::where('id',$idd)->first();
                $this->log("unfeatured team member with name - $log->name");
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                $log = Team::where('id',$idd)->first();
                $this->log("deleted team member with name - $log->name");
                Team::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function gallery(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Gallery::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Gallery::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                Gallery::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function benefit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Benefit::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Benefit::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                Benefit::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function message(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Message::where('id',$idd)->update(array('status' => ACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Message::where('id',$idd)->update(array('status' => INACTIVE));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
            }
        }elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                Message::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function report(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "active") {
            foreach ($id as $idd) {
                Report::where('id',$idd)->update(array('status' => 1));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("activated report");
            }   
        }elseif($request->submit == "inactive"){
            foreach ($id as $idd) {
                Report::where('id',$idd)->update(array('status' => 0));
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("deactivated report");
            }
        } elseif($request->submit == "delete"){
            foreach ($id as $idd) {
                Report::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                $this->log("deleted report");
            }
        }
		return Response::json($response);
    }
}
