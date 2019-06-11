<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Middleware\TenantMiddleware;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Response;
use App\TsSubmittedProperty;
use App\MsPropertyAmenty;
use App\TsServiceRequest;
use App\TsTaggedProperty;
use App\TsPropInventory;
use App\MsTenantPrefrence;
use App\MsPropertyType;
use App\MsServiceRequestType;
use App\MsPropBhkType;
use App\MsPropInvntLevel;
use App\TsTenantOtherInfo;
use App\TsPropInvntLevel;
use App\MsPropertyFurnishStatus;
use App\User;
use App\TsWallet;
use App\Functions\CustomFunctions;
use App\TsInvoice;
use App\TsInvoiceItem;
use App\TsCity;
use App\TsState;
use App\TsTaggedTenant;
use Carbon\Carbon;
use PDF;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class TenantDashboardController extends Controller
{
      //Global variables

      public function __construct()
      {
        $this->prop_status_p = 1;
        $this->prop_status_v = 2;
        //Inventory level status
        $this->invnt_level_status_p = 1;
        $this->invnt_level_status_v = 2;
        $this->invnt_level_status_a = 3;
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
        //Invoice status
        //Created
        $this->invoice_status_c = 1;
        //Sent to tenants
        $this->invoice_status_s = 2;
        //Paid
        $this->invoice_status_p = 3;
        //Service request status
        //Not intiated service requests
        $this->ser_req_ni = 1;
        //Ongoing service request
        $this->ser_req_i = 2;
        //Completed service request
        $this->ser_req_c = 3;
        $this->payment_type_o = 1;
        //Instamojo Server URL
        $this->insta_server_url = 'https://www.instamojo.com/api/1.1/payment-requests/';
        //Paymatrix Server URL
        $this->paymatrix_server_url = 'https://kingkong.paymatrix.in/secure/payments';



      }
//Get Tenant Dashboard
public function getTenantDashboard(Request $request)
{
    //return session('pay_invoice_id');
    try
    {
    //Begin Transaction
    DB::beginTransaction();
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $email = $userInfo->email;
      $mobile = $userInfo->mobile;
      $owner_profile = false;
      $invoice_flag = false;
      $otherTenantData = false;
      $payment_flag = false;
      $payment_modal_data = array();
      $get_invoice = array();
      $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
      //Check If this is user is owner also
      if($owner_check)
      {
        $owner_user_id = $owner_check->user_id;
        if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
            $owner_profile = true;
          }
      }
    //Check if he is assigned with some inventory
    $assigned_invnt_check = TsPropInventory::where('user_id', $user_id)
                                                ->where('invnt_status_id',$this->prop_invnt_status_a)
                                                ->where('rent', '!=',0)
                                                ->where('prop_id', '!=',0)
                                                ->latest()->get();
    //Check if any service request from tenant
    $ts_ser_reqs = TsServiceRequest::where('user_id', $user_id)->get();
    //Check if any ongoing service request from tenant
    $ts_p_ser_reqs = TsServiceRequest::where('user_id', $user_id)
                                        ->whereIn('service_req_action_id',[$this->ser_req_ni, $this->ser_req_i])->get();
    
    
    //Check If this user is having any oystanding invoice
    $get_invoice = TsInvoice::where('user_id', $user_id)
                                            ->where('invoice_status_id',$this->invoice_status_s)
                                            ->where('total_amount', '!=',0)
                                            ->where('payment_type_id', '=',0)
                                            ->latest()->get();
      //Get Other Personal Data
      $otherInfoCheck = TsTenantOtherInfo::where('user_id', $user_id)->first();
      if($otherInfoCheck)
      {
        $otherTenantData = true;
      }
      if(count($get_invoice) > 0)
      {
        $invoice_flag = true;
        
      }
      //Capture Instamojo Payment
      if ($request->has('payment_id') && $request->has('payment_request_id') && $request->session()->has('gateway_cred')) 
      {     
            //Gateway api and auth token array
            $gateway_credentials = session('gateway_cred');      
            if(!isset($gateway_credentials) or !is_array($gateway_credentials) or empty($gateway_credentials))
            {
                $info = "Please contact Service Provider";
                $payment_modal_data = array('info' => $info);
                
            }
            else
            {
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,  $this->insta_server_url.$request->payment_request_id.'/');
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $gateway_credentials);
                                
            $response = curl_exec($ch);
            curl_close($ch); 
            $data = json_decode($response, true);
            $invoice_id = 0;
            $payment_data = array();
            $payment_flag = true;
            if($data['success'] == true)
            {
                //$invoice_id = session('pay_invoice_id');
                $purpose = $data['payment_request']['purpose'];
                $payment_data = $data['payment_request']['payments'][0];
                if(is_array($payment_data) && !empty($payment_data) && $request->session()->has('pay_invoice_id'))
                {
                    if($payment_data['status'] == "Credit")
                    {
                        // Payment was successful, mark it as successful in your database.
                        // You can acess payment_request_id, purpose etc here. 
                        $invoice_f_id = substr($purpose, 4);
                        if($invoice_f_id == session('pay_invoice_id'))
                        {
                        //Remove invoice id, and gateway credentails from session
                        $request->session()->forget('pay_invoice_id');
                        $request->session()->forget('gateway_cred');
                        $get_this_invoice = TsInvoice::where('user_id', $user_id)
                                                ->where('ts_invoice_id', '=',$invoice_f_id)
                                                ->where('invoice_status_id',$this->invoice_status_s)
                                                ->latest()->first();
                        if($get_this_invoice)
                        {
                            $get_this_invoice->invoice_status_id = $this->invoice_status_p;
                            $get_this_invoice->payment_type_id = $this->payment_type_o;
                            $get_this_invoice->payment_transaction_id = $payment_data['payment_id'];
                            if($get_this_invoice->update())
                            {
                                DB::commit();
                                if(Storage::disk('invoice')->has($invoice_f_id.'.pdf'))
                                {
                                    Storage::disk('invoice')->delete($invoice_f_id.'.pdf');
                                }
                                $mobile = $payment_data['buyer_phone'];
                                $email = $payment_data['buyer_email'];
                                if($get_this_invoice->msTenantFun)
                                {
                                    $name = $get_this_invoice->msTenantFun->name;
                                    if($get_this_invoice->msTenantFun->mobile)
                                    {
                                        $mobile = $get_this_invoice->msTenantFun->mobile;
                                    }
                                    if($get_this_invoice->msTenantFun->email)
                                    {
                                        $email = $get_this_invoice->msTenantFun->email;
                                    }
                                }
                                $message = "Hi ".ucwords($name). ". You have paid the Inoice ".$purpose.".pdf . Your payment transaction id is ".$payment_data['payment_id'];
                                $obj = new CustomFunctions();
                                $obj->sendSMS($mobile, $message);
                                $obj->sendInvConf($email, $message);
                            }
                        }
                        $info = "Thanks for Your Payment";
                        $msg = "Your Rental is Paid";
                        $transaction_id = $payment_data['payment_id'];
                        $created_at = $payment_data['created_at'];
                        $payment_modal_data = array('info' => $info,'msg' => $msg,
                                                    'transaction_id' => $transaction_id, 'created_at' => $created_at);
                        }
                        else
                        {
                            $info = "Please contact Service Provider";
                            $payment_modal_data = array('info' => $info);
                        }
                    }
                    else{
                        // Payment was unsuccessful, mark it as failed in your database.
                        // You can acess payment_request_id, purpose etc here.
                        $info = "Your Payment was not successful";
                        $transaction_id = $payment_data['payment_id'];
                        $payment_modal_data = array('info' => $info,'transaction_id' => $transaction_id);
                    }

                }
                else
                {
                    $info = "Please contact Service Provider";
                    $payment_modal_data = array('info' => $info);
                }

            }
            else
            {
                //status success was false so return back
                //Show Modal with failed status
                $info = "Please contact Service Provider";
                $payment_modal_data = array('info' => $info);
            }
          }
        }
        //Capture Paymatrix payment
        if($request->session()->has('tr_paymatrix_flag') && $request->session()->has('transaction_id'))
        {
            $tr_paymatrix_flag = session('tr_paymatrix_flag');
            $transaction_id = session('transaction_id');
            $payment_modal_data = array();
            $payment_flag = true;
            //Successful Payment
            if($tr_paymatrix_flag == 2)
            {
                $info = "Thanks for Your Payment";
                        $msg = "Your Rental is Paid";
                        $transaction_id = $transaction_id;
                        $created_at = Carbon::now();
                        $payment_modal_data = array('info' => $info,'msg' => $msg,
                                                    'transaction_id' => $transaction_id, 'created_at' => $created_at);
            }
            //Failed Payments 
            else if($tr_paymatrix_flag == 3)
            {
                // Payment was unsuccessful, mark it as failed in your database.
                // You can acess payment_request_id, purpose etc here.
                $info = "Your Payment was not successful";
                $transaction_id = $transaction_id;
                $payment_modal_data = array('info' => $info,'transaction_id' => $transaction_id);
            }
            else
            {
                $x = "Do Nothing";
            }
            //Remove invoice id, and gateway credentails from session
            $request->session()->forget('tr_paymatrix_flag');
            $request->session()->forget('transaction_id');
            
        }
      return view('tenant',
                    ['tenant'=>Auth::user(),
                    'otherTenantData'=>$otherTenantData, 
                    'otherInfoCheck'=>$otherInfoCheck,
                    'owner_profile'=>$owner_profile,
                    'invoice_flag' => $invoice_flag, 'invoice_data' => $get_invoice,
                    'assigned_invnt_check' => $assigned_invnt_check,
                    'ts_ser_reqs' => $ts_ser_reqs, 'ts_p_ser_reqs' => $ts_p_ser_reqs,
                    'payment_flag' => $payment_flag, 'payment_modal_data' => $payment_modal_data]);

    }
    catch(\Exception $e)
    {
      DB::rollback();
      echo $e->getMessage();
    }
}
    //Get all property
    public function getAllProperty()
    {
      //Global variables
      $prop_status_v = $this->prop_status_v;
      $invnt_level_status_p = $this->invnt_level_status_p;
      $invnt_level_status_v = $this->invnt_level_status_v;
      $invnt_level_status_a = $this->invnt_level_status_a;
      $prop_invnt_status_c = $this->prop_invnt_status_c;
      $prop_invnt_status_a = $this->prop_invnt_status_a;
      $user_type_ten = $this->user_type_ten;
      $user_type_ownr = $this->user_type_ownr;
      $tenant_status_a = $this->tenant_status_a;
      $user_status_v = $this->user_status_v;

      $data = false;
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $email = $userInfo->email;
      $mobile = $userInfo->mobile;
      $owner_profile = false;
      //Owner Check
      $owner_check = User::where('email', $email)
                    ->where('mobile', $mobile)
                    ->where('user_type_id', $user_type_ownr)
                    ->where('user_status_id', $user_status_v)
                    ->first();
        if($owner_check)
        {
          $owner_user_id = $owner_check->user_id;
          if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
           $owner_profile = true;
          }
        }
      //Check If this user is tenant
      $assigned_prop_check = TsPropInventory::where('user_id', $user_id)
                                          ->select('prop_id')
                                          ->where('invnt_status_id',$prop_invnt_status_a)
                                          ->where('rent', '!=',0)
                                          ->where('prop_id', '!=',0)
                                          ->latest()->first();
        if($assigned_prop_check)
        {

        $tenant_prop = TsSubmittedProperty::where('prop_id', $assigned_prop_check->prop_id)
                                            ->where('prop_status_id', $prop_status_v)
                                            ->latest()->first();   
        }                              
        if($assigned_prop_check && $tenant_prop)
        {
          $data = true;
          return view('tenantproperties', 
                              ['tenant'=>Auth::user(),
                              'data'=>$data, 'tenant_prop'=>$tenant_prop,
                              'owner_profile'=>$owner_profile]);
        }

      return view('tenantproperties', ['tenant'=>Auth::user(),'data'=>$data,'owner_profile'=>$owner_profile]);
    }
    //Get One property
    public function getOneProperty($prop_id, Request $request)
    {
       //Global variables
       $prop_status_v = $this->prop_status_v;
       $invnt_level_status_p = $this->invnt_level_status_p;
       $invnt_level_status_v = $this->invnt_level_status_v;
       $invnt_level_status_a = $this->invnt_level_status_a;
       $prop_invnt_status_c = $this->prop_invnt_status_c;
       $prop_invnt_status_a = $this->prop_invnt_status_a;
       $user_type_ten = $this->user_type_ten;
       $user_type_ownr = $this->user_type_ownr;
       $tenant_status_a = $this->tenant_status_a;
       $user_status_v = $this->user_status_v;
 
       $data = false;
       $userInfo = Auth::user();
       $user_id = $userInfo->user_id;
       $email = $userInfo->email;
       $mobile = $userInfo->mobile;
       $owner_profile = false;
       //Owner Check
       $owner_check = User::where('email', $email)
                     ->where('mobile', $mobile)
                     ->where('user_type_id', $user_type_ownr)
                     ->where('user_status_id', $user_status_v)
                     ->first();
         if($owner_check)
         {
           $owner_user_id = $owner_check->user_id;
           if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
           {
            $owner_profile = true;
           }
         }
       //Check If this user is tenant
       $assigned_prop_check = TsPropInventory::where('user_id', $user_id)
                                           ->where('prop_id', $prop_id)
                                           ->where('invnt_status_id',$prop_invnt_status_a)
                                           ->where('rent', '!=',0)
                                           ->latest()->get();
 
        $tenant_prop = TsSubmittedProperty::where('prop_id', $prop_id)
                                             ->where('prop_status_id', $prop_status_v)
                                             ->latest()->first();     
                                             
          if(count($assigned_prop_check) > 0 && $tenant_prop)
          {
            //Set this prop_id to session, it will be retirved when required
            $request->session()->put('curr_ten_prop', $prop_id);
            $amenities = $tenant_prop->prop_amenty_id;
            $amenities = explode(",",$amenities);
            $ms_property_amenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();                                  
            return view('onetenantproperty',
                        ['tenant'=>Auth::user(),'one_prop'=>$tenant_prop,
                        'owner_profile'=>$owner_profile,
                        "ms_property_amenties"=>$ms_property_amenties, 'n_a' => 'N/A', 'prop_tenants' => $assigned_prop_check]);
          }

        return redirect()->route('tenant.property.all');

    }

    // Submit service requests

    public function submitServiceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'prop_id' => 'required',
          'service_req_type' => 'required'
      ]);
      if ($validator->fails()) {
          return response()->json([
              'rc' => '2',
              "rd" => "Please select appropriate data.",
          ], 200);
      }
        $prop_id = $request['prop_id'];
        $service_req_type = $request['service_req_type'];

        $userInfo = Auth::user();
        $req_by_id = $userInfo->user_id;
        $tsServiceRequest = new TsServiceRequest();
        $tsServiceRequest->prop_id = $prop_id;
        $tsServiceRequest->service_req_type_id = $service_req_type;
        $tsServiceRequest->user_id = $req_by_id;

        $message = $request['service_msg'];
        if($message)
        {
          $tsServiceRequest->message = $message;
        }

        $service_req_action_id = 1;

        $tsServiceRequest->service_req_action_id = $service_req_action_id;

        if($tsServiceRequest->save())
        {
            return response()->json([
                    "rc"=>"1",
                    "rd"=>"Request submitted."
                ]);
        }
    }


    // Get service request form
    public function getServiceReqForm()
    {

      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $email = $userInfo->email;
      $mobile = $userInfo->mobile;
      $owner_profile = false;
      $tenant_prop = array();
      //Owner Check
      $owner_check = User::where('email', $email)
                    ->where('mobile', $mobile)
                    ->where('user_type_id', $this->user_type_ownr)
                    ->where('user_status_id',  $this->user_status_v)
                    ->first();
        if($owner_check)
        {
          $owner_user_id = $owner_check->user_id;
          if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
           $owner_profile = true;
          }
        }

      //Check If this user is tenant
      $assigned_prop_check = TsPropInventory::where('user_id', $user_id)
                                          ->select('prop_id')
                                          ->where('invnt_status_id',$this->prop_invnt_status_a)
                                          ->where('rent', '!=',0)
                                          ->latest()->get();
        if(count($assigned_prop_check) > 0)
        {

        $tenant_prop = TsSubmittedProperty::whereIn('prop_id', $assigned_prop_check)
                                            ->where('prop_status_id', $this->prop_status_v)
                                            ->latest()->get();   
        }                              
      $ms_ser_req_types= MsServiceRequestType::all();

      return view('tenantserreq',['tenant'=>Auth::user(),'tenant_prop'=>$tenant_prop,
                            'ms_ser_req_types'=>$ms_ser_req_types, 'owner_profile' => $owner_profile]);

    }
    // Get All service request
    public function getTenantServiceReq()
    {
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $email = $userInfo->email;
      $mobile = $userInfo->mobile;
      $owner_profile = false;
      //Owner Check
      $owner_check = User::where('email', $email)
                    ->where('mobile', $mobile)
                    ->where('user_type_id', $this->user_type_ownr)
                    ->where('user_status_id',  $this->user_status_v)
                    ->first();
        if($owner_check)
        {
          $owner_user_id = $owner_check->user_id;
          if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
           $owner_profile = true;
          }
        }
      $ts_ser_reqs = TsServiceRequest::where('user_id', $user_id)->latest()->get();

      return view('tenantallserreq', ['tenant'=>Auth::user(),'ts_ser_reqs'=>$ts_ser_reqs,
                                      'owner_profile' => $owner_profile]);

    }
    // logout
      public function getLogout()
      {
          Auth::logout();
          return redirect()->route('home');
      }


      //Update profile

      public function getUpdateTenantProfile(Request $request)
      {
          $inputName = $request['inputName'];
          $inputAddressLine1 = $request['inputAddressLine1'];
          $inputAddressLine2 = $request['inputAddressLine2'];
          $inputCity = $request['inputCity'];
          $inputState = $request['inputState'];
          $inputPincode = $request['inputPincode'];
          $inputAbout = $request['inputAbout'];
          $userInfo = Auth::user();
          $user_id = $userInfo->user_id;
          $user_type_id = 2;
          try
          {

          DB::beginTransaction();
          $userCheck = User::where('user_id', $user_id)->where('user_type_id', $user_type_id)->first();
          if(!$userCheck)
          {
            return response()->json([
              "rc"=>"2",
              "rd"=>"Something went wrong"
            ]);
          }
          else {

            $userCheck->name = $inputName;
            $userCheck->user_info = $inputAbout;
            if($userCheck->update())
            {

              $otherInfoCheck = TsTenantOtherInfo::where('user_id', $user_id)->first();
              if($otherInfoCheck)
              {
                $otherInfoCheck->address_line_1 = $inputAddressLine1;
                $otherInfoCheck->address_line_2 = $inputAddressLine2;
                $otherInfoCheck->city = $inputCity;
                $otherInfoCheck->state = $inputState;
                $otherInfoCheck->pincode = $inputPincode;
                if($otherInfoCheck->update())
                {
                    DB::commit();
                    return response()->json([
                      "rc"=>"1",
                      "rd"=>"Profile Updated"
                    ]);
                }
                else {
                  return response()->json([
                    "rc"=>"2",
                    "rd"=>"Something went wrong"
                  ]);
                }

              }
              else {

                $newInfo = new TsTenantOtherInfo();
                $newInfo->user_id = $user_id;
                $newInfo->address_line_1 = $inputAddressLine1;
                $newInfo->address_line_2 = $inputAddressLine2;
                $newInfo->city = $inputCity;
                $newInfo->state = $inputState;
                $newInfo->pincode = $inputPincode;
                if($newInfo->save())
                {
                    DB::commit();
                    return response()->json([
                      "rc"=>"1",
                      "rd"=>"Profile Updated"
                    ]);
                }
                else {
                  return response()->json([
                    "rc"=>"2",
                    "rd"=>"Something went wrong"
                  ]);
                }
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
      //Get Password view
      public function getPwdView()
      {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $email = $userInfo->email;
        $mobile = $userInfo->mobile;
        $owner_profile = false;
        $owner_check = User::where('email', $email)
                          ->where('mobile', $mobile)
                          ->where('user_type_id', $this->user_type_ownr)
                          ->where('user_status_id', $this->user_status_v)
                          ->first();
        //Check If this is user is owner also
        if($owner_check)
        {
          $owner_user_id = $owner_check->user_id;
          if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
            {
              $owner_profile = true;
            }
        }
      return view('tenantchangepwd',['tenant'=>Auth::user(), 'owner_profile' => $owner_profile]);
      }
//Switch to owner dashboard
public function postSwitchToOwnerDash(Request $request)
{
  if(Auth::check())
  {
    $user_info = Auth::user();
    $user_type = $user_info->user_type_id;
    $status = $user_info->user_status_id;
    $email = $user_info->email;
    $mobile = $user_info->mobile;
    $password = $user_info->password;
    if($status == $this->user_status_v && $user_type == $this->user_type_ten)
    {
      $owner_check = User::where('email', $email)
                          ->where('mobile', $mobile)
                          ->where('user_type_id', $this->user_type_ownr)
                          ->where('user_status_id', $this->user_status_v)
                          ->first();
                          
      if($owner_check)
      {
        $owner_user_id = $owner_check->user_id;
        if(Auth::loginUsingId($owner_user_id))
        {
            return redirect()->route('ownerdashboard');
        }
        else 
        {
            return back();
        }
      }
    }

  }

  //Return default
  return back();

}
//See Outstanding invoice

public function getInvoice($tmp_id_0, $tmp_id_1, $tmp_id_2)
{ 
  
  try 
  {
    $invoice_id = Crypt::decrypt($tmp_id_0);
    //Global variables
    $user_type_ten = $this->user_type_ten;
    $user_type_ownr = $this->user_type_ownr;
    $prop_status_v = $this->prop_status_v;
    //Unverified user
    $user_status_v = $this->user_status_v;
    $invoice_status_c = $this->invoice_status_c;
    $invoice_status_s = $this->invoice_status_s;
    $invoice_status_p = $this->invoice_status_p;
    if (!filter_var($invoice_id, FILTER_VALIDATE_INT))
    {
      return redirect()->route('tenantaccount');
    }
    $userInfo = Auth::user();
    $user_id = $userInfo->user_id;
      //Check If this user is having any oystanding invoice
      $get_invoice = TsInvoice::where('user_id', $user_id)
                            ->where('ts_invoice_id', '=',$invoice_id)
                            ->where('for_month', '=',$tmp_id_1)
                            ->whereIn('invoice_status_id',[$invoice_status_s, $invoice_status_p])
                            ->latest()->first();
    if($get_invoice)
    {

      $formatted_invoice_data = array();
      $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->get();
      //Check if invoice exists
      if($get_invoice && count($get_invoice_items) > 0)
      {
        if(Storage::disk('invoice')->has($invoice_id.'.pdf'))
        {
          $filename = $invoice_id.'.pdf';
          $formatted_name = "MOZI".$filename;
          $headers = array(
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'inline; filename="'.$formatted_name.'"');
          return response()->file(storage_path('app/invoices/'.$invoice_id.'.pdf'), $headers);
        }
        else
        {
        //Formatted Invoice ID
        $formatted_invoice_id = "MOZI".$invoice_id;
        //Formatted For month
        $formatted_month = Carbon::parse($get_invoice->for_month)->format('F Y');
        //Get Tenant UID
        $tenant_uid = $get_invoice->user_id;
        //Tenant details
        $tenant_details = User::where('user_id', $tenant_uid)
                              ->where('user_type_id',$user_type_ten)->first();
        //Get Property ID
        $prop_id = $get_invoice->prop_id;
        $prop_details = TsSubmittedProperty::where('prop_id', $prop_id)
                              ->where('prop_status_id', $prop_status_v)
                              ->first();
        //Get Owner ID
        $owner_uid = $prop_details->user_id;
        //Tenant details
        $owner_details = User::where('user_id', $owner_uid)->first();


        $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,
                                        'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                                        'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
        
        $dompdf = PDF::loadView('rental_invoice', ['data'=>$formatted_invoice_data]);
        if($dompdf)
        {
         return $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf'))->stream($formatted_invoice_id.'.pdf');
        //return view('rental_invoice', ['admin'=>Auth::user(),'data'=>$formatted_invoice_data]);
        }
       
      }
      }
      else
      {
        return back();
      }
    }

    return redirect()->route('tenantaccount');
  } 
  catch (DecryptException $e) 
  {
    return redirect()->route('tenantaccount');
  }

}
//See Outstanding invoice

public function getDownloadInvoice($tmp_id_0, $tmp_id_1, $tmp_id_2)
{ 
  
  try 
  {
    $invoice_id = Crypt::decrypt($tmp_id_0);
    //Global variables
    $user_type_ten = $this->user_type_ten;
    $user_type_ownr = $this->user_type_ownr;
    $prop_status_v = $this->prop_status_v;
    //Unverified user
    $user_status_v = $this->user_status_v;
    $invoice_status_c = $this->invoice_status_c;
    $invoice_status_s = $this->invoice_status_s;
    $invoice_status_p = $this->invoice_status_p;
    if (!filter_var($invoice_id, FILTER_VALIDATE_INT))
    {
      return redirect()->route('tenantaccount');
    }
    $userInfo = Auth::user();
    $user_id = $userInfo->user_id;
      //Check If this user is having any oystanding invoice
      $get_invoice = TsInvoice::where('user_id', $user_id)
                            ->where('ts_invoice_id', '=',$invoice_id)
                            ->where('for_month', '=',$tmp_id_1)
                            ->whereIn('invoice_status_id',[$invoice_status_s, $invoice_status_p])
                            ->latest()->first();
    if($get_invoice)
    {

      $formatted_invoice_data = array();
      $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->get();
      //Check if invoice exists
      if($get_invoice && count($get_invoice_items) > 0)
      {
        if(Storage::disk('invoice')->has($invoice_id.'.pdf'))
        {
          $filename = $invoice_id.'.pdf';
          $formatted_name = "MOZI".$filename;
          $headers = array(
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'inline; filename="'.$formatted_name.'"');
          return response()->download(storage_path('app/invoices/'.$invoice_id.'.pdf'),$formatted_name, $headers);
        }
        else
        {
        //Formatted Invoice ID
        $formatted_invoice_id = "MOZI".$invoice_id;
        //Formatted For month
        $formatted_month = Carbon::parse($get_invoice->for_month)->format('F Y');
        //Get Tenant UID
        $tenant_uid = $get_invoice->user_id;
        //Tenant details
        $tenant_details = User::where('user_id', $tenant_uid)
                              ->where('user_type_id',$user_type_ten)->first();
        //Get Property ID
        $prop_id = $get_invoice->prop_id;
        $prop_details = TsSubmittedProperty::where('prop_id', $prop_id)
                              ->where('prop_status_id', $prop_status_v)
                              ->first();
        //Get Owner ID
        $owner_uid = $prop_details->user_id;
        //Tenant details
        $owner_details = User::where('user_id', $owner_uid)->first();


        $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,
                                        'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                                        'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
        
        $dompdf = PDF::loadView('rental_invoice', ['data'=>$formatted_invoice_data]);
        if($dompdf)
        {
         return $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf'))->download($formatted_invoice_id.'.pdf');
        //return view('rental_invoice', ['admin'=>Auth::user(),'data'=>$formatted_invoice_data]);
        }
       
      }
      }
      else
      {
        return back();
      }
    }

    return redirect()->route('tenantaccount');
  } 
  catch (DecryptException $e) 
  {
    return redirect()->route('tenantaccount');
  }

}
//Owner Profile
public function getTenantProfile()
{
    $userInfo = Auth::user();
    $user_id = $userInfo->user_id;
    $email = $userInfo->email;
    $mobile = $userInfo->mobile;
    $owner_profile = false;
    $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
      //Check If this is user is owner also
      if($owner_check)
      {
        $owner_user_id = $owner_check->user_id;
        if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
        {
        $owner_profile = true;
        }
      }
    $ts_states = TsState::groupBy('name')->distinct()->get();
    $ts_cities = TsCity::all();
    //Check User
    $other_data = TsTenantOtherInfo::where('user_id', $user_id)->first();
                    
    return view('tenant_profile', ['tenant' => Auth::user(),'owner_profile'=>$owner_profile,'ts_states' => $ts_states,'ts_cities' => $ts_cities, 'other_data' => $other_data]);
}
    //Save address
    public function postSaveAddress(Request $request)
    {
    try
    {
      DB::beginTransaction();
      $user_info = Auth::user();
      $user_id = $user_info->user_id;
    
      $validator = Validator::make($request->all(), [
        'add_line_1' => 'required',
        'add_line_2' => 'required',
        'input_state' => 'required',
        'input_city' => 'required',
        'pin' => 'required'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'rc' => '2',
            "rd" => "Please select appropriate data.",
        ], 200);
    }
     
        $other_info_check = TsTenantOtherInfo::where('user_id', $user_id)->first();
        //Check if row exists then update
        if ($other_info_check) {
            $other_info_check->address_line_1 = $request['add_line_1'];
            $other_info_check->address_line_2 = $request['add_line_2'];
            $other_info_check->state = $request['input_state'];
            $other_info_check->city = $request['input_city'];
            $other_info_check->pincode = $request['pin'];
            if ($other_info_check->update()) {
                DB::commit();
                return response()->json([
                    "rc" => "1",
                    "rd" => "Address Updated",
                ]);
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
                ]);
            }
    
        } else {
            //Check if row exists if not then create
            $new_info = new TsTenantOtherInfo();
            $new_info->user_id = $user_id;
            $new_info->address_line_1 = $request['add_line_1'];
            $new_info->address_line_2 = $request['add_line_2'];
            $new_info->state = $request['input_state'];
            $new_info->city = $request['input_city'];
            $new_info->pincode = $request['pin'];
            if ($new_info->save()) {
                DB::commit();
                return response()->json([
                    "rc" => "1",
                    "rd" => "Addresss Saved",
                ]);
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
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
    //Save bank details
public function postSaveBankDetails(Request $request)
{
    try
    {
      DB::beginTransaction();
      $user_info = Auth::user();
      $user_id = $user_info->user_id;
    
      $validator = Validator::make($request->all(), [
        'pan_no' => 'required',
        'adhaar_no' => 'required',
        'acc_holder_name' => 'required',
        'acc_no' => 'required',
        'bank_name' => 'required',
        'branch_name' => 'required',
        'ifsc' => 'required',
        'type' => 'required',
        'micr' => 'required',
        'cheque' => 'required|max:10000|mimes:pdf,jpeg,png'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'rc' => '2',
            "rd" => "Please select appropriate data.",
        ], 200);
    }
    $file = $request->file('cheque');
    if (!$file) {
        return response()->json([
            'rc' => '2',
            "rd" => "Please select appropriate data.",
        ], 200);
    }
    //Get the extension and create file name
    $extension = $request->file('cheque')->extension();
    $filename = $user_id.'.'.$extension;
        $other_info_check = TsTenantOtherInfo::where('user_id', $user_id)->first();
        //Check if row exists then update
        if ($other_info_check) {
            $other_info_check->pan_no = $request['pan_no'];
            $other_info_check->adhaar_no = $request['adhaar_no'];
            $other_info_check->acc_holder_name = $request['acc_holder_name'];
            $other_info_check->acc_no = $request['acc_no'];
            $other_info_check->bank_name = $request['bank_name'];
            $other_info_check->branch_name = $request['branch_name'];
            $other_info_check->ifsc = $request['ifsc'];
            $other_info_check->type = $request['type'];
            $other_info_check->micr = $request['micr'];
            if ($other_info_check->update()) {
                if (Storage::disk('bank_cheques')->put($filename, File::get($file))) {
                    DB::commit();
                    return response()->json([
                        "rc" => "1",
                        "rd" => "Bank Details Saved",
                    ]);
                }
                else
                {
                    return response()->json([
                        "rc" => "2",
                        "rd" => "File can't be saved",
                    ]);
                }
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
                ]);
            }
    
        } else {
            //Check if row exists if not then create
            $new_info = new TsTenantOtherInfo();
            $new_info->user_id = $user_id;
            $new_info->pan_no = $request['pan_no'];
            $new_info->adhaar_no = $request['adhaar_no'];
            $new_info->acc_holder_name = $request['acc_holder_name'];
            $new_info->acc_no = $request['acc_no'];
            $new_info->bank_name = $request['bank_name'];
            $new_info->branch_name = $request['branch_name'];
            $new_info->ifsc = $request['ifsc'];
            $new_info->type = $request['type'];
            $new_info->micr = $request['micr'];
            if ($new_info->save()) {
                if (Storage::disk('bank_cheques')->put($filename, File::get($file))) {
                    DB::commit();
                    return response()->json([
                        "rc" => "1",
                        "rd" => "Bank Details Saved",
                    ]);
                }
                else
                {
                    return response()->json([
                        "rc" => "2",
                        "rd" => "File can't be saved",
                    ]);
                }
                
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
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
//Save about me
public function postSaveAboutMe(Request $request)
{
    try
    {
      DB::beginTransaction();
      $user_info = Auth::user();
      $user_id = $user_info->user_id;
    
      $validator = Validator::make($request->all(), [
        'about_me' => 'required'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'rc' => '2',
            "rd" => "Please select appropriate data.",
        ], 200);
    }
    
        $other_info_check = TsTenantOtherInfo::where('user_id', $user_id)->first();
        //Check if row exists then update
        if ($other_info_check) {
            $other_info_check->about_me = $request['about_me'];
            if ($other_info_check->update()) {
                DB::commit();
                return response()->json([
                    "rc" => "1",
                    "rd" => "About me Updated",
                ]);
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
                ]);
            }
    
        } else {
            //Check if row exists if not then create
            $new_info = new TsTenantOtherInfo();
            $new_info->user_id = $user_id;
            $new_info->about_me = $request['about_me'];
            if ($new_info->save()) {
                DB::commit();
                return response()->json([
                    "rc" => "1",
                    "rd" => "About me Saved",
                ]);
            } else {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong",
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
    //Get Submit form
    public function getSubmitForm()
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $email = $userInfo->email;
        $mobile = $userInfo->mobile;
        $owner_profile = false;
        $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
      //Check If this is user is owner also
      if($owner_check)
      {
        $owner_user_id = $owner_check->user_id;
        if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
          {
            $owner_profile = true;
          }
      }
        $msPropertyType = MsPropertyType::all();
        $msPropertyFurnishStatus = MsPropertyFurnishStatus::all();
        $msPropertyAmenty = MsPropertyAmenty::all();
        $msTenantPrefrence = MsTenantPrefrence::all();
        $msPropInvntLevel = MsPropInvntLevel::all();
        $msPropBhkType = MsPropBhkType::all();
        $ts_states = TsState::groupBy('name')->distinct()->get();
        return view('ten_submit_prop',
            [
                'tenant' => Auth::user(),
                'propertyType' => true, 'msPropertyTypes' => $msPropertyType,
                'propertyAmenty' => true, 'msPropertyAmenties' => $msPropertyAmenty,
                'tenantPrefrence' => true, 'msTenantPrefrences' => $msTenantPrefrence,
                'propertyFurnishStatus' => true, 'msPropertyFurnishStatuses' => $msPropertyFurnishStatus,
                'propInvntLevel' => true, 'msPropInvntLevels' => $msPropInvntLevel,
                'propBhkType' => true, 'msPropBhkTypes' => $msPropBhkType,
                'ts_state' => true, 'ts_states' => $ts_states,'owner_profile' => $owner_profile
            ]);
    }
//Save form
public function submitNewForm(Request $request)
{
try
{
//Begin Transaction
DB::beginTransaction();
    //Global variables
  $user_status_v = $this->user_status_v;
  $user_type_ten = $this->user_type_ten;
  $user_type_ownr = $this->user_type_ownr;

  //Get user type
  $user_type_id = $request['user_type_val'];
  //Setting furniture
  if(!$request['property_furnishing_age'])
  {
    $request['property_furnishing_age'] = 0;
    
  }
//Setting default amenties
  if($request['property_amenties'] == 0)
  {
    $request['property_amenties'] = 7;
  }
  //Collect rental type and expected rent/deposit
  $rental_type = $request['rental_type'];
  $prop_invnt_levels = $request['prop_invnt_level'];
  $rental_type_data = false;
  $user_id = 0;
  //Validate expected rent/demposit
  if(is_array($rental_type) && is_array($prop_invnt_levels) && (count($rental_type) == count($prop_invnt_levels)))  
  {
    $rental_type_data = true;
  }
  else{
    return response()->json([
      "rc"=>"6",
      "rd"=>"Something went wrong !"
    ]);
  }
    $user_info = Auth::user();
    $user_id = $user_info->user_id;
    $email = $user_info->email;
    $mobile = $user_info->mobile;
    $name = $user_info->name;
    $password = $user_info->password;
    $owner_user_id = 0;
    $owner_check = User::where('email', $email)
                    ->where('mobile', $mobile)
                    ->where('user_type_id', $this->user_type_ownr)
                    ->where('user_status_id', $this->user_status_v)
                    ->first();
    //Check If this is user is owner also
    if($owner_check)
    {
        $owner_user_id = $owner_check->user_id;
       
    }
    if(!$owner_check or $owner_user_id == 0)
    {
        $create_owner = new User();
        $create_owner->name = $name;
        $create_owner->email = $email;
        $create_owner->mobile = $mobile;
        $create_owner->password = $password;
        $create_owner->user_type_id = $user_type_ownr;
        $create_owner->user_status_id = $user_status_v;
        if($create_owner->save())
         {
            //Get user id
            $owner_user_id = $create_owner->user_id;
         }
    }
  //Insert property now
  if(!$user_id == 0)
  {

      $state_data = TsState::where('state_id', $request['inputState'])->first();
      $state_name = $state_data->name;
      $tsSubmittedProperty = new TsSubmittedProperty();
      $tsSubmittedProperty->user_id = $owner_user_id;

      $tsSubmittedProperty->tenant_prefrences_id = $request['inputTenant'];
      $tsSubmittedProperty->prop_title = $request['property_title'];
      $tsSubmittedProperty->prop_desc = $request['property_desc'];
      $tsSubmittedProperty->prop_type_id = $request['property_type'];
      $tsSubmittedProperty->prop_bhk_id = $request['property_bhk'];      
      $tsSubmittedProperty->prop_amenty_id = $request['property_amenties'];
      $tsSubmittedProperty->prop_area = $request['property_area'];
      $tsSubmittedProperty->prop_age = $request['property_age'];
      $tsSubmittedProperty->prop_furnish_status_id = $request['property_furnishing_status'];
      $tsSubmittedProperty->prop_furniture_age = $request['property_furnishing_age'];
      $tsSubmittedProperty->prop_address_line1 = $request['addressline1'];
      $tsSubmittedProperty->prop_locality = $request['inputLocality'];
      $tsSubmittedProperty->prop_lat = $request['inputLat'];
      $tsSubmittedProperty->prop_lng = $request['inputLng'];
      $tsSubmittedProperty->prop_city = $request['inputCity'];     
      $tsSubmittedProperty->prop_pincode = $request['inputPincode'];
      $tsSubmittedProperty->prop_state = $state_name;   
      
      if($tsSubmittedProperty->save())
      {
        //Get new property id
        $tsSubmittedPropertyID = $tsSubmittedProperty->prop_id;
        //Format data for expected rent and deposit array
        $formatted_data = array();
        // return $request['exp_rent'];
        foreach ($rental_type as $key => $value) {
         
         $formatted_data[] = array(
          "prop_id" => $tsSubmittedPropertyID,
          "prop_invnt_level_id" => $request['prop_invnt_level'][$key],
          "exp_rent" =>$request['exp_rent'][$key], 
          "exp_deposit" => $request['exp_depo'][$key],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        );
          
        }
        //Insert here
        $rental_data_insert = DB::table('ts_prop_invnt_levels')->insert($formatted_data);
        if($rental_data_insert)
        {
        //Final commit
        DB::commit();
        
        $file = $request->file('add_photo_gallery');
        $filename =$tsSubmittedPropertyID.'.jpg';
        if($file)
        {
          Storage::disk('public_uploads')->put($filename, File::get($file));
        }
        //Logout this user
        Auth::logout();
        Auth::loginUsingId($owner_user_id);
        return response()->json([
          "rc"=>"1",
          "rd"=>"Your Property Successfully Posted..."
        ]);
        }
        

      }
  }
  else{
    return response()->json([
      "rc"=>"2",
      "rd"=>"Something went wrong !"
    ]);
  }

  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}
//Change Password
public function updatePwd(Request $request)
{
    try
    {
        $validator = Validator::make($request->all(), [
            'old_pwd' => 'required',
            'new_pwd' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'rc' => '2',
                "rd" => "Please select appropriate data.",
            ], 200);
        }
        DB::beginTransaction();
        $old_pwd = $request['old_pwd'];
        $new_pwd = $request['new_pwd'];
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $mobile = $userInfo->mobile;
        $email = $userInfo->email;
        $userCheck = User::where('user_id', $user_id)->where('user_type_id', $this->user_type_ten)->first();
        if (!$userCheck) {
            return response()->json([
                "rc" => "2",
                "rd" => "User does not exists.",
            ]);
        } else {
            $currentPwd = $userCheck->password;
            if (!Hash::check($old_pwd, $currentPwd)) {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Wrong password",
                ]);
            } else if (Hash::check($new_pwd, $currentPwd)) {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Password has been used already",
                ]);
            } else {
                //Check if any owner is there with same inputs
                $ownr_check = User::where('mobile', $mobile)
                    ->where('email', $email)
                    ->where('user_type_id', $this->user_type_ownr)->first();
                if ($ownr_check) {
                    $ownr_check->password = bcrypt($new_pwd);
                    if (!$ownr_check->update()) {
                        return response()->json([
                            "rc" => "2",
                            "rd" => "Something went wrong",
                        ]);
                    }
                }
                $userCheck->password = bcrypt($new_pwd);
                if ($userCheck->update()) {
                    DB::commit();
                    Auth::logout();
                    return response()->json([
                        "rc" => "1",
                        "rd" => "Password changed successfully",
                    ]);

                }
            }
        }
    } catch (\Exception $e) {
        DB::rollback();
        echo $e->getMessage();
    }
}
//Get all invoices
public function getAllTenInvoices(Request $request)
{

    try
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $email = $userInfo->email;
        $mobile = $userInfo->mobile;
        $owner_profile = false;
        $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
        //Check If this is user is owner also
        if($owner_check)
        {
            $owner_user_id = $owner_check->user_id;
            if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
            {
                $owner_profile = true;
            }
        }

        //Get all invoices against this inventory
        $all_invoices = TsInvoice::where('user_id', $user_id)
                                ->whereIn('invoice_status_id', [$this->invoice_status_s, $this->invoice_status_p])
                                ->latest()->get();
        return view('tenant_all_invoices', ['tenant' => Auth::user(), 
                                        'invoices' => $all_invoices, 'owner_profile' => $owner_profile]);

    } catch (DecryptException $e) {
        return back();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
//Get One inventory details
public function getOnePropInvnt($prop_id, $invnt_id, Request $request)
{

    try
    {
        $invnt_id = Crypt::decrypt($invnt_id);

        if (!filter_var($prop_id, FILTER_VALIDATE_INT)) {
            return back();
        }
        if (!filter_var($invnt_id, FILTER_VALIDATE_INT)) {
            return back();
        }
        if (!$request->has('check')) {
            return back();
        }
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $email = $userInfo->email;
        $mobile = $userInfo->mobile;
        $owner_profile = false;
        $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
        //Check If this is user is owner also
        if($owner_check)
        {
            $owner_user_id = $owner_check->user_id;
            if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
            {
                $owner_profile = true;
            }
        }
        $tenant_check = array();
        //Check if verified Property Exists
        $prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                                        ->where('prop_status_id', $this->prop_status_v)
                                        ->latest()->first();
        //Check if inventory exists
        $invnt_check = TsPropInventory::where('prop_id', $prop_id)
                                        ->where('user_id', $user_id)
                                        ->where('ts_prop_invnt_id', $invnt_id)
                                        ->where('fomatted_invnt_id', $request->check)
                                        ->latest()->first();
        //Get current tenants
        $tenant_check = TsTaggedTenant::where('prop_id', $prop_id)
                                    ->where('ts_prop_invnt_id', $invnt_id)
                                    ->where('tagged_tenant_status_id', $this->tenant_status_a)                            
                                    ->where('user_id', $user_id)
                                    ->latest()->first();
        if ($prop_check && $invnt_check && $tenant_check) {
            //Set this inventory to session, it will be retirved when required
            $request->session()->put('curr_ten_invnt', $invnt_id);
            
            //Get all invoices against this inventory
            $all_invoices = TsInvoice::where('prop_id', $prop_id)
                                        ->where('user_id', $user_id)
                                        ->where('ts_prop_invnt_id', $invnt_id)
                                        ->whereIn('invoice_status_id', [$this->invoice_status_s, $this->invoice_status_p])
                                        ->latest()->get();
            return view('tenant_one_invnt_details', ['tenant' => Auth::user(),'owner_profile' =>$owner_profile,
                                                    'one_tenant' => $tenant_check,'invoices' => $all_invoices, 
                                                    'invnt' => $invnt_check]);

        } else {
            return back();
        }

    } catch (DecryptException $e) {
        return back();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
//Show rental agreement
public function getRentalAgreement($tmp_id_1, Request $request)
{
    try
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_tenant_id = Crypt::decrypt($tmp_id_1);
        if (!filter_var($tagged_tenant_id, FILTER_VALIDATE_INT)) {
            return back();
        }
        if (!$request->session()->has('curr_ten_prop') or !$request->session()->has('curr_ten_invnt')) {
            return back();
        }

        $prop_id = session('curr_ten_prop');
        $invnt_id = session('curr_ten_invnt');
        //Check if all records are correct
        $check_tenants = TsTaggedTenant::where('prop_id', $prop_id)
                                    ->where('ts_prop_invnt_id', $invnt_id)
                                    ->where('user_id', $user_id)
                                    ->where('tagged_tenant_id', $tagged_tenant_id)
                                    ->latest()->first();
        if ($check_tenants) {
            $filename = $tagged_tenant_id . '.pdf';
            if (Storage::disk('rental_agrmnts')->has($filename)) {
                $formatted_name = "My_Rental_Agrmnt.pdf";
                $headers = array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $formatted_name . '"');
                return response()->file(storage_path('app/rent-agrmnts/' . $filename), $headers);
            }

        }
        return back();
    } catch (DecryptException $e) {
        return back();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
//Upload rental agreement Owner/Agent/Tenant
public function postRentAgreement(Request $request)
{
    try
    {
        $validator = Validator::make($request->all(), [
            'oat_ten_id' => 'required',
            'oat_rental_agrmnt' => 'required|max:10000|mimes:pdf',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'rc' => '2',
                "rd" => "Please select appropriate data.",
            ], 200);
        }
        if (!$request->session()->has('curr_ten_prop') or !$request->session()->has('curr_ten_invnt')) {
            return response()->json([
                "rc" => "2",
                "rd" => "Something went wrong !",
            ]);
        }
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_tenant_id = $request->oat_ten_id;
        $prop_id = session('curr_ten_prop');
        $invnt_id = session('curr_ten_invnt');
        //Check if all records are correct
        $all_tenants = TsTaggedTenant::where('prop_id', $prop_id)
            ->where('ts_prop_invnt_id', $invnt_id)
            ->where('user_id', $user_id)
            ->where('tagged_tenant_id', $tagged_tenant_id)
            ->latest()->first();
        if ($all_tenants) {
            $filename = $tagged_tenant_id . '.pdf';
            $file_exists = Storage::disk('rental_agrmnts')->has($filename);
            if (!$file_exists) {
                $file = $request->file('oat_rental_agrmnt');
                if ($file) {
                    if (Storage::disk('rental_agrmnts')->put($filename, File::get($file))) {
                        return response()->json([
                            'rc' => '1',
                            "rd" => "Agreement Saved.",
                        ], 200);
                    }
                }
                return response()->json([
                    "rc" => "2",
                    "rd" => "Cant save this file !",
                ]);
            } else {
                return response()->json([
                    'rc' => '2',
                    "rd" => "Agreement already exists.",
                ], 200);
            }
        } else {
            return response()->json([
                "rc" => "2",
                "rd" => "Something went wrong !",
            ]);
        }
    } catch (DecryptException $e) {
        return back();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
//Get invoice ID and show payment options
public function paymentOptions($tmp_id_0,$tmp_id_1, Request $request)
{
    try
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $invoice_id = Crypt::decrypt($tmp_id_0);
        $for_month = $tmp_id_1;
        if (!filter_var($invoice_id, FILTER_VALIDATE_INT)){      
            return back();
        }
        
        $email = $userInfo->email;
        $mobile = $userInfo->mobile;
        $owner_profile = false;
        $owner_check = User::where('email', $email)
                        ->where('mobile', $mobile)
                        ->where('user_type_id', $this->user_type_ownr)
                        ->where('user_status_id', $this->user_status_v)
                        ->first();
        //Check If this is user is owner also
        if($owner_check)
        {
            $owner_user_id = $owner_check->user_id;
            if (TsSubmittedProperty::where('user_id', '=', $owner_user_id)->exists())
            {
                $owner_profile = true;
            }
        }
        //Check If this user is having any oustanding invoice
        $get_invoice = TsInvoice::where('user_id', $user_id)
                                ->where('ts_invoice_id', '=',$invoice_id)
                                ->where('for_month', '=', $for_month)
                                ->where('invoice_status_id',$this->invoice_status_s)
                                ->latest()->first();
        if(!$get_invoice)
        {
            return back();
        }
        //Set this invoice id to session, it will be retirved when required
        $request->session()->put('pay_invoice_id', $invoice_id);
        return view('payment_options', ['tenant' => Auth::user(),'owner_profile' =>$owner_profile]);
    } catch (DecryptException $e) {
        return back();
    } catch (\Exception $e) {
        return back();
    }

}
//Set the Gateway credentials to session and then redirect to payment
public function redirectToPayment(Request $request)
{
    try
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id; 
        if (!$request->session()->has('pay_invoice_id') or !$request->has('method')) {
            return back();
        }
        $invoice_id = session('pay_invoice_id'); 
        $method = $request->method;
        //Gateway api and auth token array
        $gateway_credentials = array();
        //Check If this user is having any oustanding invoice
        $get_invoice = TsInvoice::where('user_id', $user_id)
                                ->where('ts_invoice_id', '=',$invoice_id)
                                ->where('invoice_status_id',$this->invoice_status_s)
                                ->latest()->first();
                                
    if($get_invoice)
    {
        // Server - Instamojo
        // Pay by Net Banking (Zero Convenience charges), Userid - Rental.mozitoo@gmail.com
        if($method == 1)
        {
            $gateway_credentials = array("X-Api-Key:bc7e9af902e053ccdd6ff271f35330fb",
                        "X-Auth-Token:3a9a2ee6e01aba919175c98820a85fdd");
        }
        // Pay by Debit Card (1 % charges), Userid: Rental.mozitoo.1@gmail.com
        else if($method == 2)
        {
            $gateway_credentials = array("X-Api-Key:529aa9a915a834ee14baf96fa9f0a2c5",
                        "X-Auth-Token:240d8e6463d0c76049db7f72bdad6290");
        }
        // Pay by Credit Card, Wallets and EMI (1.5 % charges), Userid: Rental.mozitoo.2@gmail.com
        else if($method == 3)
        {
            $gateway_credentials = array("X-Api-Key:13b3d22aa1485918e72cfcc40640e3cf",
                        "X-Auth-Token:eef6ec4ae2f026930e72afa81ca3680d");
        }
        //Server - Paymatrix
        else if($method == 4)
        {
            $gateway_credentials = array("Secretkey"=>"9417af34dwqr3asa4e44795b7ae302fa3b",
                                        "ClientId"=>"583fd5456781b");
        }
        else
        {
            return back();
        }
        if(!isset($gateway_credentials) or !is_array($gateway_credentials) or empty($gateway_credentials))
        {
            return back();
        }
        //Set the correct gateway crendetials and method to session, it will be used when capturing the payment
        $request->session()->put('gateway_cred', $gateway_credentials);
        $request->session()->put('pay_method', $method);
        return redirect()->route('tenant.pay.now');
        
    }
    return back();
    } catch (\Exception $e) {
        return back();
    }

}

//Redirect to payment option selcted
public function payNow(Request $request)
{

    try
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id; 
        if (!$request->session()->has('pay_invoice_id') or !$request->session()->has('gateway_cred') or !$request->session()->has('pay_method')) 
        {
            return back();
        }
        $invoice_id = session('pay_invoice_id'); 
        $method = session('pay_method'); 
        //Gateway api and auth token array
        $gateway_credentials = session('gateway_cred');
        if(!isset($gateway_credentials) or !is_array($gateway_credentials) or empty($gateway_credentials))
        {
            return back();
        }
        //Check If this user is having any oystanding invoice
        $get_invoice = TsInvoice::where('user_id', $user_id)
                                ->where('ts_invoice_id', '=',$invoice_id)
                                ->where('invoice_status_id',$this->invoice_status_s)
                                ->latest()->first();
                                
    if($get_invoice)
    {
        //Redirect to Instamojo server
        if($method == 1 or $method == 2 or $method == 3)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->insta_server_url);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $gateway_credentials);
            $payload = Array(
                'purpose' => "MOZI".$invoice_id,
                'amount' => $get_invoice->payable_amount,
                'phone' => $userInfo->mobile,
                'email' => $userInfo->email,
                'buyer_name' => $userInfo->name,
                'redirect_url' => route('tenantaccount'),
                'send_email' => false,
                'webhook' => 'https://fd4e4ec6.ngrok.io/mozitoo/myaccount',
                'send_sms' => false, 
                'allow_repeated_payments' => false
            );
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch); 
            $data = json_decode($response, true);
            $pay_url = $data['payment_request']['longurl'];
            header("Location: $pay_url");
            exit();
        }
        //Redirect to Paymatrix Server
        else if($method == 4)
        {
            $Secretkey = $gateway_credentials['Secretkey'];
            $ClientId = $gateway_credentials['ClientId'];
            $payload = Array(
                    'ClientId' => $ClientId,
                    'Name' => $userInfo->name,
                    'Email' => $userInfo->email,
                    'Phone' => $userInfo->mobile,
                    'Amount' => $get_invoice->payable_amount,
                    'Description' => 'Mozitoo Rental Payment',
                    'Client_transaction_id' => "MOZI".$invoice_id,
                    'returnurl' => route('tenant.capture.payment.paymatrix')
                );
            $hash_string = '';
            foreach($payload as $hash_var)
            {
                $hash_string .= $hash_var;
                $hash_string .= '|'; 
            }
            $hash_string .= $Secretkey;
            $hash = strtolower(hash('sha512', $hash_string));
            $html='
            <html>
            <head>
            <meta HTTP-EQUIV="Content-Type" CONTENT="text/html;CHARSET=iso-8859-1">
            </head>
            <body>
            <form align="center" id="payuForm" method="post" action="'.$this->paymatrix_server_url.'" name="payuForm">
            <input type="hidden" id="key" name="ClientId" value="'.$payload['ClientId'].'" /> 
            <input type="hidden" id="key" name="Name" value="'.$payload['Name'].'" /> 
            <input type="hidden" id="key" name="Email" value="'.$payload['Email'].'" /> 
            <input type="hidden" id="key" name="Phone" value="'.$payload['Phone'].'" /> 
            <input type="hidden" id="key" name="Amount" value="'.$payload['Amount'].'" />
            <input type="hidden" id="key" name="Description" value="'.$payload['Description'].'" /> 
            <input type="hidden" id="key" name="Client_transaction_id" value="'.$payload['Client_transaction_id'].'" />
            <input type="hidden" id="key" name="returnurl" value="'.$payload['returnurl'].'" /> 
            <input type="hidden" id="key" name="hash" value="'.$hash.'" />
            </form>
            </body>
            </html>
            <script type="text/javascript">
            function myfunc ()
            {
                var frm = document.getElementById("payuForm");
                frm.submit();
            } 
            window.onload = myfunc;
            </script>';
            return $html;
        }
        else
        {
            return back();
        }
    }
    return back();
    }catch (\Exception $e) {
        return back();
    }
}
//After payment from Paymatrix server, payment will be captured here
public function capturePaymentPmatrix(Request $request)
{
    try
    {
        DB::beginTransaction();
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id; 
        $payment_data = $request->request->all();
        if($payment_data && isset($payment_data) && !empty($payment_data) && is_array($payment_data) && $request->session()->has('gateway_cred') && $request->session()->has('pay_method') && $request->session()->has('pay_invoice_id'))
        {
            //Gateway api and auth token array
            $gateway_credentials = session('gateway_cred');
            $Secretkey = $gateway_credentials['Secretkey'];
            $ClientId = $gateway_credentials['ClientId'];
            $method = session('pay_method'); 
            $invoice_id = session('pay_invoice_id');
            $invoice_f_id = substr($payment_data['client_transaction_id'], 4);
            //Transaction success/failure flag
            $tr_paymatrix_flag = 1;
            if($method == 4 && $invoice_id == $invoice_f_id)
            {
               
                if($payment_data['status'] == "SUCCESS")
                {
                    // Payment was successful, mark it as successful in your database.
                    //Remove invoice id, and gateway credentails, pay method from session
                    $request->session()->forget('pay_invoice_id');
                    $request->session()->forget('gateway_cred');
                    $request->session()->forget('pay_method');
                    $get_this_invoice = TsInvoice::where('user_id', $user_id)
                                            ->where('ts_invoice_id', '=',$invoice_f_id)
                                            ->where('invoice_status_id',$this->invoice_status_s)
                                            ->latest()->first();
                                            
                    if($get_this_invoice)
                    {
                        
                        $get_this_invoice->invoice_status_id = $this->invoice_status_p;
                        $get_this_invoice->payment_type_id = $this->payment_type_o;
                        $get_this_invoice->payment_transaction_id = $payment_data['transaction_id'];
                        if($get_this_invoice->update())
                        {
                            DB::commit();
                            if(Storage::disk('invoice')->has($invoice_f_id.'.pdf'))
                            {
                                Storage::disk('invoice')->delete($invoice_f_id.'.pdf');
                            }
                            //Transaction success flag
                            $tr_paymatrix_flag = 2;
                            if($get_this_invoice->msTenantFun)
                            {
                                $name = $get_this_invoice->msTenantFun->name;
                                if($get_this_invoice->msTenantFun->mobile)
                                {
                                    $mobile = $get_this_invoice->msTenantFun->mobile;
                                }
                                if($get_this_invoice->msTenantFun->email)
                                {
                                    $email = $get_this_invoice->msTenantFun->email;
                                }
                            }
                            $message = "Hi ".ucwords($name). ". You have paid the Inoice ".$payment_data['client_transaction_id'].".pdf . Your payment transaction id is ".$payment_data['transaction_id'];
                            $obj = new CustomFunctions();
                            if($mobile)
                            {
                                $obj->sendSMS($mobile, $message);
                            }
                            if($email)
                            {
                                $obj->sendInvConf($email, $message);
                            }
                        }
                        else
                        {
                            //Transaction Success but Invalid Authrization flag
                            $tr_paymatrix_flag = 3;
                        }
                    }
                    else
                    {
                        //Transaction Success but Invalid Authrization flag
                        $tr_paymatrix_flag = 3;
                    }
                    //Set paymatix success flag to session
                    $request->session()->put('tr_paymatrix_flag', $tr_paymatrix_flag);
                    //Set paymatix transaction id to session
                    $request->session()->put('transaction_id', $payment_data['transaction_id']); 
                    return redirect()->route('tenantaccount');
                    
                }
                else{
                    // Payment was unsuccessful, mark it as failed in your database.
                    //Transaction failure flag
                    $tr_paymatrix_flag = 3;
                    //Set paymatix success flag to session
                    $request->session()->put('tr_paymatrix_flag', $tr_paymatrix_flag);
                    //Set paymatix transaction id to session
                    $request->session()->put('transaction_id', $payment_data['transaction_id']);
                    return redirect()->route('tenantaccount');
                }
            }
            else
            {
                return back();
            }
        }
        else
        {
            return back();
        }
    }catch (\Exception $e) {
        DB::rollback();
        return back();
    }
    
}
//Instamojo webhook
public function paymentWebhook(Request $request)
{
try
{
DB::beginTransaction();
$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data), "<YOUR_SALT>");
if($mac_provided == $mac_calculated){
    if($data['status'] == "Credit"){
        // Payment was successful, mark it as successful in your database.
        // You can acess payment_request_id, purpose etc here. 
        $invoice_id = substr($data['purpose'], 4);
        $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                                    ->where('invoice_status_id',$this->invoice_status_s)
                                    ->latest()->first();
        if($get_invoice)
        {
            $get_invoice->invoice_status_id = $this->invoice_status_p;
            if($get_invoice->update())
            {
                DB::commit();
            }
        }



    }
    else{
        // Payment was unsuccessful, mark it as failed in your database.
        // You can acess payment_request_id, purpose etc here.
    }
}
else{
    echo "MAC mismatch";
}

} catch (\Exception $e) {
    DB::rollback();
    echo $e->getMessage();
}
}
//End of file
}
