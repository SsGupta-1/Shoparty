<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Toastr;
use Config;
use Session;
use Cache;
use Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required',
            ]);

            if ($validator->fails())
            { 
                $messages = $validator->messages();
                foreach ($messages->all() as $message)
                {
                    Toastr::error($message, 'Failed', ['timeOut' => 5000]);
                }
                return redirect()->back()->withErrors($validator)->withInput(); 
            }
            else
            {
                $cred['email'] = $request->email;
                $cred['password'] = $request->password;
                $cred['role_id'] = Config::get('constants.roles.Admin');

                if (Auth::attempt($cred))
                {
                    Toastr::success('Login Successfully', 'Success', ['timeOut' => 5000]);
                    return redirect('admin/dashboard');
                }
                else
                {
                    Toastr::error('Invalid crediantials', 'Error', ['timeOut' => 5000]);
                    return redirect()->back();
                }

            }
        }
        return view('admin.auth.login');
    }

    /********************Logout *************************/
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        Cache::flush();
        Toastr::success('Logout Successfully','Success');
        return redirect('/admin');
    }

    /*******************Forgot Pasword**********************/
    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'email'=>'required|email',
            ]);

            if ($validator->fails())
            { 
                $messages = $validator->messages();
                foreach ($messages->all() as $message)
                {
                    Toastr::error($message, 'Failed', ['timeOut' => 5000]);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }
           
            $email = $request->email;
            $count = User::where(['email' => $email,'role_id'=>Config::get('constants.roles.Admin')])->count();
            
            if ($count > 0)
            { 
                $user                = User::where('email',$email)->first();

                /* Here call the otp function */
                $otp                 = $this->createOtp();

                /* Set up the  email data */

                $data                = ['otp' => $otp, 'user_name' => $user->name, 'email' => $user->email];
                $view                = 'mail.send_otp';
                $subject             = 'Forgot Password OTP';

                /* Send Mail */
                try
                {
                    Mail::send($view, $data, function($message) use ($data,$subject) {
                        $message->to($data['email'])->subject($subject.' | Shoparty Team');
                    });
                }
                catch(Exception $e)
                {
                    return $e->getMessage();
                }

                User::where('email', $email)->update(['otp'=>$otp, 'is_verified'=>0]);
                Session::put('session_email', $email);
                Session::put('user_id', $user->id);
                Toastr::success('OTP is sent to registered email', 'Success', ['timeOut' => 5000]);
                return redirect('admin/verify-otp');
            }
            else
            {
                Toastr::success('Invalid Email', 'Error', ['timeOut' => 5000]);

                return redirect()->back();
            }

        }else{
            return view('admin.auth.forgot');
        }
    }

    /******************* create Otp *******************/ 
    public function createOtp()
    {
        $digits     = 4;
        $otp_digits = rand(pow(10, $digits - 1) , pow(10, $digits) - 1);
        return $otp_digits;
    }

    /*******************Verify Otp**********************/
    public function verifyOtp(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'email' => 'required',
                'otp'=>'required',
            ]);

            if ($validator->fails())
            { 
                return response()->json(['message' => $validator->errors()->first(), 'response_code' => 400], 200);            
            }
            $email               = $request->get('email');
            $otp                 = $request->otp;
            $string              = implode("", $request->otp);

            $user_details        = User::where(['email' => $email, 'is_active' => 1])->first();

            if($string == $user_details->otp)
            {
                User::where('email',$email)->update(['otp' => $string, 'is_verified' => 1]);
                Toastr::success('OTP verified Successfully', 'Success', ['timeOut' => 5000]); 

                Session::put('session_email', $email);
                Session::put('user_id', $user_details->id);

                return redirect('admin/change-password');
            }
            else
            {
                Toastr::error('Incorrect OTP', 'Error', ['timeOut' => 5000]);
                return redirect('admin/verify-otp');
            }
        }
        else
        {
            return view('admin.auth.forgototp');
        }
    }

    /*******************Change Pasword**********************/
    public function changePassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'email'=>'required',
                'new_password'=>'required',
                'confirm_password'=>'required|same:new_password'

            ]);

            if ($validator->fails())
            { 
                $messages = $validator->messages();
                foreach ($messages->all() as $message)
                {
                    Toastr::error($message, 'Failed', ['timeOut' => 5000]);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }
           
            $email = $request->email;
            $new_password = $request->new_password;
            User::where(['email' => $email, 'role_id' => Config::get('constants.roles.Admin')])->update(['password' => bcrypt($new_password)]);
            Toastr::success('Password change successfully', 'Success', ['timeOut' => 5000]);
            return view('admin.auth.passwordupdated');
        }
        return view('admin.auth.resetpassword');
    }

    public function resendOtp(Request $request)
    {
        $email = Session::get('session_email');

        $count = User::where(['email' => $email,'role_id'=>Config::get('constants.roles.Admin')])->count();
            
        if ($count > 0)
        { 
            $user                = User::where('email',$email)->first();

            /* Here call the otp function */
            $otp                 = $this->createOtp();

            /* Set up the  email data */

            $data                = ['otp' => $otp, 'user_name' => $user->name, 'email' => $user->email];
            $view                = 'mail.send_otp';
            $subject             = 'Forgot Password OTP';

            /* Send Mail */
            try
            {
                Mail::send($view, $data, function($message) use ($data,$subject) {
                    $message->to($data['email'])->subject($subject.' | Shoparty Team');
                });
            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }

            User::where('email', $email)->update(['otp' => $otp, 'is_verified' => 0]);
            Session::put('session_email', $email);
            Session::put('user_id', $user->id);
            Toastr::success('OTP is sent to registered email', 'Success', ['timeOut' => 5000]);
            return redirect('admin/verify-otp');
        }
        else
        {
            Toastr::success('Invalid Email', 'Error', ['timeOut' => 5000]);

            return redirect()->back();
        }
    }
}
