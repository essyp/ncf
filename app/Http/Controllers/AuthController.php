<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Mail;
use Session;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use App\Models\Company;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 5; // change to the max attemp you want.
    protected $decayMinutes = 5;

    private function throttle_seconds() {
        if(session()->has('throttle_seconds')) {
            $throttle_seconds = session('throttle_seconds');
            $throttle_current_time = session('throttle_current_time');
            $throttle_seconds = $throttle_current_time - time();
            if($throttle_seconds < 0) {
                $throttle_seconds = 0;
                $this->forget_throttle_seconds();
            }
        } else {
            session(['throttle_seconds' => ($this->decayMinutes* 60)]);
            session(['throttle_current_time' => (time() + ($this->decayMinutes* 60))]);
            $throttle_seconds = session('throttle_seconds');
        }
        return $throttle_seconds;
    }

    private function forget_throttle_seconds() {
        if(session()->has('throttle_seconds')) {
            session()->forget('throttle_seconds');
            session()->forget('throttle_current_time');
        }
    }

    public function authenticate(Request $request) {
        if ($this->hasTooManyLoginAttempts($request)) {
            $seconds = $this->throttle_seconds();
            $this->fireLockoutEvent($request);
            // $this->sendLockoutResponse($request);
            $response = array("status" => "fail", "message" => "The given data was invalid.\nToo many login attempts. Please try again in {$seconds} seconds.");
            return Response::json($response);
        }
        $validator = Validator::make($request->all(), [
           'email' => 'required|string|max:200',
           'password' => 'required|string'
       ]);

       if ($validator->fails()) {
        $this->incrementLoginAttempts($request);
        $response = array("status" => "fail", "message" => $validator->messages()->first());
        return Response::json($response);
       }
        $email = $request->email;
        $password = $request->password;
        isset($request->remember_me) ? $remember = true : $remember = false;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => ACTIVE], $remember)) {
            // The user is active, not suspended, and exists.
            $this->clearLoginAttempts($request);
            $response = array("status" => "success", "message" => "Login Successful");
            return Response::json($response);
        }

        $this->incrementLoginAttempts($request);
        $this->forget_throttle_seconds();
        $response = array("status" => "fail", "message" => "Wrong email or password");
        return Response::json($response);
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        session()->flush();
        return redirect('/admin/login');
        // $response = array("status" => "success", "message" => "Logout Successful");
        // return Response::json($response);
    }

    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:users|max:200',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'tel' => 'required|string|unique:users',
            'password' => 'required|string',
            'confirm_password' => 'same:password'
        ]);
        if ($validator->fails()) {
            $response = array("status" => 422, "message" => $validator->messages()->first());
            return Response::json($response);
           }
        if (User::where('email', '=', $request->email)->count() > 0) {
            $response = array(
                "status" => 422,
                "message" => "Email already exists. try registering with another email",
            );
            return Response::json($response); //return status response as json
        } else {

            if(!(User::where('ref_id','NCF-0001001')->first())){
                $ref_id='NCF-0001001';
            }
            else{
                $number=User::get()->last()->ref_id;
                $number=str_replace('NCF-',"",$number);
                $number=str_pad($number+1, 7, '0', STR_PAD_LEFT);
                $ref_id='NCF-'.$number;
            }

            $activation_link = $this->genActivationLink();
            $link = "https://ncflekki.optisoft.ng/activate-account?code=".$activation_link;

            $user = new User();
            $user->ref_id = $ref_id;
            $user->fname = $request->first_name;
            $user->lname = $request->last_name;
            $user->tel = $request->tel;
            $user->email = $request->email;
            $user->status = INACTIVE;
            $user->activation_link = $activation_link;
            $user->password = bcrypt($request->password);

            if($user->save()){
                $this->ActivationMail("Account Activation", $request->email, $request->first_name.' '.$request->last_name, $link);
            $response = array(
                "status" => 200,
                "message" => "Successful Registration. Please check your email to activate your account",
                "data" => $user,
            );

            return Response::json($response); //return status response as json
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "Error creating account. please try again",
                    "data" => $user,
                );
                return Response::json($response); //return status response as json
            }
        }
    }

    public function genActivationLink(){
        $id = Str::random(20);
        $validator = \Validator::make(['id'=>$id],['id'=>'unique:users,activation_link']);
        if($validator->fails()){
             return $this->genActivationLink();
        }
        return $id;
    }

    public function ActivationMail($subject,$email,$name,$link){
        $data = array(
                'link'=> $link,
                'name'=> $name,
                'email'=> $email,
                'subject'=> $subject
        );
        Mail::send('mails/activation', $data, function($message)
            use($email,$subject,$name,$link) {
            $com = Company::first();
            $message->from($com->email, $com->fullname);
            $message->to($email, $name)->subject($subject);
        });
    }

    public function loginUser(Request $request) {
        if ($this->hasTooManyLoginAttempts($request)) {
            $seconds = $this->throttle_seconds();
            $this->fireLockoutEvent($request);
            // $this->sendLockoutResponse($request);
            $response = array("status" => 401, "message" => "The given data was invalid.\nToo many login attempts. Please try again in {$seconds} seconds.");
            return Response::json($response);
        }
        $validator = Validator::make($request->all(), [
           'email' => 'required|string|max:200',
           'password' => 'required|string'
       ]);

       if ($validator->fails()) {
        $this->incrementLoginAttempts($request);
        $response = array("status" => 422, "message" => $validator->messages()->first());
        return Response::json($response);
       }
        $email = $request->email;
        $password = $request->password;
        isset($request->remember_me) ? $remember = true : $remember = false;

        $check = User::where('email',$email)->first();
        if($check){
            if($check->activation_link != null){
                $response = array("status" => 422, "message" => "Account not yet activated!!");
                return Response::json($response);
            }

            else if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password, 'status' => ACTIVE], $remember)) {
                // The user is active, not suspended, and exists.
                $this->clearLoginAttempts($request);
                $response = array("status" => 200, "message" => "Login Successful!!", "data" => $check);
                return Response::json($response);
            }

            $this->incrementLoginAttempts($request);
            $this->forget_throttle_seconds();
            $response = array("status" => 400, "message" => "Wrong password or deactivated account!!");
            return Response::json($response);

        } else {
            $response = array("status" => 403, "message" => "Email does not exist!!");
            return Response::json($response);
        }
    }

    public function genPasswordResetLink(){
        $id = Str::random(20);
        $validator = \Validator::make(['id'=>$id],['id'=>'unique:users,password_reset']);
        if($validator->fails()){
             return $this->genPasswordResetLink();
        }
        return $id;
    }
    
    public function forgotPassword(Request $request){
        $email = $request->email;
        $id = $this->genPasswordResetLink();
        $link = "https://ncflekki.optisoft.ng/reset-password?code=".$id;
        $count = User::where('email', '=',$email)->count();
            if($count == 1) {
                $item = User::where('email',$email)->first();
                $item->password_reset = $id;
                $item->save();
                
                $name = $item->fname." ".$item->lname;
                $this->forgetPasswordMail("Reset Your Password",$email,$name,$link);
                $response = array(
                    "status" => 200,
                    "message" => "Password reset link sent to your email",
                );
                return Response::json($response);
            } else {
    
                $response = array(
                    "status" => 403,
                    "message" => "Email does not exist on our database",
                );
                return Response::json($response); //return status response as json
        }
    
    }
    public function forgetPasswordMail($subject,$email,$name,$link){
        $data = array(
                'link'=> $link,
                'name'=> $name,
                'email'=> $email,
                'subject'=> $subject
        );
        Mail::send('mails/password-reset', $data, function($message)
            use($email,$subject,$name,$link) {
            $com = Company::first();
            $message->from($com->email, $com->fullname);
            $message->to($email, $name)->subject($subject);
        });
    }   

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password'
        ]);
        if ($validator->fails()) {
            $response = array("status" => 422, "message" => $validator->messages()->first());
            return Response::json($response);
        }

        $id = $request->code;
        $password = $request->password;

        $count = User::where('password_reset', '=',$id)->count();
            if($count == 1) {
                $pass = User::where('password_reset',$id)->first();
                $pass->password = bcrypt($password);
                $pass->save();
               
                User::where('id',$pass->id)->update(['password_reset' => null]);
                
                $name = $pass->fname." ".$pass->lname;
                $this->resetPasswordMail("Password Reset Successful",$pass->email,$name);
                $response = array(
                    "status" => 200,
                    "message" => "You have successfully changed your password. You can now login",
                );
                return Response::json($response);
            } else {
    
                $response = array(
                    "status" => 400,
                    "message" => "Error changing password. Please try again",
                );
                return Response::json($response); //return status response as json
        }
    
    }

    public function resetPasswordMail($subject,$email,$name){
        $data = array(
                'name'=> $name,
                'email'=> $email,
                'subject'=> $subject
        );
        Mail::send('mails/password-reset-success', $data, function($message)
            use($email,$subject,$name) {
                $com = Company::first();
                $message->from($com->email, $com->fullname);
            $message->to($email, $name)->subject($subject);
        });
    }

    public function activateUser($id) {
        $user = User::where('activation_link',$id)->first();
        if($user){
            User::where('id',$user->id)->update(['status' => ACTIVE, 'activation_link' => null]);
            $response = array(
                "status" => 200,
                "message" => "Account activated",
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "Wrong activation link",
            );
            return Response::json($response); 
        }
    }

    public function logoutUser() {
        Auth::guard('user')->logout();
        session()->flush();
        $response = array("status" => 200, "message" => "Logout Successful");
        return Response::json($response);
    }    
}
