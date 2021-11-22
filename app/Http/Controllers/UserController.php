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
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Payment;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function fetchUser($id) {
        $user = User::where('id',$id)->orWhere('email',$id)->first();
        if($user){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $user,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 403,
                "message" => "user not found",
            );
            return Response::json($response);
        }
    }

    public function getOrders() {
        $order = Order::where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(10);
        return view('user/orders', compact('order'));
    }

    public function getPayments() {
        $data = Payment::where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->paginate(10);
        return view('user/payments', compact('data'));
    }

    public function getCart() {
        $data = Cart::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('cart', compact('data'));
    }

    public function updateUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            // 'tel' => 'required|string',
        ]);
        if ($validator->fails()) {
            $response = array("status" => 422, "message" => $validator->messages()->first());
            return Response::json($response);
        }

        $image = $request->file('image');
        if(!is_null($image) && $image != ''){
            $imageName  = time() . '.' . $image->getClientOriginalExtension();
            $path = "images/users/";
            $image->move($path, $imageName);
        }
    
        $item = User::where('id', $id)->orWhere('email', $id)->first();
        if($item){
            $item->fname = $request->first_name;
            $item->lname = $request->last_name;
            // $item->tel = $request->tel;
            // $item->email = $request->email;
            $item->address = $request->address;
            if(!is_null($image) && $image != ''){
                $item->avatar = $imageName;
            }
            if($item->save()){
                $response = array(
                    "status" => 200,
                    "message" => "Account information updated",
                    "data" => $item,
                );
                return Response::json($response);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "Error updating account . Please try again",
                );
                return Response::json($response);
            }
        } else {
            $response = array(
                "status" => 403,
                "message" => "user not found",
            );
            return Response::json($response);
        }
    }

    public function changePassword(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string','min:5','max:20',
            'confirm_password' => 'required|string|same:new_password',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => 422,
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        $old = $request->current_password;
        $newp = $request->new_password;

        $user = User::where('id', $id)->orWhere('email', $id)->first();
    
        if($user){
            

            if(Hash::check($old, $user->password)){
                $user->password = bcrypt($newp);
                $user->save();
                $response = array(
                    'status' => 200,
                    'message' => 'Password changed successfully',
                );
                return Response::json($response);
            } else {
                $response = array(
                    'status' => 401,
                    'message' => 'Current Password is incorrect',
                );
                return Response::json($response);
            }
        } else {
            $response = array(
                'status' => 403,
                'message' => 'user not found',
            );
            return Response::json($response);
        }
    }

    public function deleteUser($user){
        $check = User::where('id', $user)->orWhere('email', $user)->first();
        if($check){
            User::where('id', $user)->orWhere('email', $user)->delete();
            $response = array("status" => 200, "message" => "operation Successful");
            return Response::json($response);
        } else {
            $response = array("status" => 403, "message" => "user not found");
            return Response::json($response);
        }
    }
}
