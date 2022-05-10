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
use DB;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Blog;
use App\Models\Testimony;
use App\Models\ParishMessage;
use App\Models\Company;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\Enquiry;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Newsletter;
use App\Models\Donation;
use App\Models\Benefit;
use App\Models\City;
use App\Models\Country;
use App\Models\MembershipCorporate;
use App\Models\MembershipIndividual;
use App\Models\Message;
use App\Models\PageBanner;
use App\Models\State;
use App\Models\Report;

class HomeController extends Controller
{
    public function sendEnquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'min:7', 'max:80', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            'name' => 'required|string',
            'tel' => ['required','min:11','regex:/^[\+\d]?(?:[\d()]*)$/','max:14'],
            'message' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => 422,
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        
        $item = new Enquiry();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->tel = $request->tel;
        $item->message = $request->message;
        $item->status = 1;
        if($item->save()){
            $response = array(
                "status" => 200,
                "message" => "Thanks for contacting us. One of us will contact you shortly",
            );
                $this->sendContactMail("Thanks for contacting us",$request->email,$request->name);
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "Error sending message . Please try again",
            );
            return Response::json($response);
        }
    }
    
    public function sendContactMail($subject,$email,$name){
        $data = array(
                'name'=> $name,
                'email'=> $email,
                'subject'=> $subject
        );
    
        Mail::send('mails/contact', $data, function($message)
            use($email,$subject,$name) {
                $com = Company::where('id','1')->first();
                $message->from($com->email, $com->fullname);
                $message->to($email, $name)->subject($subject);
        });
    }   

    public function order(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'min:7', 'max:80', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            'fname' => 'required|string',
            'lname' => 'required|string',
            'tel' => 'required|string',
            'address' => 'required|string',
        ]);
    
        if ($validator->fails()) {
         $response = array("status" => "unsuccessful", "message" => $validator->messages()->first());
         return Response::json($response);
        }
        $user_id = $request->user_id;
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $tel = $request->tel;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $address = $request->address;
        $note = $request->note;
        $total_amount = $request->total_amount;
        $payment_type = $request->payment_type;
        $product = $request->product;
    
        $item = new Order();
        $item->user_id = $user_id;
        $item->name = $fname." ".$lname;
        $item->email = $email;
        $item->tel = $tel;
        $item->country = $country;
        $item->state = $state;
        $item->city = $city;
        $item->delivery_address = $address;
        $item->note = $note;
        $item->total_amount = $total_amount;
        $item->payment_method = $payment_type;
        $item->status = PROCESSING;
        $item->order_code = $this->genOrderCode();
    
        if($item->save()) {;
    
        foreach($product as $pr){
            $pro = explode('*',$pr);
            $insert = array(
                'order_id' => $item->id,
                'product_id' => $pro[0],
                'quantity' => $pro[1],
                'price' => $pro[2],
                'total' => $pro[3]
            );
            OrderedProduct::insert($insert);
        }

        $gateway = PaymentGateway::where('id', $request->payment_type)->first();
              $response = array(
                "status" => "success",
                "email" => $email,
                "fname" => $fname,
                "lname" => $lname,
                "tel" => $tel,
                "amount" => $total_amount,
                "user_id" => $user_id,
                "order_id" => $item->id,
                "code" => $item->order_code,
                "payment_type" => $gateway->slug,
                "public_key" => $gateway->public_key,
                "secret_key" => $gateway->secret_key,
                "payment_gateway_id" => $gateway->id,
                "ref_id" => rand(0, 99999).time(),
            );
           return Response::json($response); //return status response as json
        } else {
            $response = array(
                "status" => "unsuccessful",
                "message" => "Error submitting order. Please try again",
            );
            return Response::json($response); //return status response as json
        }
    }
    
    public function genOrderCode(){
        $id = Str::random(10);
        $validator = \Validator::make(['id'=>$id],['id'=>'unique:orders,order_code']);
        if($validator->fails()){
             return $this->genOrderCode();
        }
        return $id;
    }
    
    
    public function verifyTransaction(Request $request){
        $reference = $request->reference;
        $reference = $_POST['reference'];
            $result = array();
            //The parameter after verify/ is the transaction reference to be verified
            $url = 'https://api.paystack.co/transaction/verify/'.$reference;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '.$request->secret_key]
            );
            $request = curl_exec($ch);
            if(curl_error($ch)){
            echo 'error:' . curl_error($ch);
            }
            curl_close($ch);
            if ($request) {
            $result = json_decode($request, true);
            }
            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] == 'success')) {
                return Response()->json(['success']);
                //Perform necessary action
            }else{
                return Response()->json(['unsuccess']);
                //return Response::json($result);
            }
    }
    
    
    public function confirmOrderPayment(Request $request){
        $order_id = $request->order_id;
        $user_id = $request->user_id;
        $code = $request->code;
        $reference = $request->reference;
        $amount = $request->amount;
        $payment_gateway_id = $request->payment_gateway_id;
        $status = $request->status;
        $email = $request->email;
        $fullname = $request->fullname;

        $item = new Payment();
        $item->order_id = $order_id;
        $item->user_id = $user_id;
        $item->payment_gateway_id = $payment_gateway_id;
        $item->amount = $amount;
        $item->transaction_id = $reference;
        $item->status = $status;

        if($item->save()){
            $update = Order::where('id',$order_id)->first();
            $update->payment_status = $status;
            $update->save();
            if($status == SUCCESSFUL) {
                Cart::where('user_id',Auth::guard("user")->user()->id)->delete();
            }
            $response = array(
                "status" => "success",
                "code" => $code,
            );
            return Response::json($response); //return status response as json

            $this->orderSuccessMail("Successful Product Order",$email,$fullname,$reference);

        } else {
            $response = array(
                "status" => "unsuccessful",
                "message" => "Order unsuccessful. Please try again",
            );
            return Response::json($response); //return status response as json
        }
    }
    
    public function orderSuccessMail($subject,$email,$name,$reference){
        $data = array(
                'reference'=> $reference,
                'name'=> $name,
                'email'=> $email,
                'subject'=> $subject
        );
        Mail::send('mails/order', $data, function($message)
            use($email,$subject,$name,$reference) {
            $com = Company::first();
            $message->from($com->email, $com->fullname);
            $message->to($email, $name)->subject($subject);
        });
    }

    public function orderStatus($ref){
        if($ref){
            $status=Payment::where('transaction_id', $ref)->firstOrFail();
            return view('front/order-status', compact('status'));
        }else{
            return redirect('/');
        }

    }

    public function newsLetter(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => 422,
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }

        $email = $request->email;
        $em = Newsletter::where('email', '=', $email)->first();
         if ($em === null) {
    
            $item = new Newsletter();
            $item->email = $email;
            $item->status = ACTIVE;        
            $item->save();
        
            $response = array(
                "status" => 200,
                "message" => "Thanks for subscribing to our newsletters.",
            );        
            return Response::json($response);

        } else{
            $response = array(
                "status" => 201,
                "message" => "You are already subscribed. Thanks",
            );
            return Response::json($response);
        }
    }

    public function donation(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'min:7', 'max:80', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            'name' => 'required|string',
            'amount' => 'required|integer',
            'tel' => 'required|string',
         ]);
    
        if ($validator->fails()) {
         $response = array("status" => "unsuccessful", "message" => $validator->messages()->first());
         return Response::json($response);
        }
        
        $item = new Donation();
        $item->donor_name = $request->name;
        $item->email = $request->email;
        $item->tel = $request->tel;
        $item->amount = $request->amount;
        $item->comment = $request->comment;
        $item->city = $request->city;
        $item->address = $request->address;
        $item->country = $request->country;
        $item->status = PROCESSING;
        $item->ref_id = rand(0, 99999).time();
    
        if($item->save()) {;
    
            $gateway = PaymentGateway::where('id', $request->payment_type)->first();
              $response = array(
                "status" => "success",
                "email" => $request->email,
                "name" => $request->name,
                "tel" => $request->tel,
                "amount" => $request->amount,
                "payment_type" => $gateway->slug,
                "public_key" => $gateway->public_key,
                "secret_key" => $gateway->secret_key,
                "payment_gateway_id" => $gateway->id,
                "ref_id" => $item->ref_id,
                "donation_id" => $item->id,
                
            );
           return Response::json($response); //return status response as json
        } else {
            $response = array(
                "status" => "unsuccessful",
                "message" => "Error encountered. Please try again",
            );
            return Response::json($response); //return status response as json
        }
    }

    public function confirmDonation(Request $request){
       
        $item = new Payment();
        $item->donation_id = $request->donation_id;
        // $item->user_id = $request->user_id;
        $item->payment_gateway_id = $request->payment_gateway_id;
        $item->amount = $request->amount;
        $item->transaction_id = $request->reference;
        $item->status = $request->status;

        if($item->save()){
            $update = Donation::where('id',$request->donation_id)->first();
            $update->status = $request->status;
            $update->save();
            $response = array(
                "status" => "success",
            );
            return Response::json($response); //return status response as json

        } else {
            $response = array(
                "status" => "unsuccessful",
                "message" => "Order unsuccessful. Please try again",
            );
            return Response::json($response); //return status response as json
        }
    }

    public function fetchSlides() {
        $data = Banner::where('status',1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function fetchPageBanners() {
        $data = PageBanner::first();
        if($data){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function corporateMembership(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'company_name' => 'required|string',
            'ownership_type' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'office_address' => 'required|string',
            'company_email' => 'required|email|unique:membership_corporates|max:200',
            'company_tel' => 'required|numeric|unique:membership_corporates',
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_tel' => 'required|numeric',
            'payment_gateway_id' => 'required|integer',
            'transaction_reference' => 'required|numeric',
            'payment_status' => 'required|integer',
            'amount' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $response = array("status" => 422, "message" => $validator->messages()->first());
            return Response::json($response);
        }

        $data = new MembershipCorporate();
        $data->type = $request->type;
        $data->company_name = $request->company_name;
        $data->ownership_type = $request->ownership_type;
        $data->country_id = $request->country_id;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->office_address = $request->office_address;
        $data->company_email = $request->company_email;
        $data->company_tel = $request->company_tel;
        $data->company_strength = $request->company_strength;
        $data->company_director = $request->company_director;
        $data->date_started = $request->date_started;
        $data->contact_name = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->contact_tel = $request->contact_tel;
        $data->contact_designation = $request->contact_designation;
        $data->reference = $request->transaction_reference;
        $data->payment_status = $request->payment_status;
        if($data->save()){
            $payment = new Payment();
            $payment->transaction_id = $request->transaction_reference;
            $payment->payment_gateway_id = $request->payment_gateway_id;
            $payment->amount = $request->amount;
            $payment->status = $request->payment_status;
            $payment->membership_type = 'corporate';
            $payment->membership_id = $data->id;
            $payment->save();

            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function individualMembership(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'name' => 'required|string',
            'phone_number' => 'required|numeric|unique:membership_individuals',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string',
            'email' => 'required|email|unique:membership_individuals|max:200',
            'occupation' => 'required|string',
            'institution' => 'required|string',
            'marital_status' => 'required|string',
            'sex' => 'required|string',
            'payment_gateway_id' => 'required|integer',
            'transaction_reference' => 'required|numeric',
            'payment_status' => 'required|integer',
            'amount' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $response = array("status" => 422, "message" => $validator->messages()->first());
            return Response::json($response);
        }

        $data = new MembershipIndividual();
        $data->type = $request->type;
        $data->name = $request->name;
        $data->other_name = $request->other_name;
        $data->marital_status = $request->marital_status;
        $data->sex = $request->sex;
        $data->country_id = $request->country_id;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->occupation = $request->occupation;
        $data->institution = $request->institution;
        $data->date_created = $request->date_created;
        $data->previous_mem_no = $request->previous_mem_no;
        $data->reference = $request->transaction_reference;
        $data->payment_status = $request->payment_status;
        if($data->save()){
            $payment = new Payment();
            $payment->transaction_id = $request->transaction_reference;
            $payment->payment_gateway_id = $request->payment_gateway_id;
            $payment->amount = $request->amount;
            $payment->status = $request->payment_status;
            $payment->membership_type = 'individual';
            $payment->membership_id = $data->id;
            $payment->save();

            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "operation failed",
            );
            return Response::json($response);
        }
    }

    public function fetchCountries() {
        $data = Country::where('status',1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function fetchStates($country_id) {
        $data = State::where('country_id', $country_id)->where('status', 1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function fetchCities($state_id) {
        $data = City::where('state_id', $state_id)->where('status', 1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function getTeam() {
        $data = Team::where('status', 1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function getTeamDetail($id) {
        $data = Team::where('id', $id)->orWhere('slug', $id)->first();
        if($data){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
            );
            return Response::json($response);
        }
    }

    public function getPaymentGateway() {
        $data = PaymentGateway::where('status', 1)->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function getReports() {
        $data = Report::where('status', 1)->orderBy('id','desc')->get();
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }
    
}
