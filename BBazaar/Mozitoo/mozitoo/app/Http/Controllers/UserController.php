<?php

namespace App\Http\Controllers;
use App\User;
use App\TsSubmittedProperty;
use App\TsPasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mail;
use PDF;
use Validator;
use App\TsOtp;
use Carbon\Carbon;
Use App\Jobs\SendBulkEmail;
Use App\Jobs\SendBulkSMS;
Use App\Jobs\SendReminderEmail;
use App\Functions\CustomFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Artisan;
class UserController extends Controller
{
    //Global variables

    public function __construct()
    {
      
      $this->prop_status_p = 1;
      $this->prop_status_v = 2;
      //Inventoty statys as created
      $this->prop_invnt_status_c = 1;
      //Inventoty statys as active/assigned
      $this->prop_invnt_status_a = 2;

      //User types
      $this->user_type_admn = 1;
      $this->user_type_ten = 2;
      $this->user_type_ownr = 3;
      $this->user_type_mgr = 4;

      //Active tenant
      $this->tenant_status_a = 1;
      $this->tenant_status_d = 2;

      //Verified user
      $this->user_status_v = 1;
  
    }
  // Do admin Sign up
  public function adminSignUp(Request $request)
  {
    $email = $request['email'];
    $name = $request['name'];
    $mobile = $request['mobile'];
    $password =  bcrypt($request['password']);
    $user_type_id = 1;
    $user_status_id = 1;
    $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_id)->first();
    $mobileCheck = User::where('mobile', $mobile)->where('user_type_id', $user_type_id)->first();
    if($emailCheck)
    {
      return response()->json([
        "rc"=>"2",
        "rd"=>"Email already exists"
      ]);
    }
    else
    if($mobileCheck)
    {
      return response()->json([
        "rc"=>"3",
        "rd"=>"Mobile number already exists"
      ]);
    }

    else {
      $user = new User();
      $user->email = $email;
      $user->name = $name;
      $user->mobile = $mobile;
      $user->password = $password;
      $user->user_type_id = $user_type_id;
      $user->user_status_id = $user_status_id;
      $user->save();
      Auth::login($user);
      return response()->json([
              'rc'=>'1',
              "rd"=>"Registration Successfull..."
          ]);
  }
}

//Admin login
public function adminSignIn(Request $request)
{
  $email = $request['email'];
  $password =  $request['password'];
  $user_type_id = 1;
  $user_status_id = 1;
  $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_id)->where('user_status_id', $user_status_id)->first();
  if(!$emailCheck)
  {
    return response()->json([
      "rc"=>"2",
      "rd"=>"Email does not exists"
    ]);
  }
  else {
  if(Auth::attempt(['email'=>$email, 'password'=>$password, 'user_type_id'=>$user_type_id, 'user_status_id'=>$user_status_id]))
  {
    return response()->json([
      "rc"=>"1",
      "rd"=>"Login Successfull..."
    ]);
  }
  else {
    return response()->json([
      "rc"=>"3",
      "rd"=>"Password does not matches"
    ]);


  }
}
}
  //Sign Up function
  public function userSignUp(Request $request)
  {
      try
      {
        //Begin Transaction
        DB::beginTransaction();
        //Global variables
        $user_status_v = $this->user_status_v;

        $prop_status_p = $this->prop_status_p;
        $prop_status_v = $this->prop_status_v;

        $user_type_ten = $this->user_type_ten;
        $user_type_ownr = $this->user_type_ownr;


        $name = $request['input_name'];
        $email = $request['input_email'];
        $mobile = $request['input_mobile'];
        $password =  bcrypt($request['input_password']);

      //Check if user exists
      $emailCheck = User::where('email', $email)->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])->first();
      $mobileCheck = User::where('mobile', $mobile)->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])->first();
      if($emailCheck)
      {
        return response()->json([
          "rc"=>"2",
          "rd"=>"Email already exists"
        ]);
      }
      else
      if($mobileCheck)
      {
        return response()->json([
          "rc"=>"3",
          "rd"=>"Mobile number already exists"
        ]);
      }
      else 
      {

        $save_as = array($user_type_ten, $user_type_ownr);
        $collection = array();
        foreach ($save_as as $key => $value) 
        {
          $collection[] = array(
            "name" => $name,
            "email" => $email,
            "mobile" => $mobile,
            "password" => $password,
            "user_type_id" => $value,
            "user_status_id" => $user_status_v,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
  
          );
        }
         //Insert here
        $user_insert = DB::table('users')->insert($collection);
        if($user_insert)
        {
          //Final commit
           DB::commit();
           if (Auth::attempt(['mobile'=> $mobile,'email'=>$email, 'password'=>$request['input_password'], 'user_type_id'=>$user_type_ten])) 
           {
              return response()->json([
                "rc"=>"1",
                "dashboard"=> $user_type_ten,
                "rd"=>"Login Successfull..."
            ]);
          }
          
        }
      }

  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }    
}
    //User login
    public function userSignIn(Request $request)
    {
      //Global variables
      $user_status_v = $this->user_status_v;
      $prop_status_p = $this->prop_status_p;
      $prop_status_v = $this->prop_status_v;
      $user_type_ten = $this->user_type_ten;
      $user_type_ownr = $this->user_type_ownr;

      $owner_flag =  false;
      $tenant_flag = true;
      $owner_user_id = 0;
      $email = $request['login_email'];
      $password =  $request['login_password'];

      $user_check = User::where('email', $email)
                        ->whereIn('user_type_id', [$user_type_ten, $user_type_ownr])
                        ->groupBy('user_type_id')
                        ->distinct()
                        ->get();
      if(!count($user_check) > 0)
      {
        return response()->json([
          "rc"=>"2",
          "rd"=>"Email does not exists"
        ]);
      }
      else 
      {

        if(count($user_check) == 2)
        {
          foreach ($user_check as $key => $value) 
          {
            
            if($value->user_type_id == $user_type_ownr)
            {
              $owner_user_id = $value->user_id;
              break;
            }
          
          }
          
        }
        //Check if owner having property
        if($owner_user_id > 0)
        {
          if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
            $owner_flag = true;
          }
          
        }
      //If owner is having one property then the default dashboard will be owner
      if($owner_flag)
      {
        if(Auth::attempt(['user_id'=> $owner_user_id,'email'=>$email, 'password'=>$password, 'user_type_id'=>$user_type_ownr]))
        {
          return response()->json([
            "rc"=>"1",
            "dashboard"=> $user_type_ownr,
            "rd"=>"Login Successfull..."
          ]);
        }
        else 
        {
          return response()->json([
            "rc"=>"3",
            "rd"=>"Password does not matches"
          ]);
        }

      }
      if($tenant_flag)
      {
        if(Auth::attempt(['email'=>$email, 'password'=>$password, 'user_type_id'=>$user_type_ten]))
        {
          return response()->json([
            "rc"=>"1",
            "dashboard"=> $user_type_ten,
            "rd"=>"Login Successfull..."
          ]);
        }
        else 
        {
          return response()->json([
            "rc"=>"3",
            "rd"=>"Password does not matches"
          ]);
        }
      }

    }

    }
    //Forgot Password
    public function checkForgotPwdUser(Request $request)
    {
      try
      {

      DB::beginTransaction();
      $validator = Validator::make($request->all(), [
        'resetEmail' => 'required|email'
        ]);
    
        if ($validator->fails()) 
        {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Please select appropriate data."
        ],200);
        }
      $email = $request['resetEmail'];
      $emailCheck = User::where('email', $email)
                        ->where('user_status_id', $this->user_status_v)
                        ->whereIn('user_type_id', [$this->user_type_ten,$this->user_type_ownr] )->first();

      if(!$emailCheck)
      {
        return response()->json([
          "rc"=>"2",
          "rd"=>"Email does not exists"
        ]);
      }
      else {

        $name = $emailCheck->name;
        $user_id = $emailCheck->user_id;
        $email = $emailCheck->email;
        $is_expired = 0;
        $token = str_random(64);
        $pwdResetToken = new TsPasswordReset();
        $pwdResetToken->user_id = $user_id;
        $pwdResetToken->token = $token;
        $pwdResetToken->is_expired = $is_expired;
        $url = "http://mozitoo.com/resetpassword?token=".$token;
        if($pwdResetToken->save())
        {
          //Commit
          DB::commit();
          if(Mail::send('mail', ['name' => $name, 'url'=>$url], function ($message) use ($email, $name){
            $message->to($email, $name)
                    ->subject('Password Reset Mozitoo.com')
                    ->from('support@mozitoo.com', 'Mozitoo Support');
                  }))
            return response()->json([
              "rc"=>"1",
              "rd"=>"An email with password reset instructions has beesent to your email address"
            ]);
        }
        else
        {
          return response()->json([
            "rc"=>"2",
            "rd"=>"Something went wrong !"
          ]);
        }
          
      }
    }
    catch(\Exception $e)
      {
        DB::rollback();
        echo $e->getMessage();
      }
    }

    //Get view for Update Password
    public function getPwdForm(Request $request)
    {
      if ($request->has(['token'])) {
        $token = $request->query('token');
        $is_expired = 0;
        $tokenCheck = TsPasswordReset::where('token', $token)
                                    ->where('is_expired', $is_expired)
                                    ->where('created_at', '>=', Carbon::now()->subDay())
                                    ->first();
        if(!$tokenCheck)
        {
          return redirect()->route('home');
        }
        else {
          $user_id = $tokenCheck->user_id;
          $emailCheck = User::where('user_id', $user_id)
                                  ->where('user_status_id', $this->user_status_v)->first();
          if(!$emailCheck)
          {
            return redirect()->route('home');
          }
          else {
            //Set this user id and master token to session 
            $request->session()->put('fpwd_uid', $user_id);
            $request->session()->put('fpwd_m_token', $token);
            if(Auth::check() && Auth::user()->user_type_id == '2')
            {
            return view('changepwd',['tenant'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '3')
            {
            return view('changepwd',['owner'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '4')
            {
            return view('changepwd',['agent'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '1')
            {
            return view('changepwd',['admin'=>Auth::user()]);
            }
            return view('changepwd');
          }
        }
      }
    }
    //Change Password
    public function updateUserPwd(Request $request)
    {
      if(!$request->session()->has('fpwd_uid') or !$request->session()->has('fpwd_m_token'))
      {
        return response()->json([
          "rc"=>"2",
          "rd" => "Something went wrong !"
        ]);
      }
      $validator = Validator::make($request->all(), [
        'newPwd' => 'required'
        ]);
    
        if ($validator->fails()) 
        {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Please select appropriate data."
        ],200);
        }
      $user_id = session('fpwd_uid');;
      $token = session('fpwd_m_token');;
      $password = bcrypt($request['newPwd']);
      $is_expired = 0;
      try
      {
       
      DB::beginTransaction();
      $tokenCheck = TsPasswordReset::where('token', $token)->where('is_expired', $is_expired)->where('created_at', '>=', Carbon::now()->subDay())->first();
      if(!$tokenCheck)
      {
        return response()->json([
          "rc"=>"2",
          "rd" => "Something went wrong !"
        ]);
      }
      else {
        $tmp_uid = $tokenCheck->user_id;
        if($tmp_uid == $user_id)
        {
          $emailCheck = User::where('user_id', $user_id)
                            ->where('user_status_id', $this->user_status_v)->first();
          if(!$emailCheck)
          {
            return response()->json([
              "rc"=>"2",
              "rd" => "Something went wrong !"
            ]);
          }
          else {
            //Matching user email check for other tenant or owner account
            $email = $emailCheck->email;
            $mobile = $emailCheck->mobile;
            $user_type_id = $emailCheck->user_type_id;
            $owner_profile = false;
            $tenant_profile = false;
            //Tenant
            if($user_type_id == $this->user_type_ten)
            {
              $owner_profile = User::where('email', $email)
                                    ->where('mobile', $mobile)
                                    ->where('user_status_id', $this->user_status_v)
                                    ->where('user_type_id', $this->user_type_ownr)->first();
            }
            //Owner
            if($user_type_id == $this->user_type_ownr)
            {
              $tenant_profile = User::where('email', $email)
                                    ->where('mobile', $mobile)
                                    ->where('user_status_id', $this->user_status_v)
                                    ->where('user_type_id', $this->user_type_ten)->first();
            }
            
            //Change other matching owner profile password
            if($owner_profile)
            {
             
              $tokenCheck->is_expired = 1;
              $emailCheck->password = $password;
              $owner_profile->password = $password;
              if($emailCheck->update() && $tokenCheck->update() && $owner_profile->update())
              {
                DB::commit();
                //Auth::login($emailCheck);
                return response()->json([
                  "rc"=>"1",
                  "rd"=>"Password changed successfully"
                ]);
              }
            }
            
            //Change other matching tenant profile password
            if($tenant_profile)
            {
             
              $tokenCheck->is_expired = 1;
              $emailCheck->password = $password;
              $tenant_profile->password = $password;
              if($emailCheck->update() && $tokenCheck->update() && $tenant_profile->update())
              {
                DB::commit();
                //Auth::login($emailCheck);
                return response()->json([
                  "rc"=>"1",
                  "rd"=>"Password changed successfully"
                ]);
              }
            }
            if(!$owner_profile or !$tenant_profile)
            {
              $tokenCheck->is_expired = 1;
              $emailCheck->password = $password;
              if($emailCheck->update())
              {
                 DB::commit();
                //Auth::login($emailCheck);
                return response()->json([
                  "rc"=>"1",
                  "rd"=>"Password changed successfully"
                ]);
              }
            }
          }
        }
        else {
          return response()->json([
            "rc"=>"2",
            "rd" => "Something went wrong !"
          ]);
        }

      }
    }
    catch(\Exception $e)
      {
        DB::rollback();
        echo $e->getMessage();
      }
    }
    //Update Dashboard Password
    public function updateDashboardPwd(Request $request)
    {
      $old_pwd = $request['old_pwd'];
      $new_pwd = $request['new_pwd'];
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $user_type_id = $userInfo->user_type_id;
      $userCheck = User::where('user_id', $user_id)->where('user_type_id', $user_type_id)->first();
      if(!$userCheck)
      {
        return response()->json([
          "rc"=>"2"
        ]);
      }
      else {
        $currentPwd = $userCheck->password;
        if (!Hash::check($old_pwd, $currentPwd))
        {
          return response()->json([
            "rc"=>"3",
            "rd"=>"Wrong password"
          ]);
        }
        else if(Hash::check($new_pwd, $currentPwd)){
          return response()->json([
            "rc"=>"4",
            "rd"=>"Password has been used already"
          ]);
        }
        else {
          $userCheck->password = bcrypt($new_pwd);
          if($userCheck->update())
          {
            Auth::logout();
            return response()->json([
              "rc"=>"1",
              "rd"=>"Password changed successfully"
            ]);

          }
        }

      }
    }
    // Send Mail
    public function sendMail()
    {
      
      $x = new CustomFunctions();
      $obj = $x->sendMail();
      return $obj;
    }

//Send email OTP
public function getSendOTPEmail()
{
  try
  {
    $user_type_ten = $this->user_type_ten;
    $user_type_ownr = $this->user_type_ownr;
    DB::beginTransaction();
    if(Auth::check())
    {
      $user_info = Auth::user();
      $email = $user_info->email;
      $user_check = User::where('email', $email)
                        ->where('email_verified', 1)
                        ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                        ->get();
                        
        if(count($user_check) > 0)
        {
          return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
          ],200);
        }

      //Update ALl existing OTP with this email
      $update_old_otp = TsOtp::where('for', $email)->where('is_expired',1)->first();
      if($update_old_otp)
      {
        $update_old_otp->is_expired = 2;
        $update_old_otp->update();
      }
      
      //Generate OTP
      $otpVal = rand(100000, 999999);
      $otp = new TsOtp();
      $otp->for = $email;
      $otp->otp = $otpVal;
      if($otp->save())
      {
        //Final commit
        DB::commit();
        $function_obj = new CustomFunctions();
        $obj = $function_obj->sendOtpMail($email,$otpVal);
          return response()->json([
            'rc'=>'1',
            "rd"=>"OTP Sent."
        ],200);

      }

    }
    else
    {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
      ],200);
    }

}    
catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }
}
//Send Mobile OTP
public function getSendOTPMobile()
{
  try
  {
    $user_type_ten = $this->user_type_ten;
    $user_type_ownr = $this->user_type_ownr;
    DB::beginTransaction();
    if(Auth::check())
    {
      $user_info = Auth::user();
      $mobile = $user_info->mobile;
      $user_check = User::where('mobile', $mobile)
                        ->where('mobile_verified', 1)
                        ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                        ->get();
        if(count($user_check) > 0)
        {
          return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
          ],200);
        }

      //Update ALl existing OTP with this email
      $update_old_otp = TsOtp::where('for', $mobile)->where('is_expired',1)->first();
      if($update_old_otp)
      {
        $update_old_otp->is_expired = 2;
        $update_old_otp->update();
      }
      
      //Generate OTP
      $otpVal = rand(100000, 999999);
      $otp = new TsOtp();
      $otp->for = $mobile;
      $otp->otp = $otpVal;
      if($otp->save())
      {
        //Final commit
        DB::commit();
        $function_obj = new CustomFunctions();
        $sms_text = "Mozitoo.com Your mobile verification OTP is ".$otpVal;
        $obj = $function_obj->sendSMS($mobile, $sms_text);
          return response()->json([
            'rc'=>'1',
            "rd"=>"OTP sent!"
        ],200);

      }

    }
    else
    {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
      ],200);
    }

}    
catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }
}
//Verify OTP
public function postVerifyOTP(Request $request)
{
  try
  {

    DB::beginTransaction();
     //Unverified user
     $user_status_v = $this->user_status_v;
     $user_type_ten = $this->user_type_ten;
     $user_type_ownr = $this->user_type_ownr;

    $type = $request['for'];
    $otp = $request['input_otp'];
      if(!isset($type) or (!isset($otp)) or ($type != 1 and $type != 2))
      {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong !"
        ],200);
      }
      if(Auth::check())
      {
        $user_info = Auth::user();
        $for = 0;
        if($type == 1)
        {
          $for = $user_info->email;
        }
        if($type == 2)
        {
          $for = $user_info->mobile;
        }
        // return $type;
        $ts_otp = TsOtp::where('for', $for)->where('otp', $otp)->where('is_expired', 1)->where('created_at', '>=', Carbon::now()->subMinutes(50))->first();
        if($ts_otp)
        {
            $ts_otp->is_expired = 2;
            if($ts_otp->update())
            {
              //Email verification
              if($type == 1)
              {
                $user_check = User::where('email', $for)
                                    ->where('email_verified', 0)
                                    ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                                    ->get();
                if(!count($user_check) > 0)
                {
                    return response()->json([
                      'rc'=>'2',
                      "rd"=>"Something went wrong !"
                  ],200);
                }
                else
                {
                  $i = 0;
                  foreach ($user_check as $user)
                  {
                    $user->email_verified = 1;
                    $user->update();
                    $i++;
                  }
                  if(count($user_check) ==  $i)
                  {
                     //Final commit
                      DB::commit();
                        return response()->json([
                          'rc'=>'1',
                          "rd"=>"Email Verified !"
                      ],200);

                  }
                  else
                  {
                      return response()->json([
                        'rc'=>'2',
                        "rd"=>"Something went wrong !"
                    ],200);
                  }
                }
              }
              //Mobile verification
              else if($type == 2)
              {
                $user_check = User::where('mobile', $for)
                                    ->where('mobile_verified', 0)
                                    ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                                    ->get();
                if(!count($user_check) > 0)
                {
                    return response()->json([
                      'rc'=>'2',
                      "rd"=>"Something went wrong !"
                  ],200);
                }
                else
                {
                  $i = 0;
                  foreach ($user_check as $user)
                  {
                    $user->mobile_verified = 1;
                    $user->update();
                    $i++;
                  }
                  if(count($user_check) ==  $i)
                  {
                      //Final commit
                      DB::commit();
                        return response()->json([
                          'rc'=>'1',
                          "rd"=>"Mobile Verified !"
                      ],200);

                  }
                  else
                  {
                      return response()->json([
                        'rc'=>'2',
                        "rd"=>"Something went wrong !"
                    ],200);
                  }
                }
              }
              else
              {
                  return response()->json([
                    'rc'=>'2',
                    "rd"=>"Something went wrong !"
                ],200);
              }
           }
           else
           {
               return response()->json([
                 'rc'=>'2',
                 "rd"=>"Something went wrong !"
             ],200);
           }

        }
        else
        {
            return response()->json([
              'rc'=>'3',
              "rd"=>"OTP expired !"
          ],200);
        }
      }  
      else
      {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong !"
        ],200);
      }
    }  
  catch(\Exception $e)
    {
      DB::rollback();
      echo $e->getMessage();
    }
  }



public function postUpdateEM(Request $request)
{
  try
  {

    DB::beginTransaction();
     //Unverified user
     $user_status_v = $this->user_status_v;
     $user_type_ten = $this->user_type_ten;
     $user_type_ownr = $this->user_type_ownr;
    if(Auth::check())
    {
    $user_info = Auth::user();
    $email = $request['user_email'];
    $mobile = $request['user_mobile'];
    $email_flag = false;
    $mobile_flag = false;
    if(isset($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $email_flag = true;
    }
    if(isset($mobile) && !empty($mobile))
    {
      $mobile_flag = true;
    }
    if($email_flag)
    {
      $user_id = $user_info->user_id;
      $user_email = $user_info->email;
      if($email == $user_email)
      {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Please enter different email !"
        ],200);
      }
      $email_existing_check = User::where('email', $email)
                               ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                               ->get();
      if(count($email_existing_check) > 0)
      {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Email already exist !"
        ],200);
      }

      $user_check = User::where('email', $user_email)
                                ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                                ->get();
      if(!count($user_check) > 0)
      {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong !"
        ],200);
      }
      else
      {
        $i = 0;
        foreach ($user_check as $user)
        {
          $user->email = $email;
          $user->email_verified = 0;
          $user->update();
          $i++;
        }
        if(count($user_check) ==  $i)
        {
          //Update ALl existing OTP with this email
          $update_old_otp = TsOtp::where('for', $email)->where('is_expired',1)->first();
          if($update_old_otp)
          {
            $update_old_otp->is_expired = 2;
            $update_old_otp->update();
          }
          
          //Generate OTP
          $otpVal = rand(100000, 999999);
          $otp = new TsOtp();
          $otp->for = $email;
          $otp->otp = $otpVal;
          if($otp->save())
          {
            //Final commit
            DB::commit();
            $function_obj = new CustomFunctions();
            $obj = $function_obj->sendOtpMail($email, $otpVal);
              return response()->json([
                'rc'=>'1',
                "rd"=>"Email updated!"
            ],200);

          }
        }
        else
        {
            return response()->json([
              'rc'=>'2',
              "rd"=>"Something went wrong !"
          ],200);
        }
      }

    }
    else if($mobile_flag)
    {
      $user_id = $user_info->user_id;
      $user_mobile = $user_info->mobile;
      if($mobile == $user_mobile)
      {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Please enter different Mobile No. !"
        ],200);
      }
      $mobile_existing_check = User::where('mobile', $mobile)
                                    ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                                    ->get();
      if(count($mobile_existing_check) > 0)
      {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Mobile already exist !"
        ],200);
      }

      $user_check = User::where('mobile', $user_mobile)
                                ->whereIn('user_type_id', [$user_type_ten,$user_type_ownr])
                                ->get();
      if(!count($user_check) > 0)
      {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong !"
        ],200);
      }
      else
      {
        $i = 0;
        foreach ($user_check as $user)
        {
          $user->mobile = $mobile;
          $user->mobile_verified = 0;
          $user->update();
          $i++;
        }
        if(count($user_check) ==  $i)
        {
          //Update ALl existing OTP with this email
          $update_old_otp = TsOtp::where('for', $mobile)->where('is_expired',1)->first();
          if($update_old_otp)
          {
            $update_old_otp->is_expired = 2;
            $update_old_otp->update();
          }
          
          //Generate OTP
          $otpVal = rand(100000, 999999);
          $otp = new TsOtp();
          $otp->for = $mobile;
          $otp->otp = $otpVal;
          if($otp->save())
          {
            //Final commit
            DB::commit();
            $sms_text = "Mozitoo.com Your mobile verification OTP is ".$otpVal;
            $function_obj = new CustomFunctions();
            //Call send sms function
            $obj = $function_obj->sendSMS($mobile, $sms_text);
              return response()->json([
                'rc'=>'1',
                "rd"=>"Mobile updated!"
            ],200);

          }
        }
        else
        {
            return response()->json([
              'rc'=>'2',
              "rd"=>"Something went wrong !"
          ],200);
        }
      }
    }

    }      
    else
    {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
      ],200);
    }  
  }
  catch(\Exception $e)
    {
      DB::rollback();
      echo $e->getMessage();
    }
}
//Send Mobile OTP
public function postUpdateName(Request $request)
{
  try
  {
    //Global variables
    $user_type_ten = $this->user_type_ten;
    $user_type_ownr = $this->user_type_ownr;
    //Unverified user
    $user_status_v = $this->user_status_v;

    $name = $request['user_name'];
    DB::beginTransaction();
    if(Auth::check())
    {
      $user_info = Auth::user();
      $user_id = $user_info->user_id;
      //Update name
      $update_name = User::where('user_id', $user_id)->where('user_status_id',$user_status_v)->first();
      if($update_name)
      {
        $update_name->name = $name;
        if($update_name->update())
        {
            //Final commit
            DB::commit();
            return response()->json([
              'rc'=>'1',
              "rd"=>"Name updated!",
              'name' => $name
          ],200);
        }
        else
        {
            return response()->json([
              'rc'=>'2',
              "rd"=>"Something went wrong !"
          ],200);
        } 
      }
    }
    else
    {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong !"
      ],200);
    } 
  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }
}
//Test Email
public function sendTestEmailSMS()
{
$to_email = "emailnkv@gmail.com";
$otp = "737sasa3";
$send_mail = Mail::send('email_otp_teamplate', ['otp' => $otp], function ($message) use ($to_email) {
	$message->to($to_email)
			->subject('Mozitoo.com');
			});
if($send_mail)
{
return "Sent";
}
else
{
return "Not";
}

}



//End of file
}