<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use App\MsPropBhkType;
use App\TsPropInvntLevel;
use App\MsPropertyFurnishStatus;
use App\TsEditedSubmittedProperty;
use App\User;
Use App\Jobs\SendBulkEmail;
Use App\Jobs\SendBulkSMS;
Use App\Jobs\SendReminderEmail;
use App\TsWallet;
use App\TsInvoice;
use App\MsInvoiceItem;
use App\TsInvoiceItem;
use App\TsState;
use App\TsTaggedTenant;
use Carbon\Carbon;
use PDF;
use Validator;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AdminDashboardController extends Controller
{

  //Global variables

  public function __construct()
  {
    //Set maximun execution time
    ini_set('max_execution_time', 600); //10 minutes
    //Property Status
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
    $this->user_type_ten = 2;
    $this->user_type_ownr = 3;
    //Active tenant
    $this->tenant_status_a = 1;
    $this->tenant_status_d = 2;

    //Verified user
    $this->user_status_v = 1;
    //Bulk invoice type id
    $this->inv_type_b = 1;
    //Custom invoice type id
    $this->inv_type_c = 2;
    //Cashback flow id
    $this->flow_add_id = 1;
    $this->flow_sub_id = 2;
    //Invoice status
    //Created
    $this->invoice_status_c = 1;
    //Sent to tenants
    $this->invoice_status_s = 2;
    //Paid
    $this->invoice_status_p = 3;

    //Invoice item types
    //1. Rent
    $this->inv_item_r = 1;
    //2. Manintenace charge
    $this->inv_item_m = 2;
    //3. Cashback
    $this->inv_item_c = 3;
  }


  //Get Admin Dashboard
  public function getAdminDashboard()
  {
    //Global variables
    $prop_status_p = $this->prop_status_p;
    $prop_status_v = $this->prop_status_v;

    $admin_action_id = 0;
    $activeProp = false;
    $ownerPropCount = false;
    $ownerProp = [];
    $ownerPropDetails = [];
    $tsActiveProperties =[];
    $tenantUserID = [];
    $tenantUserIDCount = 0;
    $tenantPropCount = false;
	  $totalAgentCount = 0;
    $tsPendingPropertiesCount = TsSubmittedProperty::where('prop_status_id', $prop_status_p)->count();
    $tsEditedSubmittedPropertyCount = TsEditedSubmittedProperty::where('prop_status_id', $prop_status_p)->count();

    $tsActivePropertiesCount = TsSubmittedProperty::where('prop_status_id', $prop_status_v)->count();
    if($tsActivePropertiesCount > 0)
    {
      $activeProp = true;
      $tsActiveProperties = TsSubmittedProperty::where('prop_status_id', $prop_status_v)->get();
      if(count($tsActiveProperties) > 0)
      {

        //Check all owners property
        foreach ($tsActiveProperties as $key)
        {
          if($key->userFun->userTypeFun->user_type_id == 3)
          {
              $ownerPropCount =  true;
              $ownerProp[] = $key->prop_id;
          }

        }
      }
      if(!empty($ownerProp))
      {
        $ownerPropDetailsCount = TsSubmittedProperty::whereIn('prop_id', $ownerProp)->count();
        if($ownerPropDetailsCount > 0)
        {
          $ownerPropDetails = TsSubmittedProperty::whereIn('prop_id', $ownerProp)->get();

        }
      }
      //Check ALl tagged property to tenat
      $tsPropertiesSubmittedTenTagged = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_v)->get();
      $tsTenantTaggedCount = TsTaggedProperty::whereIn('prop_id', $tsPropertiesSubmittedTenTagged)->count();
      if($tsTenantTaggedCount > 0)
      {
        $tsTenantTagged = TsTaggedProperty::whereIn('prop_id', $tsPropertiesSubmittedTenTagged)->get();
        foreach ($tsTenantTagged as $key)
        {
           if($key->userFun->userTypeFun->user_type_id == 2)
           {
               $tenantPropCount =  true;
               $tenantUserID[] = $key->user_id;

           }
        }
      }
      if($tenantPropCount == true)
      {
        $tenantUserIDCount = count($tenantUserID);

      }
      // Check All Agent avaible
      $agent_type_id = 4;
      $totalAgentCount = User::where('user_type_id', $agent_type_id)->count();

    }

    return view('admin', ['admin'=>Auth::user(),
    'pendingPropertiesCount'=>$tsPendingPropertiesCount,
    'tsEditedSubmittedPropertyCount'=>$tsEditedSubmittedPropertyCount,
    'activeProp'=>$activeProp, 'tsActiveProperties'=>$tsActiveProperties,
    'ownerPropCount'=>$ownerPropCount, 'ownerPropDetails'=>$ownerPropDetails,
    'tenantPropCount'=>$tenantPropCount,'tenantUserIDCount'=>$tenantUserIDCount,
    'totalAgent'=>$totalAgentCount]);

  }
  // Agent Tag check

  public function getTagCheckAgent(Request $request)
  {
    $prop_id = $request['propID'];
    $prop_status_id = 1;
    $agentTaggedCheck = false;
    $agentPropCount = false;
    $oneOwnerProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
    if($oneOwnerProperty)
    {
      $tstaggedCheck = TsTaggedProperty::where('prop_id', $prop_id)->get();
      foreach ($tstaggedCheck as $key)
      {
         if($key->userFun->userTypeFun->user_type_id == 4)
         {
             $agentPropCount =  true;
             $taggedAgentID = $key->user_id;
             $taggedID = $key->prop_tagged_id;
             break;
         }

      }
      if($agentPropCount == true)
      {
        $user_id = $taggedAgentID;
        $user_type_id = 4;
        $user = User::where('user_id', $user_id)->where('user_type_id',$user_type_id)->first();
        if($user)
        {
            $agentTaggedCheck =  true;
            $e = $user->email;
            return response()->json([
                    'rc'=>'1',
                    'e'=>$e,
                    'i'=>$taggedID
                ],200);
        }
        else {
          return response()->json([
                  'rc'=>'2'
              ],200);
        }
      }
      else {
        return response()->json([
                'rc'=>'2'
            ],200);
      }

    }
    else {
      return response()->json([
              'rc'=>'3'
          ],200);
    }
  }

  // Agent Tag check

  public function getTagCheckTenat(Request $request)
  {
    $prop_id = $request['propID'];
    $prop_status_id = 1;
    $tenatTaggedCheck = false;
    $tenantPropCount = false;
    $oneProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
    if($oneProperty)
    {
      $tstaggedCheck = TsTaggedProperty::where('prop_id', $prop_id)->get();
      foreach ($tstaggedCheck as $key)
      {
         if($key->userFun->userTypeFun->user_type_id == 2)
         {
             $tenantPropCount =  true;
             $taggedTenantID[] = $key->user_id;
             $taggedID[] = $key->prop_tagged_id;
             $taggedRent[] = $key->tenant_rent;

         }

      }
      if($tenantPropCount == true)
      {

        $user_id= $taggedTenantID;
        $totalCountUser = count($user_id);
        $user_type_id = 2;
        $userCount = User::whereIn('user_id', $user_id)->where('user_type_id',$user_type_id)->count();
        if($userCount > 0)
        {

            $user = User::whereIn('user_id', $user_id)->where('user_type_id',$user_type_id)->get();
            $tenatTaggedCheck =  true;

            return response()->json([
                    'rc'=>'1',
                    'emails'=>$user,
                    'taggedids'=>$taggedID,
                    'rent'=> $taggedRent
                ],200);
        }
        else {
          return response()->json([
                  'rc'=>'2'
              ],200);
        }
      }
      else {
        return response()->json([
                'rc'=>'2'
            ],200);
      }

    }
    else {
      return response()->json([
              'rc'=>'3'
          ],200);
    }
  }




    //Get all Pending properties
    public function  getPendingProperty()
    {

      //Global variables
      $prop_status_p = $this->prop_status_p;
      $prop_status_v = $this->prop_status_v;
      $data = false;
      $tsPendingPropertiesCount = TsSubmittedProperty::where('prop_status_id', $prop_status_p)->count();
      if($tsPendingPropertiesCount > 0)
      {
      $tsPendingProperties = TsSubmittedProperty::where('prop_status_id', $prop_status_p)->get();
      $data = true;
      return view('requests', ['admin'=>Auth::user(),'data'=>$data, 'pendingProperties'=>$tsPendingProperties]);

      }

      return view('requests', ['admin'=>Auth::user(),'data'=>$data]);

    }

    //Get all Pending properties
    public function  getEditedProperty()
    {

      $prop_status_id = 0;
      $data = false;
      $tsPendingPropertiesCount = TsEditedSubmittedProperty::where('prop_status_id', $prop_status_id)->count();
      if($tsPendingPropertiesCount > 0)
      {
      $tsPendingProperties = TsEditedSubmittedProperty::where('prop_status_id', $prop_status_id)->get();
      $data = true;
      return view('editedrequests', ['admin'=>Auth::user(),'data'=>$data, 'pendingProperties'=>$tsPendingProperties]);

      }

      return view('editedrequests', ['admin'=>Auth::user(),'data'=>$data]);

    }

    //Get all Pending service requests
    public function  getAllServiceReq()
    {

      $admin_action_id = 0;
      $data = false;
      $tsServiceRequestsCount = TsServiceRequest::count();
      if($tsServiceRequestsCount > 0)
      {
      $tsServiceRequests = TsServiceRequest::all();
      $data = true;
      return view('servicerequests', ['admin'=>Auth::user(),'data'=>$data, 'tsServiceRequests'=>$tsServiceRequests]);

      }

      return view('servicerequests', ['admin'=>Auth::user(),'data'=>$data]);

    }
    //Get one service request
    public function getServiceRequestDetails($request_id)
    {

      $tag_prop_request_id = $request_id;
      $admin_action_id = 0;
      $reqData = false;
      $reqByData = false;
      $reqToData = false;
      $tsTagPropertyRequestsCheck = TsTagPropertyRequest::where('tag_prop_request_id', $tag_prop_request_id)->where('admin_action_id', $admin_action_id)->first();
      if($tsTagPropertyRequestsCheck)
      {
        $tsTagPropertyRequest = TsTagPropertyRequest::where('tag_prop_request_id', $tag_prop_request_id)->where('admin_action_id', $admin_action_id)->first();
        $reqData = true;
        $requestByID = $tsTagPropertyRequest->user_id;
        $requestID = $tsTagPropertyRequest->tag_prop_request_id;
        $tsTaggedPropertyTo = TsTaggedProperty::where('tag_prop_request_id', $requestID)->first();
        $requestToID = $tsTaggedPropertyTo->user_id;
        $requestBy = User::where('user_id', $requestByID)->first();
        if($requestBy)
        {
          $reqByData = true;
        }
        $requestTo = User::where('user_id', $requestToID)->first();
        if($requestTo)
        {
          $reqToData = true;
        }

        return view('serviceRequestdetails', ['admin'=>Auth::user(),'reqData'=>$reqData, 'onePendingServiceRequest'=>$tsTagPropertyRequest, 'reqByData'=>$reqByData, 'requestBy'=>$requestBy, 'reqToData'=>$reqToData, 'requestTo'=>$requestTo]);

      }

      return redirect()->route('servicerequests.all');


    }

    //Update service request
    public function updateOneServiceReq(Request $request)
    {
        $serviceReqID = $request['serviceReqID'];
        $admin_action_id = 0;
        $tsTagPropertyRequestsCheck = TsTagPropertyRequest::where('tag_prop_request_id', $serviceReqID)->where('admin_action_id', $admin_action_id)->first();
        if($tsTagPropertyRequestsCheck)
        {
          $admin_action_id = 1;
          $tsTagPropertyRequestsCheck->admin_action_id = $admin_action_id;
          if($tsTagPropertyRequestsCheck->update())
          {
            $tagged_prop_status_id = 0;
            $tsTaggedProperty = TsTaggedProperty::where('tag_prop_request_id', $serviceReqID)->where('tagged_prop_status_id', $tagged_prop_status_id)->first();
            $tagged_prop_status_id = 1;
            $tsTaggedProperty->tagged_prop_status_id = $tagged_prop_status_id;
            if($tsTaggedProperty->update())
            {
              return response()->json([
                      'rc'=>'1',
                      "rd"=>"Request Verified"
                  ],200);
            }

          }


        }
        return redirect()->route('servicerequests.all');

    }

    //Get Pending One property
    public function getOnePendingProperty($prop_id)
    {
         //Global variables
        $prop_status_p = $this->prop_status_p;
        $prop_status_v = $this->prop_status_v;
        $onePendingProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_p)->first();
        if($onePendingProperty)
        {
        //Get master table data
        $msTenantPrefrence = MsTenantPrefrence::all();
        $msPropertyType = MsPropertyType::all();
        $msPropBhkType = MsPropBhkType::all();
        $msPropertyFurnishStatus = MsPropertyFurnishStatus::all();
        $amenities = $onePendingProperty->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();

        $ts_prop_invnt_levels = TsPropInvntLevel::where('prop_id', $prop_id)->where('invnt_level_status_id',1)->groupBy('prop_invnt_level_id')->distinct()->get();

        return view('pendingpropertydetails',['admin'=>Auth::user(),'one_prop'=>$onePendingProperty,
        "msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,
        'msPropertyAmentyAll'=>$msPropertyAmentyAll,
        'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
        'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
        'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
        'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
        'ts_prop_invnt_levels' => $ts_prop_invnt_levels,'n_a' => 'N/A']);

        }

        return redirect()->route('requests');


    }

    //Get Pending One property
    public function getOnePendingEditedProperty($prop_id)
    {
        $prop_status_id = 0;
        $onePendingProperty = TsEditedSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        if($onePendingProperty)
        {

        $amenities = $onePendingProperty->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();
        return view('editedpropdetails',['admin'=>Auth::user(),'oneProperty'=>$onePendingProperty,"msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,'msPropertyAmentyAll'=>$msPropertyAmentyAll]);

        }

        return redirect()->route('editedrequests');


    }
    //update pending property
    public function updatePendingProperty(Request $request)
    {
      try
      {
      //Global variables
      $prop_status_p = $this->prop_status_p;
      $prop_status_v = $this->prop_status_v;
      $invnt_level_status_p = $this->invnt_level_status_p;
      $invnt_level_status_v = $this->invnt_level_status_v;
      //Get Prop ID
      $prop_id = $request['prop_id'];
      //Get manager email
      $prop_mgr_id = $request['prop_mgr_id'];
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
      //Expected rent/deposit, inventory level and morp array
      $prop_invnt_levels = $request['prop_invnt_level'];
      $exp_rents = $request['exp_rent'];
      $exp_depos = $request['exp_depo'];
      $prop_morps = $request['property_morp'];
      $ts_prop_invnt_level = $request['ts_prop_invnt_level'];
      $rental_type_data = false;
      //Validate expected rent/demposit
      if(is_array($prop_invnt_levels) && is_array($exp_rents) && is_array($exp_depos) && is_array($prop_morps) && is_array($ts_prop_invnt_level) && (count($prop_invnt_levels) == count($exp_rents) && count($exp_rents) == count($exp_rents)))
      {
        $rental_type_data = true;
        $ts_prop_invnt_levels_count = TsPropInvntLevel::where('prop_id', $prop_id)->whereIn('ts_prop_invnt_level_id', $ts_prop_invnt_level)->where('invnt_level_status_id', $invnt_level_status_p)->count();
        if($ts_prop_invnt_levels_count == count($ts_prop_invnt_level))
        {
          $rental_type_data = true;

        }
        else{
          return response()->json([
            "rc"=>"3",
            "rd"=>"Something went wrong !"
          ]);
        }

      }
      else{
        return response()->json([
          "rc"=>"3",
          "rd"=>"Something went wrong !"
        ]);
      }
        //Begin Transaction
        DB::beginTransaction();
        $tsSubmittedProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_p)->first();
        if(!$tsSubmittedProperty)
        {
          return response()->json([
            'rc'=>'3',
            "rd"=>"Something went wrong."
        ],200);
        }
          else
          {
              $emailCheck = User::where('email', $prop_mgr_id)->where('user_type_id', 4)->first();
              if(!$emailCheck && $prop_mgr_id)
              {
                return response()->json([
                  "rc"=>"2",
                  "rd"=>"Property manager is not registered."
                ]);
              }
              else {

                $tsSubmittedProperty->prop_status_id = $prop_status_v;
                $tsSubmittedProperty->tenant_prefrences_id = $request['inputTenant'];
                $tsSubmittedProperty->prop_title = $request['property_title'];
                $tsSubmittedProperty->prop_desc = $request['property_desc'];
                $tsSubmittedProperty->prop_type_id = $request['property_type'];
                $tsSubmittedProperty->prop_bhk_id = $request['property_bhk'];
                $tsSubmittedProperty->prop_amenty_id = $request['property_amenties'];
                $tsSubmittedProperty->prop_area = $request['property_area'];
                $tsSubmittedProperty->prop_age = $request['property_age'];
                $tsSubmittedProperty->prop_furnish_status_id = $request['propertyFurnishingStatus'];
                $tsSubmittedProperty->prop_furniture_age = $request['property_furnishing_age'];
                $tsSubmittedProperty->prop_address_line1 = $request['propertyAddressLine1'];
                $tsSubmittedProperty->prop_locality = $request['propertyLocation'];
                $tsSubmittedProperty->prop_lat = $request['inputLat'];
                $tsSubmittedProperty->prop_lng = $request['inputLng'];
                $tsSubmittedProperty->prop_city = $request['propertyCity'];
                $tsSubmittedProperty->prop_pincode = $request['propertyPincode'];
                $tsSubmittedProperty->prop_state = $request['propertyState'];

                if($tsSubmittedProperty->update())
                {

                  if($rental_type_data)
                  {

                    //Format data for morp
                    $formatted_data = array();
                    foreach ($ts_prop_invnt_level as $key => $value) {

                    $formatted_data = array(
                      "morp" => $request['property_morp'][$key],
                      "exp_rent" =>$request['exp_rent'][$key],
                      "exp_deposit" => $request['exp_depo'][$key],
                      "invnt_level_status_id" => $invnt_level_status_v,
                      'updated_at' => Carbon::now()
                    );

                    $rental_data_update = DB::table('ts_prop_invnt_levels')->where('prop_id', $prop_id)->where('ts_prop_invnt_level_id',$value)->where('invnt_level_status_id',1)->update($formatted_data);

                   }
                      if($rental_data_update)
                      {

                        //Check if property is listed by agent then dont tag
                        if($prop_mgr_id)
                        {
                          $tagged_prop_status_id = 1;
                          $user_id = $emailCheck->user_id;
                          $tsTaggedProperty = new TsTaggedProperty();
                          $tsTaggedProperty->prop_id = $prop_id;
                          $tsTaggedProperty->user_id = $user_id;
                          $tsTaggedProperty->tagged_prop_status_id = $tagged_prop_status_id;
                          if($tsTaggedProperty->save())
                          {
                            $file = $request->file('property_pic');
                            $filename =$prop_id.'.jpg';
                            if($file)
                            {
                              Storage::disk('public_uploads')->put($filename, File::get($file));
                            }
                            DB::commit();
                            return response()->json([
                                    'rc'=>'1',
                                    "rd"=>"Property Successfully Updated."
                                ],200);
                          }
                          else {
                            return response()->json([
                                    'rc'=>'3',
                                    "rd"=>"Something went wrong"
                                ],200);
                          }
                        }
                        else{
                          $file = $request->file('property_pic');
                          $filename =$prop_id.'.jpg';
                          if($file)
                          {
                            Storage::disk('public_uploads')->put($filename, File::get($file));
                          }
                          DB::commit();
                          return response()->json([
                                  'rc'=>'1',
                                  "rd"=>"Property Successfully Updated."
                              ],200);

                        }
                      }
                      else {
                        return response()->json([
                                'rc'=>'3',
                                "rd"=>"Something went wrong"
                            ],200);
                      }
                   }
                   else {
                    return response()->json([
                            'rc'=>'3',
                            "rd"=>"Something went wrong"
                        ],200);
                  }

                }
                else {
                  return response()->json([
                          'rc'=>'3',
                          "rd"=>"Something went wrong"
                      ],200);
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
    //Get all property
    public function getAllProperty()
    {
      //Global variables
      $prop_status_p = $this->prop_status_p;
      $prop_status_v = $this->prop_status_v;
      $data = false;
      $tsPendingPropertiesCount = TsSubmittedProperty::where('prop_status_id', $prop_status_v)->count();
      if($tsPendingPropertiesCount > 0)
      {
      $tsPendingProperties = TsSubmittedProperty::where('prop_status_id', $prop_status_v)->get();
      $data = true;
      return view('adminproperties', ['admin'=>Auth::user(),'data'=>$data, 'allProperties'=>$tsPendingProperties]);

      }

      return view('adminproperties', ['admin'=>Auth::user(),'data'=>$data]);
    }

    //Get One property
    public function getOneProperty($prop_id)
    {
        //Global variables
        $prop_status_p = $this->prop_status_p;
        $prop_status_v = $this->prop_status_v;
        $taggedProperty = false;
        $tsTaggedProperty = [];
        $oneProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_v)->first();
        if($oneProperty)
        {
          $prop_id = $oneProperty->prop_id;
          $tsTaggedPropertyCount = TsTaggedProperty::where('prop_id', $prop_id)->count();
          if($tsTaggedPropertyCount > 0)
          {
            $taggedProperty = true;
            $tsTaggedProperty = TsTaggedProperty::where('prop_id', $prop_id)->get();
          }
        $amenities = $oneProperty->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();
        return view('oneadminproperty',['admin'=>Auth::user(),'oneProperty'=>$oneProperty,"msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,'msPropertyAmentyAll'=>$msPropertyAmentyAll,'taggedProperty'=>$taggedProperty,'tsTaggedProperty'=>$tsTaggedProperty]);

        }

        return redirect()->route('property.all');


    }
    //update one property
    public function updateOneProperty(Request $request)
    {

      $prop_id = $request['propertyID'];
      $prop_status_id = 1;
      $tsSubmittedProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
      if(!$tsSubmittedProperty)
      {
        return response()->json([
                'rc'=>'3'
            ],200);
      }
      else {
        $propertyTitle = $request['propertyTitle'];
        $propertyDesc = $request['propertyDesc'];
        $inputTenant = $request['inputTenant'];
        $propertyType = $request['propertyType'];
        $propertyFurnishingStatus = $request['propertyFurnishingStatus'];
        $propertyFurnishingAge = $request['propertyFurnishingAge'];
        $propertyBeds = $request['propertyBeds'];
        $propertyBaths = $request['propertyBaths'];
        $propertyAge = $request['propertyAge'];
        $propertyArea = $request['propertyArea'];
        $propertyPrice = $request['propertyPrice'];
        $propertyAddressLine1 = $request['propertyAddressLine1'];
        $propertyLocation = $request['propertyLocation'];
        $propertyCity = $request['propertyCity'];
        $propertyPincode = $request['propertyPincode'];
        $propertyState = $request['propertyState'];
        $propertyAmenties = $request['propertyAmenties'];
        $inputLat = $request['inputLat'];
        $inputLng = $request['inputLng'];
        $propertyMORP = $request['propertyMORP'];
        $tsSubmittedProperty->prop_status_id = $prop_status_id;
        $tsSubmittedProperty->tenant_prefrences_id = $inputTenant;
        $tsSubmittedProperty->prop_title = $propertyTitle;
        $tsSubmittedProperty->prop_desc = $propertyDesc;
        $tsSubmittedProperty->prop_type_id = $propertyType;
        $tsSubmittedProperty->prop_rent = $propertyPrice;
        $tsSubmittedProperty->prop_bed = $propertyBeds;
        $tsSubmittedProperty->prop_bath = $propertyBaths;
        $tsSubmittedProperty->prop_area = $propertyArea;
        $tsSubmittedProperty->prop_age = $propertyAge;
        $tsSubmittedProperty->prop_furnish_status_id = $propertyFurnishingStatus;
        $tsSubmittedProperty->prop_furniture_age = $propertyFurnishingAge;
        $tsSubmittedProperty->prop_city = $propertyCity;
        $tsSubmittedProperty->prop_state = $propertyState;
        $tsSubmittedProperty->prop_pincode = $propertyPincode;
        $tsSubmittedProperty->prop_address_line1 = $propertyAddressLine1;
        $tsSubmittedProperty->prop_locality = $propertyLocation;
        $tsSubmittedProperty->prop_lat = $inputLat;
        $tsSubmittedProperty->prop_lng = $inputLng;
        $tsSubmittedProperty->prop_morp = $propertyMORP;
        if(!$propertyAmenties==0)
        {
            $tsSubmittedProperty->prop_amenty_id = $propertyAmenties;
        }
        else {
          $tsSubmittedProperty->prop_amenty_id = 7;
        }

        if($tsSubmittedProperty->update())
        {
          $file = $request->file('propertyPic');
          $filename =$prop_id.'.jpg';
          if($file)
          {
            Storage::disk('public_uploads')->put($filename, File::get($file));
          }
          return response()->json([
                  'rc'=>'1',
                  "rd"=>"Property Successfully Updated."
              ],200);
        }
        else {
          return response()->json([
                  'rc'=>'2',
                  "rd"=>"Something went wrong."
              ],200);
        }

      }
    }
    //Get Delete One property
    public function getDeleteOneProperty($prop_id)
    {
      $prop_id = $prop_id;
      $prop_status_id = 1;
      $oneProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();


      if(!$oneProperty)
      {
        return redirect()->route('property.all');
      }
      $oneProperty->delete();
      TsEditedSubmittedProperty::where('prop_id', $prop_id)->delete();
      TsServiceRequest::where('prop_id', $prop_id)->delete();
      TsTaggedProperty::where('prop_id', $prop_id)->delete();
      return redirect()->route('property.all');
    }
    //Get Delete One property
    public function getDeleteOneEditedProperty($prop_id)
    {
      $prop_id = $prop_id;
      $prop_status_id = 1;
      $oneProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();

      if(!$oneProperty)
      {
        return redirect()->route('property.all');
      }
      TsEditedSubmittedProperty::where('prop_id', $prop_id)->delete();
      return redirect()->route('property.all');
    }
    //Get Submit form
    public function getSubmitForm()
    {
      $msPropertyAmenty = MsPropertyAmenty::all();
      return view('adminsubmitform',
      [
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,'admin'=>Auth::user()
    ]);

    }
    // logout
      public function getLogout()
      {
          Auth::logout();
          return redirect()->route('adminaccess');
      }
      //Get Property Image
      public function getPropImage($filename)
      {
        $file = Storage::disk('public_uploads')->get($filename);
        return new Response($file, 200);
      }
      //Save form
      public function submitNewForm(Request $request)
      {
        $name = $request['new_user_name'];
        $email = $request['new_user_email'];
        $mobile = $request['new_user_mobile'];
        $password = $request['new_user_pwd'];
        $user_type_id = $request['inputManager'];
        $password = bcrypt($password);

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
          $user_status_id = 1;
          $user = new User();
          $user->email = $email;
          $user->name = $name;
          $user->mobile = $mobile;
          $user->password = $password;
          $user->user_type_id = $user_type_id;
          $user->user_status_id = $user_status_id;
          $user->save();
          $user_id = $user->user_id;
          $tenant_prefrences_id = $request['inputTenant'];
          $property_title = $request['property_title'];
          $property_desc = $request['property_desc'];
          $property_type = $request['property_type'];
          $prop_rent = $request['property_rent'];
          $prop_bed = $request['property_beds'];
          $prop_bath = $request['property_baths'];
          $prop_area = $request['property_area'];
          $property_age = $request['property_age'];
          $prop_furnish_status_id = $request['property_furnishing_status'];
          $property_furnishing_age = $request['property_furnishing_age'];
          $addressline1 = $request['addressline1'];
          $inputLocality = $request['inputLocality'];
          $inputCity = $request['inputCity'];
          $inputPincode = $request['inputPincode'];
          $inputState = $request['inputState'];
          $property_amenties = $request['property_amenties'];
          $inputLat = $request['inputLat'];
          $inputLng = $request['inputLng'];
          $tsSubmittedProperty = new TsSubmittedProperty();
          $prop_status_id = 0;
          $tsSubmittedProperty->prop_status_id = $prop_status_id;
          $tsSubmittedProperty->user_id = $user_id;
          $tsSubmittedProperty->tenant_prefrences_id = $tenant_prefrences_id;
          $tsSubmittedProperty->prop_title = $property_title;
          $tsSubmittedProperty->prop_desc = $property_desc;
          $tsSubmittedProperty->prop_type_id = $property_type;
          $tsSubmittedProperty->prop_rent = $prop_rent;
          $tsSubmittedProperty->prop_bed = $prop_bed;
          $tsSubmittedProperty->prop_bath = $prop_bath;
          $tsSubmittedProperty->prop_area = $prop_area;
          $tsSubmittedProperty->prop_age = $property_age;
          $tsSubmittedProperty->prop_furnish_status_id = $prop_furnish_status_id;
          $tsSubmittedProperty->prop_furniture_age = $property_furnishing_age;
          $tsSubmittedProperty->prop_city = $inputCity;
          $tsSubmittedProperty->prop_state = $inputState;
          $tsSubmittedProperty->prop_lat = $inputLat;
          $tsSubmittedProperty->prop_lng = $inputLng;
          $tsSubmittedProperty->prop_locality = $inputLocality;
          $tsSubmittedProperty->prop_pincode = $inputPincode;
          $tsSubmittedProperty->prop_address_line1 = $addressline1;

          if(!$property_amenties==0)
          {
              $tsSubmittedProperty->prop_amenty_id = $property_amenties;
          }
          else {
            $tsSubmittedProperty->prop_amenty_id = 7;
          }
          if($tsSubmittedProperty->save())
          {
            $tsSubmittedPropertyID = $tsSubmittedProperty->prop_id;
            $file = $request->file('add_photo_gallery');
            $filename =$tsSubmittedPropertyID.'.jpg';
            if($file)
            {
              Storage::disk('public_uploads')->put($filename, File::get($file));
            }
          return response()->json([
            "rc"=>"1",
            "rd"=>"Your Property Successfully Posted..."
          ]);

          }
        }
      }
      //Tag Property Manager

      public function tagToPropMgr(Request $request)
      {
        $email = $request['tagToPropMgrEmail'];
        $prop_id = $request['ownerPropertyID'];
        $prop_tagged_id = $request['PropTaggedID'];
        $user_type_id = 4;
        $tagged_prop_status_id = 1;
        $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_id)->first();
        if(!$emailCheck)
        {
          return response()->json([
            "rc"=>"2",
            "rd"=>"Property Manager does not exist"
          ]);
        }
        else {
          $user_id = $emailCheck->user_id;
          if($prop_tagged_id == 404)
          {
          $tstaggedCheck = TsTaggedProperty::where('user_id', $user_id)->first();
          if($tstaggedCheck)
          {
            return response()->json([
              "rc"=>"2",
              "rd"=>"Property Manager is already managing one property"
            ]);

          }else {
              $tstagg = new TsTaggedProperty();
              $tstagg->prop_id = $prop_id;
              $tstagg->user_id = $user_id;
              $tstagg->tagged_prop_status_id = $tagged_prop_status_id;
              if($tstagg->save())
              {
                return response()->json([
                  "rc"=>"1"
                ]);
              }
              else {
                return response()->json([
                  "rc"=>"3"
                ]);
              }
          }

          }
          else {
            $tstaggedCheck = TsTaggedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_tagged_id', $prop_tagged_id)->first();
            if($tstaggedCheck)
            {
              return response()->json([
                "rc"=>"2",
                "rd"=>"Property Manager is already managing this property"
              ]);
            }
            else {
              $tstaggedCheck = TsTaggedProperty::where('user_id', $user_id)->first();
              if($tstaggedCheck)
              {
                return response()->json([
                  "rc"=>"2",
                  "rd"=>"Property Manager is already managing one property"
                ]);

              }else {
                $tstagg = TsTaggedProperty::where('prop_tagged_id', $prop_tagged_id)->update(['user_id' => $user_id]);

                if($tstagg)
                {
                  return response()->json([
                    "rc"=>"1"
                  ]);
                }
                else {
                  return response()->json([
                    "rc"=>"3"
                  ]);
                }

              }

            }



          }



        }





      }

      // Tag Property Tenant
      public function tagToPropTen(Request $request)
      {
        $email = $request['tagToPropTenEmail'];
        $prop_id = $request['allPropertyID'];
        $rent = $request['tagToPropTenRent'];
        $user_type_id = 2;
        $tagged_prop_status_id = 1;
        $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_id)->first();
        if(!$emailCheck)
        {
          return response()->json([
            "rc"=>"2",
            "rd"=>"Tenant does not exist"
          ]);
        }
        else {
          $user_id = $emailCheck->user_id;
          $tstaggedCheck = TsTaggedProperty::where('user_id', $user_id)->first();
          if($tstaggedCheck)
          {
            $tenTaggedPropFind = $tstaggedCheck->prop_id;
            if($tenTaggedPropFind == $prop_id)
            {
              return response()->json([
                "rc"=>"2",
                "rd"=>"Tenant is already staying here"
              ]);
            }
            else {
              $prop_status_id = 1;
              $oneProperty = TsSubmittedProperty::where('prop_id', $tenTaggedPropFind)->where('prop_status_id', $prop_status_id)->first();
              if($oneProperty)
              {
                return response()->json([
                  "rc"=>"2",
                  "rd"=>"Tenant is already staying at ". $oneProperty->prop_title ." Located in ".$oneProperty->prop_locality
                ]);
              }
              else {

                  $tstagg = new TsTaggedProperty();
                  $tstagg->prop_id = $prop_id;
                  $tstagg->user_id = $user_id;
                  $tstagg->tagged_prop_status_id = $tagged_prop_status_id;
                  $tstagg->tenant_rent = $rent;
                  if($tstagg->save())
                  {
                    return response()->json([
                      "rc"=>"1"
                    ]);
                  }
                  else {
                    return response()->json([
                      "rc"=>"3"
                    ]);
                  }
              }

            }


          }else {
              $tstagg = new TsTaggedProperty();
              $tstagg->prop_id = $prop_id;
              $tstagg->user_id = $user_id;
              $tstagg->tagged_prop_status_id = $tagged_prop_status_id;
              $tstagg->tenant_rent = $rent;
              if($tstagg->save())
              {
                return response()->json([
                  "rc"=>"1"
                ]);
              }
              else {
                return response()->json([
                  "rc"=>"3"
                ]);
              }
          }

        }

      }



      //Save form
      public function submitNewFormOne(Request $request)
      {
        $email = $request['user_email'];
        $password = $request['user_password'];
        $user_type_id = $request['inputManager'];
        $password = bcrypt($password);
        $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_id)->first();
        if(!$emailCheck)
        {
          return response()->json([
            "rc"=>"2",
            "rd"=>"Email does not exists"
          ]);
        }
        else
         {
            $user_id = $emailCheck->user_id;
            $tenant_prefrences_id = $request['inputTenant'];
            $property_title = $request['property_title'];
            $property_desc = $request['property_desc'];
            $property_type = $request['property_type'];
            $prop_rent = $request['property_rent'];
            $prop_bed = $request['property_beds'];
            $prop_bath = $request['property_baths'];
            $prop_area = $request['property_area'];
            $property_age = $request['property_age'];
            $prop_furnish_status_id = $request['property_furnishing_status'];
            $property_furnishing_age = $request['property_furnishing_age'];
            $addressline1 = $request['addressline1'];
            $inputLocality = $request['inputLocality'];
            $inputCity = $request['inputCity'];
            $inputPincode = $request['inputPincode'];
            $inputState = $request['inputState'];
            $inputLat = $request['inputLat'];
            $inputLng = $request['inputLng'];
            $property_amenties = $request['property_amenties'];
            $tsSubmittedProperty = new TsSubmittedProperty();
            $prop_status_id = 0;
            $tsSubmittedProperty->prop_status_id = $prop_status_id;
            $tsSubmittedProperty->user_id = $user_id;
            $tsSubmittedProperty->tenant_prefrences_id = $tenant_prefrences_id;
            $tsSubmittedProperty->prop_title = $property_title;
            $tsSubmittedProperty->prop_desc = $property_desc;
            $tsSubmittedProperty->prop_type_id = $property_type;
            $tsSubmittedProperty->prop_rent = $prop_rent;
            $tsSubmittedProperty->prop_bed = $prop_bed;
            $tsSubmittedProperty->prop_bath = $prop_bath;
            $tsSubmittedProperty->prop_area = $prop_area;
            $tsSubmittedProperty->prop_age = $property_age;
            $tsSubmittedProperty->prop_furnish_status_id = $prop_furnish_status_id;
            $tsSubmittedProperty->prop_furniture_age = $property_furnishing_age;
            $tsSubmittedProperty->prop_city = $inputCity;
            $tsSubmittedProperty->prop_state = $inputState;
            $tsSubmittedProperty->prop_lat = $inputLat;
            $tsSubmittedProperty->prop_lng = $inputLng;
            $tsSubmittedProperty->prop_locality = $inputLocality;
            $tsSubmittedProperty->prop_pincode = $inputPincode;
            $tsSubmittedProperty->prop_address_line1 = $addressline1;

            if(!$property_amenties==0)
            {
                $tsSubmittedProperty->prop_amenty_id = $property_amenties;
            }
            else {
              $tsSubmittedProperty->prop_amenty_id = 7;
            }
            if($tsSubmittedProperty->save())
            {
              $tsSubmittedPropertyID = $tsSubmittedProperty->prop_id;
              $file = $request->file('add_photo_gallery');
              $filename =$tsSubmittedPropertyID.'.jpg';
              if($file)
              {
                Storage::disk('public_uploads')->put($filename, File::get($file));
              }
              return response()->json([
                "rc"=>"1",
                "rd"=>"Your Property Successfully Posted..."
              ]);

            }
          }
    }
    //Delete One tenat from Dashboard
    public function getDeleteOneTenant(Request $request)
    {
        $taggedID = $request['delID'];
        $tstaggedCheck = TsTaggedProperty::where('prop_tagged_id', $taggedID)->first();
        if($tstaggedCheck)
        {
          if($tstaggedCheck->delete())
          {
            return response()->json([
              "rc"=>"1"
            ]);
          }
          else {
            return response()->json([
              "rc"=>"2",
              "rd"=>"Unable to process now"
            ]);
          }
        }
        else {
          return response()->json([
            "rc"=>"3",
            "rd"=>"No records found for this tenat"
          ]);
        }

    }
    //Tenats Info
    public  function getAgentTenantInfo()
    {
      $tsTenantTagged = [];
      $tenantUserIDCount = 0;
      $prop_status_id = 1;
      $tagged_prop_status_id = 1;
      $taggedID = [];
      $tenantTaggedId = [];
      $tenantPropCountFlag = false;
      $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->get();
      $tsPropertiesCount = count($tsPropertiesSubmitted);
      if($tsPropertiesCount > 0)
      {
        $tsTenantTaggedCount = TsTaggedProperty::whereIn('prop_id', $tsPropertiesSubmitted)->where('tagged_prop_status_id', $tagged_prop_status_id)->count();
        if($tsTenantTaggedCount > 0)
        {
          $tsTenantTagged = TsTaggedProperty::whereIn('prop_id', $tsPropertiesSubmitted)->where('tagged_prop_status_id', $tagged_prop_status_id)->get();
          foreach ($tsTenantTagged as $key)
          {
             if($key->userFun->userTypeFun->user_type_id == 2)
             {
                 $tenantPropCountFlag =  true;
                 $tenantUserID[] = $key->user_id;
                 $taggedID[] = $key->prop_tagged_id;
             }
          }
          if($tenantPropCountFlag == true)
          {

            $tsTenantTagged = TsTaggedProperty::whereIn('prop_tagged_id', $taggedID)->where('tagged_prop_status_id', $tagged_prop_status_id)->get();

          }
        }
      }
    return view('alltenantsadmin',['admin'=>Auth::user(), 'tenantPropCountFlag'=>$tenantPropCountFlag, 'tenantTaggedId'=>$tsTenantTagged]);
  }
  //Get All agents
  public function getAgentInfo()
  {
    $user_type_id = 4;
    $user_status_id = 1;
    $agentCountFlag = false;
    $tsAgentsData = [];
    $tsAgentsCount = User::where('user_type_id', $user_type_id)->where('user_status_id', $user_status_id)->count();
    if($tsAgentsCount > 0)
    {
      $agentCountFlag = true;
      $tsAgentsData = User::where('user_type_id', $user_type_id)->where('user_status_id', $user_status_id)->get();

    }
    return view('totalagentsadmin',['admin'=>Auth::user(), 'agentCountFlag'=>$agentCountFlag, 'agentData'=>$tsAgentsData]);
  }
  // Update Edited Property
  public function updateEditedProperty(Request $request)
  {

    $prop_id = $request['propertyID'];
    $prop_status_id = 1;
    $tsSubmittedProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
    if(!$tsSubmittedProperty)
    {
      return response()->json([
              'rc'=>'3'
          ],200);
    }
    else {
      $propertyTitle = $request['propertyTitle'];
      $propertyDesc = $request['propertyDesc'];
      $inputTenant = $request['inputTenant'];
      $propertyType = $request['propertyType'];
      $propertyFurnishingStatus = $request['propertyFurnishingStatus'];
      $propertyFurnishingAge = $request['propertyFurnishingAge'];
      $propertyBeds = $request['propertyBeds'];
      $propertyBaths = $request['propertyBaths'];
      $propertyAge = $request['propertyAge'];
      $propertyArea = $request['propertyArea'];
      $propertyPrice = $request['propertyPrice'];
      $propertyAddressLine1 = $request['propertyAddressLine1'];
      $propertyLocation = $request['propertyLocation'];
      $propertyCity = $request['propertyCity'];
      $propertyPincode = $request['propertyPincode'];
      $propertyState = $request['propertyState'];
      $propertyAmenties = $request['propertyAmenties'];
      $inputLat = $request['inputLat'];
      $inputLng = $request['inputLng'];
      $propertyMORP = $request['propertyMORP'];
      $tsSubmittedProperty->prop_status_id = $prop_status_id;
      $tsSubmittedProperty->tenant_prefrences_id = $inputTenant;
      $tsSubmittedProperty->prop_title = $propertyTitle;
      $tsSubmittedProperty->prop_desc = $propertyDesc;
      $tsSubmittedProperty->prop_type_id = $propertyType;
      $tsSubmittedProperty->prop_rent = $propertyPrice;
      $tsSubmittedProperty->prop_bed = $propertyBeds;
      $tsSubmittedProperty->prop_bath = $propertyBaths;
      $tsSubmittedProperty->prop_area = $propertyArea;
      $tsSubmittedProperty->prop_age = $propertyAge;
      $tsSubmittedProperty->prop_furnish_status_id = $propertyFurnishingStatus;
      $tsSubmittedProperty->prop_furniture_age = $propertyFurnishingAge;
      $tsSubmittedProperty->prop_city = $propertyCity;
      $tsSubmittedProperty->prop_state = $propertyState;
      $tsSubmittedProperty->prop_pincode = $propertyPincode;
      $tsSubmittedProperty->prop_address_line1 = $propertyAddressLine1;
      $tsSubmittedProperty->prop_locality = $propertyLocation;
      $tsSubmittedProperty->prop_lat = $inputLat;
      $tsSubmittedProperty->prop_lng = $inputLng;
      $tsSubmittedProperty->prop_morp = $propertyMORP;
      if(!$propertyAmenties==0)
      {
          $tsSubmittedProperty->prop_amenty_id = $propertyAmenties;
      }
      else {
        $tsSubmittedProperty->prop_amenty_id = 7;
      }

      if($tsSubmittedProperty->update())
      {
        $tsEditedCheck = TsEditedSubmittedProperty::where('prop_id', $prop_id)->first();
        if($tsEditedCheck)
        {
         $tsEditedCheck->delete();
        }
        $file = $request->file('propertyPic');
        $filename =$prop_id.'.jpg';

        if($file)
        {
          if(Storage::disk('public_uploads')->has($prop_id.'_tmp.jpg'))
          {
            Storage::disk('public_uploads')->delete($prop_id.'_tmp.jpg');
          }
          Storage::disk('public_uploads')->put($filename, File::get($file));
        }

        if(Storage::disk('public_uploads')->has($prop_id.'_tmp.jpg'))
        {
          if(Storage::disk('public_uploads')->has($prop_id.'.jpg'))
          {
          Storage::disk('public_uploads')->delete($prop_id.'.jpg');
          }
          Storage::disk('public_uploads')->move($prop_id.'_tmp.jpg', $prop_id.'.jpg');
        }

        return response()->json([
                'rc'=>'1',
                "rd"=>"Property Successfully Updated."
            ],200);
      }
      else {
        return response()->json([
                'rc'=>'2',
                "rd"=>"Something went wrong."
            ],200);
      }

    }
  }
  //Get Password view
  public function getPwdView()
  {
  return view('adminchangepwd',['admin'=>Auth::user()]);
  }

  //Get Inventory view, with the property having no inventory
  public function getPropWithoutInventory()
  {

    try
      {
      //Global variables
      $prop_status_v = $this->prop_status_v;
      $invnt_level_status_p = $this->invnt_level_status_p;
      $invnt_level_status_v = $this->invnt_level_status_v;
      $invnt_level_status_a = $this->invnt_level_status_a;
      $prop_invnt_status_c = $this->prop_invnt_status_c;
      $prop_invnt_status_a = $this->prop_invnt_status_a;
      //Get data for tabs
      $active_prop_count =[];
      $all_invnt = [];
      $all_invnt_count = 0;
      $active_invnt_count = 0;
      $inactive_invnt_count = 0;
      //Get all inventory
      $active_prop_count = DB::table('ts_submitted_properties')
                            ->select('prop_id')
                            ->where('prop_status_id', '=', $prop_status_v)
                            ->whereRaw("ts_submitted_properties.prop_id IN (Select prop_id from ts_prop_invnt_levels where invnt_level_status_id = '$invnt_level_status_a' and morp > 0)")
                            ->get();

      if(count($active_prop_count) > 0)
      {
        //Get all inventory
        $all_prop_ids = [];
        foreach ($active_prop_count as $key => $value) {
          $all_prop_ids[] = $value->prop_id;
        }

        $all_invnt = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                              ->whereIn('invnt_status_id',[$prop_invnt_status_c,$prop_invnt_status_a])
                              ->get();
        //Get all inventory count
        $all_invnt_count = count($all_invnt);

        //Get all occupied or active inventory
        $active_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                              ->where('invnt_status_id',$prop_invnt_status_a)
                              ->where('user_id','!=',0)
                              ->count();
        //Get all unoccupied or inactive inventory
        $inactive_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                              ->where('invnt_status_id',$prop_invnt_status_c)
                              ->where('user_id','=',0)
                              ->count();

      }

      $props_with_no_invnt =[];
      //Get property having no inventory
      $props_with_no_invnt = DB::table('ts_submitted_properties')
                            ->where('prop_status_id', '=', $prop_status_v)
                            ->whereRaw("ts_submitted_properties.prop_id NOT IN (Select prop_id from ts_prop_invnt_levels where invnt_level_status_id = '$invnt_level_status_p' or invnt_level_status_id = '$invnt_level_status_a' and morp > 0)")
                            ->get();
      $count_flag = false;
      if(count($props_with_no_invnt) > 0)
      {
        $count_flag = true;
      }

      return view('admin_prop_invnt',['admin'=>Auth::user(),
      'count_flag'=>$count_flag,'props_with_no_invnt'=>$props_with_no_invnt,
      'active_prop_count' => count($active_prop_count),
      'all_invnt_count'=>$all_invnt_count,
      'all_invnt'=> $all_invnt,
      'active_invnt_count' => $active_invnt_count,
      'inactive_invnt_count' => $inactive_invnt_count]);


      }
      catch(\Exception $e)
      {
        DB::rollback();
        echo $e->getMessage();
      }
  }
//This method will give the details of property which is verified and inventory needs to be created
public function getDetailsProWoInvnt(Request $request)
{

   //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_v = $this->invnt_level_status_v;

  $prop_id = $request['prop_id'];
  $prop_count_flag = false;
  $invnt_data_flag = false;
  $invnt_data = [];
  if(!isset($prop_id) && empty($prop_id))
  {

    return response()->json([
      'rc'=>'2',
      "rd"=>"Something went wrong."
  ],200);

  }
  else
  {

    //Get property details having no inventory
    $prop_wo_invnt = TsSubmittedProperty::where('prop_id',$prop_id)
                        ->where('prop_status_id', $prop_status_v)
                        ->first();
    if($prop_wo_invnt)
    {
      //Set this property id to session, it will be retirved while creating inventory
     $request->session()->put('sess_prop_id', $prop_id);

      $ts_invent_levels = TsPropInvntLevel::where('prop_id',$prop_id)->where('invnt_level_status_id', $invnt_level_status_v)->get();
      if(count($ts_invent_levels) > 0)
      {

        $invnt_data_flag = true;
        $invnt_data = [];
        foreach ($ts_invent_levels as $key => $value) {

          $invnt_data[] = array(
            'category' => $value->msPropLevelFun->prop_invnt_level,
            'exp_rent' => $value['exp_rent'],
            'exp_deposit' => $value['exp_deposit'],
            'morp' => $value['morp'],
            'level_id' => $value['prop_invnt_level_id']
          );

        }
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
      }

      $prop_count_flag = true;
      //Listed by Details
      $listed_by_name = $prop_wo_invnt->msPropertyUserFun->name;
      $listed_by_mobile = $prop_wo_invnt->msPropertyUserFun->mobile;
      //Property Features
      $prop_type = $prop_wo_invnt->msPropTypeFun->prop_type;
      $prop_furnish = $prop_wo_invnt->furnishFUn->prop_furnish_status;
      $prop_bhk_type = $prop_wo_invnt->msPropBhkFun->prop_bhk;
      //Property location details
      $prop_locality = $prop_wo_invnt->prop_locality;
      $prop_city = $prop_wo_invnt->prop_city;

      $prop_details = array('listed_by_name'=>$listed_by_name,
                                'listed_by_mobile'=>$listed_by_mobile,
                                'prop_type'=>$prop_type,
                                'prop_furnish'=>$prop_furnish,
                                'prop_bhk_type'=>$prop_bhk_type,
                                'prop_locality'=>$prop_locality,
                                'prop_city'=>$prop_city,
                                'invnt_data_flag' => $invnt_data_flag,
                                'invnt_data' => $invnt_data);


      $rd = array('prop_count_flag'=>$prop_count_flag,'prop_details'=>$prop_details);
      return response()->json([
        'rc'=>'1',
        "rd"=>$rd
    ],200);

    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }

  }

}
//Validate inventory level
public function getInvntLevelValid(Request $request)
{
  try
  {
     //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_v = $this->invnt_level_status_v;
    //Begin Transaction
  DB::beginTransaction();
  $invnt_level_id = $request['id'];
  $prop_id_tmp = $request['prop_id'];
  $prop_id_valid_flag = false;
  //Validation
  if(!isset($invnt_level_id) && empty($invnt_level_id))
  {

    return response()->json([
      'rc'=>'2',
      "rd"=>"Something went wrong."
  ],200);

  }
  else
  {

    if ($request->session()->has('sess_prop_id'))
    {
      $prop_id = session('sess_prop_id');
      if($prop_id_tmp == $prop_id)
      {
        $prop_id_valid_flag = true;
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
      }

    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }
  }
  //Do the execution
  if($prop_id_valid_flag == true)
  {
    $invnt_data_flag = false;
    $prop_data_flag = false;
    //Get property details having no inventory
    $prop_wo_invnt = TsSubmittedProperty::where('prop_id',$prop_id)
                        ->where('prop_status_id', $prop_status_v)
                        ->first();
    $ts_invent_level = TsPropInvntLevel::where('prop_id',$prop_id)
                        ->where('prop_invnt_level_id', $invnt_level_id)
                        ->where('invnt_level_status_id', $invnt_level_status_v)
                        ->first();
      if($ts_invent_level && $prop_wo_invnt)
      {
        //Set this inventory level id to session, it will be retirved while creating inventory
        $request->session()->put('sess_p_invnt_level_id', $invnt_level_id);
        $invnt_data_flag = true;
        //Get City
         $prop_city = $prop_wo_invnt->prop_city;
        //Get name of Property
         $prop_full_name = $prop_wo_invnt->prop_title;
         //Format property Name
         $words = preg_split("/[\s,_-]+/", $prop_full_name);
         $acronym = "";
          foreach ($words as $w) {
            $acronym .= $w[0];
          }
          //Property accronym
          $prop_name = strtoupper($acronym);
        //Property type
        $prop_full_type = $prop_wo_invnt->msPropTypeFun->prop_type;
        //Property type acronym
        $prop_type = $prop_full_type[0];
        //Get BHK
        $prop_bhk = $prop_wo_invnt->msPropBhkFun->bhk_value;
        //Get BHK name
        $prop_bhk_name = $prop_wo_invnt->msPropBhkFun->prop_bhk;
        //Get BHK type
        $prop_room = $prop_wo_invnt->msPropBhkFun->room;
        //Get bed, by default 2 bed per room
        $prop_bed = 2;
        //Inventory breakdown level
        $prop_invnt_level = $ts_invent_level->msPropLevelFun->level_value;

        //Create empty array of invenotry
        $prop_inventories = [];
        $prop_invnt_flag = false;
        //Create inventory format
        if($prop_invnt_level == 1)
        {
          $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk;
          $prop_invnt_flag = true;

        }
        else if($prop_invnt_level == 2)
        {
          for($i = 1; $i <= $prop_room; $i++)
          {

            $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk."_".$i;

          }

          $prop_invnt_flag = true;
        }
        else if($prop_invnt_level == 3)
        {
          for($i = 1; $i <= $prop_bhk; $i++)
          {
            for($j = 1; $j <= $prop_bed; $j++)
            {

            $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk."_".$i."_".$j;

            }

          }
          $prop_invnt_flag = true;
        }
        else
        {
          $prop_invnt_flag = false;
        }
        //Get the inventories
        if($prop_invnt_flag)
        {
          $prop_data_flag = true;
          $prop_details = array('prop_name' => $prop_full_name,
                          'prop_city' => $prop_city,
                          'prop_type' => $prop_full_type,
                          'prop_bhk' => $prop_bhk_name,
                          'prop_invnt_flag' => $prop_invnt_flag,
                          'prop_invnt_details'=> $prop_inventories
                        );

          $rd = array('prop_data_flag'=>$prop_data_flag,'prop_details'=>$prop_details);

          return response()->json([
            'rc'=>'1',
            "rd"=>$rd
        ],200);

        }
        else
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);
        }

      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
      }

  }

  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}

//Create new inventory
public function postCreateNewInventory(Request $request)
{
 // return $request['prop_invnt_ids_review'];
  try
  {

  //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_v = $this->invnt_level_status_v;
  $invnt_level_status_a = $this->invnt_level_status_a;
  //Begin Transaction
  DB::beginTransaction();
  $invnt_level_id = $request['id'];
  $prop_id_tmp = $request['prop_id'];
  $form_invnt_ids = $request['prop_invnt_ids_review'];
  $prop_id_valid_flag = false;
  //Validation
  if(!isset($invnt_level_id) or empty($invnt_level_id) or  !isset($form_invnt_ids) or empty($form_invnt_ids) or !is_array($form_invnt_ids))
  {

    return response()->json([
      'rc'=>'2',
      "rd"=>"Something went wrong."
  ],200);

  }
  else
  {

    if ($request->session()->has('sess_prop_id') && $request->session()->has('sess_p_invnt_level_id'))
    {
      $prop_id = session('sess_prop_id');
      $invnt_level_id = session('sess_p_invnt_level_id');
      if(($prop_id_tmp == $prop_id) && ($invnt_level_id == $invnt_level_id))
      {
        $prop_id_valid_flag = true;
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
      }

    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }
  }
  //Do the execution
  if($prop_id_valid_flag == true)
  {
    $invnt_data_flag = false;
    //Get property details having no inventory
    $prop_wo_invnt = TsSubmittedProperty::where('prop_id',$prop_id)
                        ->where('prop_status_id', $prop_status_v)
                        ->first();
    $ts_invent_level = TsPropInvntLevel::where('prop_id',$prop_id)
                        ->where('prop_invnt_level_id', $invnt_level_id)
                        ->where('invnt_level_status_id', $invnt_level_status_v)
                        ->first();
      if($ts_invent_level && $prop_wo_invnt)
      {

        $invnt_data_flag = true;
        //Get City
         $prop_city = $prop_wo_invnt->prop_city;
        //Get name of Property
         $prop_full_name = $prop_wo_invnt->prop_title;
         //Format property Name
         $words = preg_split("/[\s,_-]+/", $prop_full_name);
         $acronym = "";
          foreach ($words as $w) {
            $acronym .= $w[0];
          }
          //Property accronym
          $prop_name = strtoupper($acronym);
        //Property type
        $prop_full_type = $prop_wo_invnt->msPropTypeFun->prop_type;
        //Property type acronym
        $prop_type = $prop_full_type[0];
        //Get BHK
        $prop_bhk = $prop_wo_invnt->msPropBhkFun->bhk_value;
        //Get BHK name
        $prop_bhk_name = $prop_wo_invnt->msPropBhkFun->prop_bhk;
        //Get BHK type
        $prop_room = $prop_wo_invnt->msPropBhkFun->room;
        //Get bed, by default 2 bed per room
        $prop_bed = 2;
        //Inventory breakdown level
        $prop_invnt_level = $ts_invent_level->msPropLevelFun->level_value;

        //Create empty array of invenotry
        $prop_inventories = [];
        $prop_invnt_flag = false;
        //Create inventory format
        if($prop_invnt_level == 1)
        {
          $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk;
          $prop_invnt_flag = true;

        }
        else if($prop_invnt_level == 2)
        {
          for($i = 1; $i <= $prop_room; $i++)
          {

            $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk."_".$i;

          }

          $prop_invnt_flag = true;
        }
        else if($prop_invnt_level == 3)
        {
          for($i = 1; $i <= $prop_bhk; $i++)
          {
            for($j = 1; $j <= $prop_bed; $j++)
            {

            $prop_inventories[] = $prop_name."_".$prop_type."_".$prop_bhk."_".$i."_".$j;

            }

          }
          $prop_invnt_flag = true;
        }
        else
        {
          $prop_invnt_flag = false;
        }
        //Get the inventories
        if($prop_invnt_flag && (count($prop_inventories) == count($form_invnt_ids)))
        {

          //Format data for new inventory array
          $formatted_data = array();
          foreach ($form_invnt_ids as $key => $value) {

            $formatted_data[] = array(
             "prop_id" => $prop_id,
             'fomatted_invnt_id' => $value,
             "user_id" => 0,
             "rent" => 0,
             "maint_charge" => 0,
             "rent_pay_date" => 0,
             "ts_prop_invnt_level_id" => $ts_invent_level->ts_prop_invnt_level_id,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
           );

           }
           //Insert here
           $rental_data_insert = DB::table('ts_prop_inventories')->insert($formatted_data);
           if($rental_data_insert)
           {
            //Update the selected inventory level in ts inventory level table
            $ts_invent_level->invnt_level_status_id = $invnt_level_status_a;
            if($ts_invent_level->update())
            {
              //Final commit
              DB::commit();
              return response()->json([
                'rc'=>'1',
                "rd"=>"Inventory added !"
            ],200);
            }
            else
            {
              return response()->json([
                'rc'=>'2',
                "rd"=>"Something went wrong."
            ],200);
            }

           }

        }
        else
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);
        }

      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
      }

  }

  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }
}
//Get ALl inventory
public function getAllInventory()
{

  try
  {
  //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_p = $this->invnt_level_status_p;
  $invnt_level_status_v = $this->invnt_level_status_v;
  $invnt_level_status_a = $this->invnt_level_status_a;
  $prop_invnt_status_c = $this->prop_invnt_status_c;
  $prop_invnt_status_a = $this->prop_invnt_status_a;

  $active_prop_count =[];
  $all_invnt = [];
  $all_invnt_count = 0;
  $active_invnt_count = 0;
  $inactive_invnt_count = 0;
  //Get all inventory
  $active_prop_count = DB::table('ts_submitted_properties')
                        ->select('prop_id')
                        ->where('prop_status_id', '=', $prop_status_v)
                        ->whereRaw("ts_submitted_properties.prop_id IN (Select prop_id from ts_prop_invnt_levels where invnt_level_status_id = '$invnt_level_status_a' and morp > 0)")
                        ->get();

  if(count($active_prop_count) > 0)
  {
    //Get all inventory
    $all_prop_ids = [];
    foreach ($active_prop_count as $key => $value) {
      $all_prop_ids[] = $value->prop_id;
    }

    $all_invnt = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->whereIn('invnt_status_id',[$prop_invnt_status_c,$prop_invnt_status_a])
                          ->get();
    //Get all inventory count
    $all_invnt_count = count($all_invnt);

    //Get all occupied or active inventory
    $active_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_a)
                          ->where('user_id','!=',0)
                          ->count();
    //Get all unoccupied or inactive inventory
    $inactive_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_c)
                          ->where('user_id','=',0)
                          ->count();

  }

  return view('admin_all_invnt', ['admin'=>Auth::user(),
  'active_prop_count' => count($active_prop_count),
  'all_invnt_count'=>$all_invnt_count,
  'all_invnt'=> $all_invnt,
  'active_invnt_count' => $active_invnt_count,
  'inactive_invnt_count' => $inactive_invnt_count]);


  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}
//Get ALl occupied inventory
public function getAllOccInventory()
{

  try
  {
  //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_p = $this->invnt_level_status_p;
  $invnt_level_status_v = $this->invnt_level_status_v;
  $invnt_level_status_a = $this->invnt_level_status_a;
  $prop_invnt_status_c = $this->prop_invnt_status_c;
  $prop_invnt_status_a = $this->prop_invnt_status_a;

  $active_prop_count =[];
  $all_active_invnt = [];
  $all_invnt_count = 0;
  $active_invnt_count = 0;
  $inactive_invnt_count = 0;
  //Get all inventory
  $active_prop_count = DB::table('ts_submitted_properties')
                        ->select('prop_id')
                        ->where('prop_status_id', '=', $prop_status_v)
                        ->whereRaw("ts_submitted_properties.prop_id IN (Select prop_id from ts_prop_invnt_levels where invnt_level_status_id = '$invnt_level_status_a' and morp > 0)")
                        ->get();

  if(count($active_prop_count) > 0)
  {
    //Get all active prop_id
    $all_prop_ids = [];
    foreach ($active_prop_count as $key => $value) {
      $all_prop_ids[] = $value->prop_id;
    }
     //Get all inventory count
    $all_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->whereIn('invnt_status_id',[$prop_invnt_status_c,$prop_invnt_status_a])
                          ->count();

    //Get all occupied or active inventory
    $all_active_invnt = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_a)
                          ->where('user_id','!=',0)
                          ->get();
    //Get occopied inventory count
    $active_invnt_count = count($all_active_invnt);

    //Get all unoccupied or inactive inventory
    $inactive_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_c)
                          ->where('user_id','=',0)
                          ->count();

  }

  return view('admin_occ_invnt', ['admin'=>Auth::user(),
  'active_prop_count' => count($active_prop_count),
  'all_invnt_count'=>$all_invnt_count,
  'all_active_invnt'=> $all_active_invnt,
  'active_invnt_count' => $active_invnt_count,
  'inactive_invnt_count' => $inactive_invnt_count]);


  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}
//Get ALl unoccupied inventory
public function getAllUnOccInventory()
{

  try
  {
  //Global variables
  $prop_status_v = $this->prop_status_v;
  $invnt_level_status_p = $this->invnt_level_status_p;
  $invnt_level_status_v = $this->invnt_level_status_v;
  $invnt_level_status_a = $this->invnt_level_status_a;
  $prop_invnt_status_c = $this->prop_invnt_status_c;
  $prop_invnt_status_a = $this->prop_invnt_status_a;

  $active_prop_count =[];
  $all_inactive_invnt = [];
  $all_invnt_count = 0;
  $active_invnt_count = 0;
  $inactive_invnt_count = 0;
  //Get all inventory
  $active_prop_count = DB::table('ts_submitted_properties')
                        ->select('prop_id')
                        ->where('prop_status_id', '=', $prop_status_v)
                        ->whereRaw("ts_submitted_properties.prop_id IN (Select prop_id from ts_prop_invnt_levels where invnt_level_status_id = '$invnt_level_status_a' and morp > 0)")
                        ->get();

  if(count($active_prop_count) > 0)
  {
    //Get all active prop_id
    $all_prop_ids = [];
    foreach ($active_prop_count as $key => $value) {
      $all_prop_ids[] = $value->prop_id;
    }
     //Get all inventory count
    $all_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->whereIn('invnt_status_id',[$prop_invnt_status_c,$prop_invnt_status_a])
                          ->count();

    //Get all occupied or active inventory
    $active_invnt_count = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_a)
                          ->where('user_id','!=',0)
                          ->count();

    //Get all unoccupied or inactive inventory
    $all_inactive_invnt = TsPropInventory::whereIn('prop_id', $all_prop_ids)
                          ->where('invnt_status_id',$prop_invnt_status_c)
                          ->where('user_id','=',0)
                          ->get();
     //Get unoccopied inventory count
     $inactive_invnt_count = count($all_inactive_invnt);

  }

  return view('admin_unocc_invnt', ['admin'=>Auth::user(),
  'active_prop_count' => count($active_prop_count),
  'all_invnt_count'=>$all_invnt_count,
  'all_inactive_invnt'=> $all_inactive_invnt,
  'active_invnt_count' => $active_invnt_count,
  'inactive_invnt_count' => $inactive_invnt_count]);


  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}
public function getOnePropInvntDetails($prop_id, $invnt_id, Request $request)
{
  try
  {
    $prop_id = Crypt::decrypt($prop_id);

    if (!filter_var($prop_id, FILTER_VALIDATE_INT))
    {
      return redirect()->route('admin.inventory.review.all');
    }
    if (!filter_var($invnt_id, FILTER_VALIDATE_INT))
    {
      return redirect()->route('admin.inventory.review.all');
    }
    $valid_prop_flag = false;
    //Active Property check
    $active_prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                          ->where('prop_status_id', $this->prop_status_v)
                          ->first();
    //Inventory exists or not check
    $assigned_invnt_check = TsPropInvntLevel::where('prop_id', $prop_id)
                          ->where('invnt_level_status_id', $this->invnt_level_status_a)
                          ->where('morp','>', 0)
                          ->first();

    if($active_prop_check && $assigned_invnt_check)
    {
      $valid_prop_flag = true;
    }
    if($valid_prop_flag)
    {
       //Get all inventory
      $invnt_check = TsPropInventory::where('prop_id', $prop_id)
                            ->where('ts_prop_invnt_id',$invnt_id)
                            ->whereIn('invnt_status_id',[$this->prop_invnt_status_c,$this->prop_invnt_status_a])
                            ->first();
      if($invnt_check)
      {
        //This property owner's tenant account
        $owner_id = $active_prop_check->user_id;
        $owner_ten_id = 0;
        if(isset($active_prop_check->userFun))
        {
          $owner_mobile = $active_prop_check->userFun->mobile;
          $owner_email = $active_prop_check->userFun->email;
          $owner_ten_profile = User::where('email', $owner_email)
                                    ->where('mobile', $owner_mobile)
                                    ->where('user_type_id', $this->user_type_ten)
                                    ->where('user_status_id',$this->user_status_v)->first();
          if($owner_ten_profile)
          {
            $owner_ten_id = $owner_ten_profile->user_id;
          }
        }
    
        //All  Tenants
        $tenant_list = User::where('user_type_id', $this->user_type_ten)
                              ->where('user_status_id',$this->user_status_v)
                              ->where('user_id', '!=',$owner_ten_id)->get();
        //Check all assigned tenants excluding this property, because same tenants can be assigned
        $assigned_ten_check = TsPropInventory::where('prop_id', '!=', $prop_id)
                              ->select('user_id')
                              ->where('invnt_status_id',$this->prop_invnt_status_a)
                              ->where('rent', '!=',0)
                              ->where('user_id', '!=',0)->get();
        if(count($assigned_ten_check) > 0 )
        {
          //If exists then filter those tenants
          $tenant_list = User::where('user_type_id', $this->user_type_ten)
                              ->where('user_status_id',$this->user_status_v)
                              ->whereNotIn('user_id', $assigned_ten_check)->get();
        }

        if($invnt_check->invnt_status_id == 2 && $invnt_check->user_id != 0)
        {
        //Set the user id of this inventory which will be retirived while updating renatl details
        $request->session()->put('invnt_tenant_uid', $invnt_check->user_id);

        }
        //Set the Prop_id for later retrive
        $request->session()->put('modi_ten_pid', $prop_id);
        $request->session()->put('modi_ten_iid', $invnt_id);
        return view('admin_one_invnt_details', ['admin'=>Auth::user(),
        'active_prop' => $active_prop_check,
        'invnt_check' => $invnt_check,
        'tenant_list' => $tenant_list
        ]);
      }
      else
      {
        return redirect()->route('admin.inventory.review.all');

      }

    }
    else
    {
      return redirect()->route('admin.inventory.review.all');

    }
  }
  catch (DecryptException $e)
  {
    return redirect()->route('admin.inventory.review.all');
  }

}
//Get one tenant info before assigning tenant
public function getOneTenantInfo(Request $request)
{
  $user_type_ten = $this->user_type_ten;
  $user_status_v = $this->user_status_v;
  $prop_invnt_status_a = $this->prop_invnt_status_a;
  $user_id = $request['id'];
  $user_data = User::where('user_id', $user_id)->where('user_type_id', $user_type_ten)->where('user_status_id',$user_status_v)->first();
  if(!$user_data)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "User is not registered !"
    ]);
  }
  else {

    if ($request->session()->has('modi_ten_pid'))
    {
      $prop_id = session('modi_ten_pid');
      $assigned_ten_check = TsPropInventory::where('prop_id', '!=', $prop_id)
                                          ->where('invnt_status_id',$prop_invnt_status_a)
                                          ->where('rent', '!=',0)
                                          ->where('user_id', $user_id)->first();
        if(!$assigned_ten_check)
        {
          //Set this user id to session, it will be retirved while assigning inventory
          $request->session()->put('assign_tenant_id', $user_id);
          return response()->json([
          "rc"=>"1",
          "rd" => $user_data
          ]);
        }
        else
        {
          return response()->json([
            "rc"=>"2",
            "rd" => "Something went wrong !"
          ]);
        }

    }
    else
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }

  }


}
//Assign Tenant
public function postAssignTenant(Request $request)
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
   //Global variables
   $prop_status_v = $this->prop_status_v;
   $invnt_level_status_p = $this->invnt_level_status_p;
   $invnt_level_status_v = $this->invnt_level_status_v;
   $invnt_level_status_a = $this->invnt_level_status_a;
   $prop_invnt_status_c = $this->prop_invnt_status_c;
   $prop_invnt_status_a = $this->prop_invnt_status_a;
   $user_type_ten = $this->user_type_ten;
   $tenant_status_a = $this->tenant_status_a;
   $user_status_v = $this->user_status_v;
  $invnt_rent = $request['invnt_rent'];
  $invnt_maint_charge = $request['invnt_maint_charge'];
  $rent_pay_date = $request['rent_pay_date'];
  $selected_user_id = $request['selected_uid'];
  $p_summary_id = $request['p_summary_id'];
  $invnt_s_id = $request['invnt_s_id'];
  $p_t_id = $request['p_t_id'];
  $invnt_t_id = $request['invnt_t_id'];

  //Flags
  $valid_prop_flag = false;
  $user_id_valid_flag = false;
  $db_execution_flag = false;
  if(($p_summary_id != $p_t_id) or ($invnt_s_id != $invnt_t_id))
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Something went wrong !"
    ]);
  }

  if ($request->session()->has('assign_tenant_id'))
  {
    $user_id = session('assign_tenant_id');
    if($user_id == $selected_user_id)
    {
      $user_id_valid_flag = true;
    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }
  }
  if($user_id_valid_flag)
  {
    $user_data = User::where('user_id', $selected_user_id)->where('user_type_id', $user_type_ten)->where('user_status_id',$user_status_v)->first();
    if(!$user_data)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "User is not registered !"
      ]);
    }
    else
    {
    //Validate if this user is not tagged to another property
    if ($request->session()->has('modi_ten_pid'))
    {
      $prop_id = session('modi_ten_pid');
      $assigned_ten_check = TsPropInventory::where('prop_id', '!=', $prop_id)
                                          ->where('invnt_status_id',$prop_invnt_status_a)
                                          ->where('rent', '!=',0)
                                          ->where('user_id', $selected_user_id)->first();
        if($assigned_ten_check)
        {
          return response()->json([
            "rc"=>"2",
            "rd" => "Something went wrong !"
          ]);
        }
    }
    else
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
      $prop_id = $p_summary_id;
      $invnt_id = $invnt_s_id;
       //Active Property check
    $active_prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                          ->where('prop_status_id', $prop_status_v)
                          ->first();
    //Inventory exists or not check
    $assigned_invnt_check = TsPropInvntLevel::where('prop_id', $prop_id)
                          ->where('invnt_level_status_id', $invnt_level_status_a)
                          ->where('morp','>', 0)
                          ->first();
    if($active_prop_check && $assigned_invnt_check)
    {
      $valid_prop_flag = true;
    }
    if($valid_prop_flag)
    {

    //Get all unoccupied or inactive inventory
    $this_inactive_invnt = TsPropInventory::where('prop_id', $prop_id)
                          ->where('ts_prop_invnt_level_id',$assigned_invnt_check->ts_prop_invnt_level_id)
                          ->where('ts_prop_invnt_id',$invnt_id)
                          ->where('invnt_status_id',$prop_invnt_status_c)
                          ->where('user_id','=',0)
                          ->first();

      if($this_inactive_invnt)
      {
        $this_inactive_invnt->user_id = $user_data->user_id;
        $this_inactive_invnt->rent = $invnt_rent;
        $this_inactive_invnt->maint_charge = $invnt_maint_charge;
        $this_inactive_invnt->rent_pay_date = $rent_pay_date;
        $this_inactive_invnt->invnt_status_id = $prop_invnt_status_a;
        if($this_inactive_invnt->update())
        {

          $tagged_tenant_check = TsTaggedTenant::where('ts_prop_invnt_id', $invnt_id)
                                                ->where('tagged_tenant_status_id',$tenant_status_a)
                                                ->first();

          if(!$tagged_tenant_check)
          {
            $tag_tenant = new TsTaggedTenant();
            $tag_tenant->user_id = $user_data->user_id;
            $tag_tenant->prop_id = $prop_id;
            $tag_tenant->ts_prop_invnt_id = $invnt_id;
            $tag_tenant->start_date = Carbon::now();
            $tag_tenant->tagged_tenant_status_id = $tenant_status_a;
            if($tag_tenant->save())
            {
               //Final commit
               DB::commit();
               return response()->json([
                 'rc'=>'1',
                 "rd"=>"Member assigned !"
             ],200);
            }
          }
          else
          {
            return response()->json([
              'rc'=>'2',
              "rd"=>"Something went wrong."
          ],200);
          }
        }
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
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

//Update renatl details of a tenant
public function updateRentInfoTenant(Request $request)
{

  try
  {
  //Begin Transaction
  DB::beginTransaction();
   //Global variables
   $prop_status_v = $this->prop_status_v;
   $invnt_level_status_p = $this->invnt_level_status_p;
   $invnt_level_status_v = $this->invnt_level_status_v;
   $invnt_level_status_a = $this->invnt_level_status_a;
   $prop_invnt_status_c = $this->prop_invnt_status_c;
   $prop_invnt_status_a = $this->prop_invnt_status_a;
   $user_type_ten = $this->user_type_ten;
   $tenant_status_a = $this->tenant_status_a;
   $user_status_v = $this->user_status_v;
  $invnt_rent = $request['edit_invnt_rent'];
  $invnt_maint_charge = $request['edit_maint_charge'];
  $rent_pay_date = $request['edi_rent_pay_date'];
  $selected_user_id = $request['rentfuid'];
  $p_summary_id = $request['p_summary_id'];
  $invnt_s_id = $request['invnt_s_id'];
  $p_t_id = $request['e_p_t_id'];
  $invnt_t_id = $request['e_invnt_t_id'];

  //Flags
  $valid_prop_flag = false;
  $user_id_valid_flag = false;
  $db_execution_flag = false;

  if(($p_summary_id != $p_t_id) or ($invnt_s_id != $invnt_t_id))
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Something went wrong !"
    ]);
  }
  if ($request->session()->has('invnt_tenant_uid'))
  {
    $user_id = session('invnt_tenant_uid');
    if($user_id == $selected_user_id)
    {
      $user_id_valid_flag = true;
    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }
  }
  if($user_id_valid_flag)
  {
    $user_data = User::where('user_id', $selected_user_id)->where('user_type_id', $user_type_ten)->where('user_status_id',$user_status_v)->first();
    if(!$user_data)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "User is not registered !"
      ]);
    }
    else
    {
      $prop_id = $p_summary_id;
      $invnt_id = $invnt_s_id;
      $user_id = $selected_user_id;

    //Active Property check
    $active_prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                          ->where('prop_status_id', $prop_status_v)
                          ->first();
    //Inventory exists or not check
    $assigned_invnt_check = TsPropInvntLevel::where('prop_id', $prop_id)
                          ->where('invnt_level_status_id', $invnt_level_status_a)
                          ->where('morp','>', 0)
                          ->first();
    if($active_prop_check && $assigned_invnt_check)
    {
      $valid_prop_flag = true;
    }
    if($valid_prop_flag)
    {

    //Get all unoccupied or inactive inventory
    $this_active_invnt = TsPropInventory::where('prop_id', $prop_id)
                          ->where('ts_prop_invnt_level_id',$assigned_invnt_check->ts_prop_invnt_level_id)
                          ->where('ts_prop_invnt_id',$invnt_id)
                          ->where('invnt_status_id',$prop_invnt_status_a)
                          ->where('user_id','=',$user_id)
                          ->first();

      if($this_active_invnt)
      {

        $this_active_invnt->rent = $invnt_rent;
        $this_active_invnt->maint_charge = $invnt_maint_charge;
        $this_active_invnt->rent_pay_date = $rent_pay_date;
        if($this_active_invnt->update())
        {
            //Final commit
            DB::commit();
            return response()->json([
              'rc'=>'1',
              "rd"=>"Rentals updated !"
          ],200);

        }
        else
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);
        }
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
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

//Remove tenant
public function removeTenantFromInvnt(Request $request)
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
   //Global variables
   $prop_status_v = $this->prop_status_v;
   $invnt_level_status_p = $this->invnt_level_status_p;
   $invnt_level_status_v = $this->invnt_level_status_v;
   $invnt_level_status_a = $this->invnt_level_status_a;
   $prop_invnt_status_c = $this->prop_invnt_status_c;
   $prop_invnt_status_a = $this->prop_invnt_status_a;
   $user_type_ten = $this->user_type_ten;
   $user_status_v = $this->user_status_v;
   $tenant_status_a = $this->tenant_status_a;
   $tenant_status_d = $this->tenant_status_d;
  $selected_user_id = $request['rentfuid'];
  $p_summary_id = $request['p_summary_id'];
  $invnt_s_id = $request['invnt_s_id'];

  //Flags
  $valid_prop_flag = false;
  $user_id_valid_flag = false;
  $db_execution_flag = false;

  if ($request->session()->has('invnt_tenant_uid') && $request->session()->has('modi_ten_iid') && $request->session()->has('modi_ten_pid'))
  {

    $user_id = session('invnt_tenant_uid');
    $invnt_id = session('modi_ten_iid');
    $prop_id = session('modi_ten_pid');

    if(($user_id == $selected_user_id) && ($invnt_id == $invnt_s_id) && ($prop_id == $p_summary_id))
    {
      $user_id_valid_flag = true;
    }
    else
    {

      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong."
    ],200);
    }
  }
  if($user_id_valid_flag)
  {
    $user_data = User::where('user_id', $selected_user_id)->where('user_type_id', $user_type_ten)->where('user_status_id',$user_status_v)->first();
    if(!$user_data)
    {

      return response()->json([
        "rc"=>"2",
        "rd" => "User is not registered !"
      ]);
    }
    else
    {
      $prop_id = $p_summary_id;
      $invnt_id = $invnt_s_id;
      $user_id = $selected_user_id;

    //Active Property check
    $active_prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                          ->where('prop_status_id', $prop_status_v)
                          ->first();
    //Inventory exists or not check
    $assigned_invnt_check = TsPropInvntLevel::where('prop_id', $prop_id)
                          ->where('invnt_level_status_id', $invnt_level_status_a)
                          ->where('morp','>', 0)
                          ->first();
    if($active_prop_check && $assigned_invnt_check)
    {
      $valid_prop_flag = true;
    }
    if($valid_prop_flag)
    {

    //Get all unoccupied or inactive inventory
    $this_active_invnt = TsPropInventory::where('prop_id', $prop_id)
                          ->where('ts_prop_invnt_level_id',$assigned_invnt_check->ts_prop_invnt_level_id)
                          ->where('ts_prop_invnt_id',$invnt_id)
                          ->where('invnt_status_id',$prop_invnt_status_a)
                          ->where('user_id','=',$user_id)
                          ->first();

      if($this_active_invnt)
      {
        $tagged_tenant_check = TsTaggedTenant::where('ts_prop_invnt_id', $invnt_id)
                                            ->where('tagged_tenant_status_id',$tenant_status_a)
                                            ->where('user_id',$user_id)
                                            ->where('prop_id',$prop_id)
                                            ->first();

        if($tagged_tenant_check)
        {

          $tagged_tenant_check->rent = $this_active_invnt->rent;
          $tagged_tenant_check->maint_charge = $this_active_invnt->maint_charge;
          $tagged_tenant_check->rent_pay_date = $this_active_invnt->rent_pay_date;
          $tagged_tenant_check->end_date = Carbon::now();
          $tagged_tenant_check->tagged_tenant_status_id = $tenant_status_d;
          if($tagged_tenant_check->update())
          {
            $this_active_invnt->rent = 0;
            $this_active_invnt->maint_charge = 0;
            $this_active_invnt->rent_pay_date = 0;
            $this_active_invnt->user_id = 0;
            $this_active_invnt->invnt_status_id = $prop_invnt_status_c;
            if($this_active_invnt->update())
            {
                //Final commit
                DB::commit();
                return response()->json([
                  'rc'=>'1',
                  "rd"=>"Tenant removed !"
              ],200);

            }
            else
            {
              return response()->json([
                'rc'=>'2',
                "rd"=>"Something went wrong."
            ],200);
            }
          }
          else
          {
            return response()->json([
              'rc'=>'2',
              "rd"=>"Something went wrong."
          ],200);
          }
        }
        else
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);
        }
      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Something went wrong."
      ],200);
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
//Get invoice view
public function getInvoicesView()
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
  //Global variables
   $prop_status_v = $this->prop_status_v;
   $invoice_status_c = $this->invoice_status_c;
   $invoice_status_s = $this->invoice_status_s;
   $invoice_status_p = $this->invoice_status_p;
   $inv_item_r = $this->inv_item_r;
   $inv_item_m = $this->inv_item_m;
   $inv_item_c = $this->inv_item_c;

  //Check If invoice exists
  $get_invoice = TsInvoice::latest()->get();
  //Check if Drafted invoices exist
  $get_dr_invoice = TsInvoice::where('invoice_status_id', $invoice_status_c)
                              ->where('payment_type_id', '=', 0)
                              ->where('total_amount', '!=', 0)
                              ->latest()->get();
  //Get all Pending Invoice which has been notifed
  $get_pend_invoice = TsInvoice::where('invoice_status_id', $invoice_status_s)
                                ->where('payment_type_id', '=', 0)
                                ->where('total_amount', '!=', 0)
                                ->latest()->get();

  return view('invoice_main_view',
                ['admin'=>Auth::user(),'all_invoices' => $get_invoice,
                'dr_invoices' => $get_dr_invoice, 'pend_invoices' => $get_pend_invoice]);
}
catch(\Exception $e)
{
    DB::rollback();
    echo $e->getMessage();
}
}
//Get Bulk invoice genrate view
public function getBulkInvoiceCreView()
{

  $month_year = Carbon::now();
  //Array of previous, current and next month
  $month_year_array = array($month_year->startOfMonth()->subMonth()->format('F Y'),
                          $month_year->startOfMonth()->addMonth()->format('F Y'),
                          $month_year->startOfMonth()->addMonth()->format('F Y'));

  return view('bulk_invoice_generate', ['admin'=>Auth::user(), 'month_year_array' => $month_year_array]);
}
//Get custome Invoice view
public function getCustomInvoiceCreView(Request $request)
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
    //All active property with inventory
    $all_a_prop_w_invnt = DB::table('ts_submitted_properties')
                                  ->where('prop_status_id', $this->prop_status_v)
                                  ->join('ts_prop_invnt_levels', 'ts_prop_invnt_levels.prop_id', '=', 'ts_submitted_properties.prop_id')
                                  ->select('ts_prop_invnt_level_id')
                                  ->where('invnt_level_status_id', $this->invnt_level_status_a)
                                  ->where('morp', '!=', 0)
                                  ->get();
    if(count($all_a_prop_w_invnt) > 0)
    {
    //Formatted active property with inventory
    $f_a_prop_w_invnt= json_decode(json_encode($all_a_prop_w_invnt), true);

    //Get all active inventory of active properties which is assigned
    //Active property and inventory with user
    $a_pop_invnt_user = TsPropInventory::whereIn('ts_prop_invnt_level_id', $f_a_prop_w_invnt)
                        ->select('user_id')
                        ->where('invnt_status_id', $this->prop_invnt_status_a)
                        ->where('user_id', '!=', 0)
                        ->where('rent', '!=', 0)
                        ->groupBy('user_id')
                        ->distinct()
                        ->get();
     


      return view('custom_invoice_view', ['admin'=>Auth::user(), 'tenant_list' => $a_pop_invnt_user]);
    }
}
catch(\Exception $e)
{
    DB::rollback();
    echo $e->getMessage();
}
}
//Get details of tenant when creating custom invoice
public function postTenantCustInv(Request $request)
{
  try
  {
  $user_id = $request['id'];
  $user_data = User::where('user_id', $user_id)->where('user_type_id', $this->user_type_ten)->where('user_status_id',$this->user_status_v)->first();
  if(!$user_data)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "User is not registered !"
    ]);
  }
  else {
      $assigned_ten_check = TsPropInventory::where('user_id', $user_id)
                                          ->where('invnt_status_id',$this->prop_invnt_status_a)
                                          ->where('rent', '!=',0)
                                          ->get();
        if(count($assigned_ten_check) > 0)
        {
          //Set this user id to session, it will be retirved while creating custom invoice
          $request->session()->put('cust_inv_ten', $user_id);
          //Tenant's property details
          $prop_title = "N/A";
          $prop_type = "N/A";
          $prop_furnish = "N/A";
          $prop_bhk_type = "N/A";
          $prop_locality = "N/A";
          //Owner data
          $listed_by_name = "N/A";
          $listed_by_mobile = "N/A";
          $listed_by_email = "N/A";
          $o_address_line_1 = "N/A";
          $o_address_line_2 = "N/A";
          $o_city = "N/A";
          $o_state = "N/A";
          $o_pin = "N/A";
          //Tenant data
          $t_name = "N/A";
          $t_email = "N/A";
          $t_mobile = "N/A";
          $t_address_line_1 = "N/A";
          $t_address_line_2 = "N/A";
          $t_city = "N/A";
          $t_state = "N/A";
          $t_pin = "N/A";
          $prop_details = array();
          $owner_details = array();
          $ten_details = array();
          $invnt_details =  array();
          $cust_inv_data =  array();
          //Property Features
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->prop_title))
          {
            $prop_title = $assigned_ten_check[0]->tsSubmittedPropFun->prop_title;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->msPropTypeFun->prop_type))
          {
            $prop_type = $assigned_ten_check[0]->tsSubmittedPropFun->msPropTypeFun->prop_type;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->furnishFUn->prop_furnish_status))
          {
            $prop_furnish = $assigned_ten_check[0]->tsSubmittedPropFun->furnishFUn->prop_furnish_status;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->msPropBhkFun->prop_bhk))
          {
            $prop_bhk_type = $assigned_ten_check[0]->tsSubmittedPropFun->msPropBhkFun->prop_bhk;
          }
          //Property location details
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->prop_locality))
          {
            $prop_locality = $assigned_ten_check[0]->tsSubmittedPropFun->prop_locality;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->prop_city))
          {
            $prop_city = $assigned_ten_check[0]->tsSubmittedPropFun->prop_city;
          }
          //Property owner details
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->name))
          {
            $listed_by_name = $assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->name;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->mobile))
          {
            $listed_by_mobile = $assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->mobile;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->email))
          {
            $listed_by_email = $assigned_ten_check[0]->tsSubmittedPropFun->msPropertyUserFun->email;
          }
          if(!empty($assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->address_line_1))
          {
            $o_address_line_1 = $assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->address_line_1;
            $o_address_line_2 = $assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->address_line_2;
            $o_city = $assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->city;
            $o_state = $assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->state;
            $o_pin = $assigned_ten_check[0]->tsSubmittedPropFun->userFun->tsOwnerOtherInfo->pincode;
          }
          //Tenant Address
          if(!empty($user_data->tsTenantOtherInfo->address_line_1))
          {
            $t_address_line_1 = $user_data->tsTenantOtherInfo->address_line_1;
            $t_address_line_2 = $user_data->tsTenantOtherInfo->address_line_2;
            $t_city = $user_data->tsTenantOtherInfo->city;
            $t_state = $user_data->tsTenantOtherInfo->state;
            $t_pin = $user_data->tsTenantOtherInfo->pincode;
          }
          //Property details array
          $prop_details = array('prop_title' => $prop_title, 'prop_type' => $prop_type, 'prop_furnish' => $prop_furnish,
                                'prop_bhk_type' => $prop_bhk_type, 'prop_locality' => $prop_locality,
                                'prop_city' => $prop_city);

          //Owner details
          $owner_details = array('name' => $listed_by_name, 'mobile' => $listed_by_mobile,
                                  'email' => $listed_by_email, 'line_1' => $o_address_line_1,
                                  'line_2' => $o_address_line_2, 'city' => $o_city, 'state' => $o_state, 'pin' => $o_pin);


          //Tenant Details
         $ten_details = array('name' => $user_data->name, 'email' => $user_data->email,
                            'mobile' => $user_data->mobile, 'line_1' => $t_address_line_1, 'line_2' => $t_address_line_2,
                            'city' => $t_city, 'state' => $t_state, 'pin' => $t_pin);

          foreach ($assigned_ten_check as $one_invnt) {

            $invnt_details[] = array('invnt_id' => $one_invnt->ts_prop_invnt_id, 'invnt' => $one_invnt->fomatted_invnt_id);
          }

          $cust_inv_data = array('prop_details' => $prop_details, 'owner_details' => $owner_details,
                                'ten_details' => $ten_details, 'invnt_details' => $invnt_details);

          return response()->json([
          "rc"=>"1",
          "rd" => $cust_inv_data
          ]);
        }
        else
        {
          return response()->json([
            "rc"=>"2",
            "rd" => "This tenant is not tagged !"
          ]);
        }
  }
}
catch(\Exception $e)
{
    echo $e->getMessage();
}
}
//Get details of slected inventory to create custom invoice against that
public function postCustInvInvntDetails(Request $request)
{
try
{
  $invnt_id = $request['id'];
  if(!$request->session()->has('cust_inv_ten') or !isset($invnt_id))
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
  $month_year = Carbon::now();
  //Array of previous, current and next month
  $month_year_array = array($month_year->startOfMonth()->subMonth()->format('F Y'),
                          $month_year->startOfMonth()->addMonth()->format('F Y'),
                          $month_year->startOfMonth()->addMonth()->format('F Y'));
  //Get user id of this invnt
  $user_id = session('cust_inv_ten');
  $invnt_check = TsPropInventory::where('user_id', $user_id)
                                        ->where('ts_prop_invnt_id', $invnt_id)
                                        ->where('invnt_status_id',$this->prop_invnt_status_a)
                                        ->where('rent', '!=',0)
                                        ->latest()->first();
  $account_heads = MsInvoiceItem::all();
  if($invnt_check)
  {
    //Set this inventory id to session, it will be retirved while creating custom invoice
    $request->session()->put('cust_inv_invnt_id', $invnt_id);
    return response()->json([
      "rc"=>"1",
      "rd" => $invnt_check,
      'account_head' => $account_heads,
      'month_year_array' => $month_year_array
    ]);
  }
  else
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Inventory doest not exist !"
    ]);
  }
   
}
catch(\Exception $e)
{
    echo $e->getMessage();
}
}
//Genrate bulk invoice
public function postGenrateBulkInvoice(Request $request)
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
  $validator = Validator::make($request->all(), [
    'rent_for_month' => 'required|date_format:F Y',
    'rent_due_date' => 'required|date_format:d-F-Y'
    ]);

    if ($validator->fails()) 
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Please select appropriate data."
    ],200);
    }

  $use_cashback_flag = true;
  $for_month_year = $request['rent_for_month'];
  $rent_due_date = $request['rent_due_date'];

  $formatted_month_year = Carbon::parse($for_month_year)->format('Y-m-d');
  //Format rent due date
  $f_rent_due_date = Carbon::parse($rent_due_date)->format('Y-m-d');
  //Check If invoices are already genrated
  $existing_bulk_check = TsInvoice::where('for_month', $formatted_month_year)
                                    ->where('invoice_type_id', $this->inv_type_b)->exists();
  if(!$existing_bulk_check)
  {
    //All active property with inventory
    $all_a_prop_w_invnt = DB::table('ts_submitted_properties')
                                  ->where('prop_status_id', $this->prop_status_v)
                                  ->join('ts_prop_invnt_levels', 'ts_prop_invnt_levels.prop_id', '=', 'ts_submitted_properties.prop_id')
                                  ->select('ts_prop_invnt_level_id')
                                  ->where('invnt_level_status_id',$this->invnt_level_status_a)
                                  ->where('morp', '!=', 0)
                                  ->get();
    if(count($all_a_prop_w_invnt) > 0)
    {
    //Formatted active property with inventory
    $f_a_prop_w_invnt= json_decode(json_encode($all_a_prop_w_invnt), true);

    //Get all active inventory of active properties
    //Active property and inventory
    $a_prop_and_invnt = TsPropInventory::whereIn('ts_prop_invnt_level_id', $f_a_prop_w_invnt)
                        ->where('invnt_status_id', $this->prop_invnt_status_a)
                        ->where('user_id', '!=', 0)
                        ->where('rent', '!=', 0)
                        ->get();
    if(count($a_prop_and_invnt) > 0)
    {

      //Loop to all gathered data
      foreach ($a_prop_and_invnt as $key => $value) {

        //Get tenant user id
        $ten_user_id = $value->user_id;
        //Get Prop id
        $ten_prop_id = $value->prop_id;
        //Get Inventory id
        $ten_invnt_id = $value->ts_prop_invnt_id;
        //Get Rent of this user
        $ten_rent = $value->rent;
        //Get maintenance charge
        $ten_maint_charge = $value->maint_charge;
        //Intiate wallet money
        $wallet_money = 0;
        //Total amount to be paid
        $total_amount = 0;
        if($use_cashback_flag)
        {
          $wallet_data = TsWallet::where('user_id', $ten_user_id)->first();
          if($wallet_data)
          {
            $wallet_money = $wallet_data->amount;
          }
        }
        //Calculate total amount
        $total_amount = $ten_rent + $ten_maint_charge - $wallet_money;

        //Create Invoice object to insert
        $ts_insert_invoice = new TsInvoice();
        $ts_insert_invoice->prop_id = $ten_prop_id;
        $ts_insert_invoice->ts_prop_invnt_id = $ten_invnt_id;
        $ts_insert_invoice->user_id = $ten_user_id;
        $ts_insert_invoice->total_amount = $total_amount;
        $ts_insert_invoice->for_month = $formatted_month_year;
        $ts_insert_invoice->due_date = $f_rent_due_date;
        $ts_insert_invoice->payable_amount = $total_amount;
        $ts_insert_invoice->invoice_type_id = $this->inv_type_b;
        $ts_insert_invoice->invoice_status_id = $this->invoice_status_c;
        if($ts_insert_invoice->save())
        {
          $invoice_id = $ts_insert_invoice->ts_invoice_id;
        }
        //If any problem creating invoice exit the loop
        if(!isset($invoice_id) or !$invoice_id > 0)
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);

        }
        //Check If rent item exists or not
        if(!isset($ten_rent) or !$ten_rent > 0)
        {
          return response()->json([
            'rc'=>'2',
            "rd"=>"Something went wrong."
        ],200);

        }
        //Formatted invoice items data for mass insert
        $formatted_invoice_item_data = array();
        if(isset($ten_rent))
        {
          //Get tenant rent row
          $formatted_invoice_item_data[] = array(
            "item_type_id" => $this->inv_item_r,
            "amount" => $ten_rent,
            "total" => $ten_rent,
            "flow_id" => $this->flow_add_id,
            "ts_invoice_id" => $invoice_id,
            "item_status_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ); 

        }
        //Insert maintenance item
        if(isset($ten_maint_charge))
        {
          //Get tenant maintenance row
          $formatted_invoice_item_data[] = array(
            "item_type_id" => $this->inv_item_m,
            "amount" => $ten_maint_charge,
            "total" => $ten_maint_charge,
            "flow_id" => $this->flow_add_id,
            "ts_invoice_id" => $invoice_id,
            "item_status_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ); 
        }
        //Insert cashback item if exist
        if(isset($wallet_money) && $wallet_money > 0)
        {

          //Get tenant maintenance row
          $formatted_invoice_item_data[] = array(
            "item_type_id" => $this->inv_item_c,
            "amount" => $wallet_money,
            "total" => $wallet_money,
            "flow_id" => $this->flow_sub_id,
            "ts_invoice_id" => $invoice_id,
            "item_status_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ); 

        }
        //Check if all data inserted properly
        $invoice_item_insert = DB::table('ts_invoice_items')->insert($formatted_invoice_item_data);
        if(!$invoice_item_insert)
        {
          return response()->json([
            "rc"=>"2",
            "rd" => "Something went wrong !"
          ]);
        }

          //Check If this invoice exists to create PDF Invoice
          $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                                      ->where('for_month', '=',$formatted_month_year)
                                      ->latest()->first();
          if($get_invoice)
          {

          $formatted_invoice_data = array();
          $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->get();
          //Check if invoice exists
          if($get_invoice && count($get_invoice_items) > 0)
          {
          //Formatted Invoice ID
          $formatted_invoice_id = "MOZI".$invoice_id;
          //Formatted For month
          $formatted_month = Carbon::parse($get_invoice->for_month)->format('F Y');
          //Get Tenant UID
          $tenant_uid = $get_invoice->user_id;
          //Tenant details
          $tenant_details = User::where('user_id', $tenant_uid)
                                    ->where('user_type_id',$this->user_type_ten)->first();
          //Get Property ID
          $prop_id = $get_invoice->prop_id;
          $prop_details = TsSubmittedProperty::where('prop_id', $prop_id)
                                          ->where('prop_status_id', $this->prop_status_v)
                                          ->first();
          //Get Owner ID
          $owner_uid = $prop_details->user_id;
          //Owner details
          $owner_details = User::where('user_id', $owner_uid)->first();


          $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,'prop_details' => $prop_details,
                          'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                          'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
          if($dompdf = PDF::loadView('rental_invoice', ['data'=>$formatted_invoice_data]))
          {
            $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf'));
          }
          
          }
        }
      //End of loop
      }
          //Final commit
          DB::commit();
          return response()->json([
            'rc'=>'1',
            "rd"=>"Bulk Invoice Genrated!"
        ],200);

    }
    else
    {
      return response()->json([
        'rc'=>'3',
        "rd"=>"There is not active inventory."
    ],200);
    }

    }
    else
    {
      return response()->json([
        'rc'=>'3',
        "rd"=>"There is not active property."
    ],200);
    }
  }
  else
  {
    return response()->json([
      'rc'=>'3',
      "rd"=>"Invoices already genrated for this month"
  ],200);

  }
}
catch(\Exception $e)
{
    DB::rollback();
    echo $e->getMessage();
}
}
//Generate custom invoice
public function postGenrateCustomInvoice(Request $request)
{
  try
  {
    //Begin Transaction
    DB::beginTransaction();
    $validator = Validator::make($request->all(), [
      'cust_inv_f_m' => 'required|date_format:F Y',
      'cust_inv_d_d' => 'required|date_format:d-F-Y',
      'cust_inv_item' => 'required|array'
      ]);

      if ($validator->fails()) 
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Please select appropriate data."
      ],200);
      }
    $for_month_year = $request['cust_inv_f_m'];
    $rent_due_date = $request['cust_inv_d_d'];
    $invoice_items = $request['cust_inv_item'];
    $inv_tds = $request['cust_inv_tds'];
    $inv_gst = $request['cust_inv_gst'];

    $formatted_month_year = Carbon::parse($for_month_year)->format('Y-m-d');
    //Format rent due date
    $f_rent_due_date = Carbon::parse($rent_due_date)->format('Y-m-d');
    //Check session
    if(!$request->session()->has('cust_inv_ten') or !$request->session()->has('cust_inv_invnt_id'))
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
    //Get user id of this invnt
   $user_id = session('cust_inv_ten');
   $invnt_id = session('cust_inv_invnt_id');

  //Active property and inventory check
  $invnt_check = TsPropInventory::where('ts_prop_invnt_id', $invnt_id)
                                    ->where('invnt_status_id', $this->prop_invnt_status_a)
                                    ->where('user_id', $user_id)
                                    ->where('rent', '!=', 0)
                                    ->first();
  if(!$invnt_check)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Inventory is not tagged to this tenant!"
    ]);
  }
  //Active property check
  $prop_details = TsSubmittedProperty::where('prop_id', $invnt_check->prop_id)
                                      ->where('prop_status_id', $this->prop_status_v)
                                      ->first();
  if(!$prop_details)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Property No longer exists !"
    ]);
  }

  //Owner check
  $owner_details = User::where('user_id', $prop_details->user_id)->first();
  
  if(!$owner_details)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Owner No longer exists !"
    ]);
  }
  //Tenant details
  $tenant_details = User::where('user_id', $user_id)
                          ->where('user_type_id',$this->user_type_ten)->first();

  if(!$tenant_details)
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Tenant No longer exists !"
    ]);
  }
  //Insert few items to ts_invoice and get the invoice id
  $ts_insert_invoice = new TsInvoice();
  $ts_insert_invoice->prop_id = $invnt_check->prop_id;
  $ts_insert_invoice->ts_prop_invnt_id = $invnt_id;
  $ts_insert_invoice->user_id = $user_id;
  $ts_insert_invoice->total_amount = 0;
  $ts_insert_invoice->for_month = $formatted_month_year;
  $ts_insert_invoice->due_date = $f_rent_due_date;
  $ts_insert_invoice->invoice_type_id = $this->inv_type_c;
  $ts_insert_invoice->invoice_status_id = $this->invoice_status_c;
  if($ts_insert_invoice->save())
  {
    $invoice_id = $ts_insert_invoice->ts_invoice_id;
  }
  //If Invoice created 
  if($invoice_id > 0)
  {

    //DB::commit();
     //Format data for invoice Items
     $formatted_data = array();
     $sub_total = 0;
     $tds_total = 0;
     $gst_total = 0;
     $net_total = 0;
     foreach ($invoice_items as $key => $value) {
      //If item is for discount
      if($value[1] == 3)
      {
        //Deduct Subtotal
        $sub_total -= $value[2];
        $formatted_data[] = array(
          "item_type_id" => $value[1],
          "amount" => $value[2],
          "total" => $value[2],
          "flow_id" => $this->flow_sub_id,
          "ts_invoice_id" => $invoice_id,
          "item_status_id" => 1,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        );
      }
      else
      {
        //Add price
        $sub_total += $value[2];
        //Item is for addition
        $formatted_data[] = array(
          "item_type_id" => $value[1],
          "amount" => $value[2],
          "total" => $value[2],
          "flow_id" => $this->flow_add_id,
          "ts_invoice_id" => $invoice_id,
          "item_status_id" => 1,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        );
      }
    
    }
    if($sub_total <= 0)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Total Sum Should be positive number !"
      ]);
    }
    //Calculate TDS
    if(isset($inv_tds) && $inv_tds > 0)
    {
      $tds_total = $sub_total*$inv_tds;
      $tds_total = $tds_total/100;
    }
    //Calculate GST
    if(isset($inv_gst) && $inv_gst > 0)
    {
      $gst_total = $sub_total*$inv_gst;
      $gst_total = $gst_total/100;
    }
    //Add total payable amount
    $net_total = $sub_total + $tds_total + $gst_total;
    if($net_total <= 0)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Total Sum Should be positive number !"
      ]);
    }
    $invoice_item_insert = DB::table('ts_invoice_items')->insert($formatted_data);
    if(!$invoice_item_insert)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
    $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                              ->latest()->first();
    if(!$get_invoice)
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
    $get_invoice->total_amount = $sub_total;
    $get_invoice->gst = $gst_total;
    $get_invoice->tds = $tds_total;
    $get_invoice->payable_amount = $net_total;
    if(!$get_invoice->update())
    {
      return response()->json([
        "rc"=>"2",
        "rd" => "Something went wrong !"
      ]);
    }
    //Format and gather data for invoice PDF
      $formatted_invoice_data = array();
      $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->get();
      //Check if invoice exists
      if($get_invoice && count($get_invoice_items) > 0)
      {
      //Formatted Invoice ID
      $formatted_invoice_id = "MOZI".$invoice_id;
      //Formatted For month
      $formatted_month = Carbon::parse($get_invoice->for_month)->format('F Y');

      $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,'prop_details' => $prop_details,
                      'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                      'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
      $dompdf = PDF::loadView('rental_invoice', ['data'=>$formatted_invoice_data]);
      if($dompdf && $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf')))
      {
        DB::commit();
        return response()->json([
          'rc'=>'1',
          "rd"=>"Invoice Genrated!"
      ],200);
      }
      else
      {
        return response()->json([
          "rc"=>"2",
          "rd" => "Could Not generate Invoice !"
        ]);
      }
      }
      else
      {
        return response()->json([
          "rc"=>"2",
          "rd" => "Something went wrong !"
        ]);
      }
  }
  else
  {
    return response()->json([
      "rc"=>"2",
      "rd" => "Something went wrong !"
    ]);
  }
  
    
  }
  catch(\Exception $e)
  {
      DB::rollback();
      echo $e->getMessage();
  }
}
//Get Invoice
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
      return back();
    }
    $userInfo = Auth::user();
    $user_id = $userInfo->user_id;
    //Check If this invoice exists
    $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                            ->where('for_month', '=',$tmp_id_1)
                            ->latest()->first();
    if($get_invoice)
    {
      //Genrate PDF from DB
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


          $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,'prop_details' => $prop_details,
                          'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                          'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
          $dompdf = PDF::loadView('rental_invoice', ['data'=>$formatted_invoice_data]);
          if($dompdf)
          {
            return $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf'))->stream($formatted_invoice_id.".pdf");
          } 
          //return view('rental_invoice', ['admin'=>Auth::user(),'data'=>$formatted_invoice_data]);

       }
      }
      else
      {
        return back();
      }
    }

    return back();
  }
  catch (DecryptException $e)
  {
    return back();
  }

}
//Get One invoice details
public function getOneInvoiceDetails($tmp_id_0, $tmp_id_1, $tmp_id_2)
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
      return back();
    }
    //Check If this invoice exists
    $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                            ->where('for_month', '=',$tmp_id_1)
                            ->latest()->first();
    if($get_invoice)
    {

      $formatted_invoice_data = array();
      $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->get();
      //Check if invoice exists
      if($get_invoice && count($get_invoice_items) > 0)
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


        $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month,'prop_details' => $prop_details,
                                        'tenant_details' => $tenant_details, 'owner_details' =>$owner_details,
                                        'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
        return view('admin_one_invoice_details', ['admin'=>Auth::user(),'data'=>$formatted_invoice_data]);
      }
      else
      {
        return back();
      }
    }

    return back();
  }
  catch (DecryptException $e)
  {
    return back();
  }

}
//Get all drafted invoices
public function getDraftInvoice()
{
  try
  {
  //Begin Transaction
  DB::beginTransaction();
  //Global variables
   $prop_status_v = $this->prop_status_v;
   $invoice_status_c = $this->invoice_status_c;
   $invoice_status_s = $this->invoice_status_s;
   $invoice_status_p = $this->invoice_status_p;
   $inv_item_r = $this->inv_item_r;
   $inv_item_m = $this->inv_item_m;
   $inv_item_c = $this->inv_item_c;

  //Check if Drafted invoices exist
  $get_dr_invoice = TsInvoice::where('invoice_status_id', $invoice_status_c)
                              ->where('payment_type_id', '=', 0)
                              ->where('total_amount', '!=', 0)
                              ->latest()->get();
  //Get all Pending Invoice which has been notifed
  $get_pend_invoice = TsInvoice::where('invoice_status_id', $invoice_status_s)
                                ->where('payment_type_id', '=', 0)
                                ->where('total_amount', '!=', 0)
                                ->latest()->get();

  return view('admin_drafted_invoice',
                ['admin'=>Auth::user(),
                'dr_invoices' => $get_dr_invoice, 'pend_invoices' => $get_pend_invoice]);
}
catch(\Exception $e)
{
    DB::rollback();
    echo $e->getMessage();
}
}
//Get all pending invoices
public function getPendInvoice()
{


  return "Under development";
}
public function postSendBulkInvoice(Request $request)
{
try
{
  //Begin Transaction
  DB::beginTransaction();
  //Global variables
   $prop_status_v = $this->prop_status_v;

  //Check if Drafted invoices exist
  $get_dr_invoice = TsInvoice::where('invoice_status_id', $this->invoice_status_c)
                              ->where('payment_type_id', '=', 0)
                              ->where('total_amount', '!=', 0)
                              ->latest()->get();
  if(count($get_dr_invoice) > 0)
  {
    $update_all = DB::table('ts_invoices')
                    ->where('invoice_status_id',  $this->invoice_status_c)
                    ->where('payment_type_id', '=', 0)
                    ->where('total_amount', '!=', 0)
                    ->update(['invoice_status_id' => $this->invoice_status_s]);
    if(!$update_all)
    {

      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wring"
      ],200);

    }
    //Final commit
    DB::commit();
    //Get all invoices and send
    foreach ($get_dr_invoice as $one_invoice)
    {
      //Get Invoice ID
      $invoice_id = $one_invoice->ts_invoice_id;
      //Get Tenant UID
      $tenant_uid = $one_invoice->user_id;
      //Tenant details
      $tenant_details = User::where('user_id', $tenant_uid)
                            ->where('user_type_id',$this->user_type_ten)->first();
      if($tenant_details)
      {
        $filename = $invoice_id.'.pdf';
        $full_path = storage_path('app/invoices/'.$filename);
        //Formatted name
        $formatted_name = "MOZI".$filename;
        $sms_text = "Hi ".ucwords($tenant_details->name) ." ! Invoice with no. ".$formatted_name." has been raised by Mozitoo. You may pay through www.mozitoo.com";
        //If Invoice PDF exists then attach the file else send plain email
        if(Storage::disk('invoice')->has($invoice_id.'.pdf'))
        {

          $this->dispatch((new SendBulkEmail($tenant_details, $full_path, $formatted_name)));
          $this->dispatch((new SendBulkSMS($tenant_details, $sms_text)));
        }
        //Plain email without attachment as file was not found
        else
        {
          $full_path = 0;
          $formatted_name = 0;
          $this->dispatch((new SendBulkEmail($tenant_details, $full_path, $formatted_name)));
          $this->dispatch((new SendBulkSMS($tenant_details, $sms_text)));
        }
      }
    }
    //Success response
    return response()->json([
      'rc'=>'1',
      "rd"=>"Invoice sent"
  ],200);

  }

  return response()->json([
    'rc'=>'2',
    "rd"=>"There is not drafted Invoices."
],200);

}
catch(\Exception $e)
{
    DB::rollback();
    echo $e->getMessage();
}

}
//Delete Draft Invoice
public function postDeleteDrInvoice(Request $request)
{

  try
  {
    //Begin Transaction
    DB::beginTransaction();
    $tmp_invoice = $request['tmp'];
    $for_month = $request['tmpp'];
    if(!$tmp_invoice or !$for_month)
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong !"
    ],200);
    }

    $invoice_id = Crypt::decrypt($tmp_invoice);

    if (!filter_var($invoice_id, FILTER_VALIDATE_INT))
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Something went wrong !"
    ],200);
    }

      //Check If this invoice exists
      $get_invoice = TsInvoice::where('ts_invoice_id', '=',$invoice_id)
                            ->where('for_month', '=',$for_month)
                            ->where('invoice_status_id',$this->invoice_status_c)
                            ->latest()->first();
    if($get_invoice)
    {
      $get_invoice_items = DB::table("ts_invoice_items")->where('ts_invoice_id', $invoice_id)->where('item_status_id',1)->delete();
      //Invoice Items
      if(!$get_invoice_items)
      {

        return response()->json([
          'rc'=>'2',
          "rd"=>"Unable to delete this Invoice !"
      ],200);
      }
      if($get_invoice->delete())
      {
        DB::commit();
        if(Storage::disk('invoice')->has($invoice_id.'.pdf'))
        {
          Storage::disk('invoice')->delete($invoice_id.'.pdf');
        }
        return response()->json([
          'rc'=>'1',
          "rd"=>"Invoice deleted!"
      ],200);

      }
      else
      {
        return response()->json([
          'rc'=>'2',
          "rd"=>"Unable to delete this Invoice !"
      ],200);
      }

    }
    else
    {
      return response()->json([
        'rc'=>'2',
        "rd"=>"Unable to delete this Invoice !"
    ],200);
    }

  }
  catch (DecryptException $e)
  {
    return response()->json([
      'rc'=>'2',
      "rd"=>"Something went wrong !"
  ],200);
  }
  catch(\Exception $e)
  {
      DB::rollback();
      echo $e->getMessage();
  }
}
//Send Reminder for invoices which are not paid
public function postSendReminder(Request $request)
{
try
{

  //Global variables
   $prop_status_v = $this->prop_status_v;

  //Check if inding invoices exist
  $get_pend_invoice = TsInvoice::where('invoice_status_id', $this->invoice_status_s)
                              ->where('payment_type_id', '=', 0)
                              ->where('total_amount', '!=', 0)
                              ->latest()->get();
  if(count($get_pend_invoice) > 0)
  {

    //Get all invoices and send
    foreach ($get_pend_invoice as $one_invoice)
    {
      //Get Invoice ID
      $invoice_id = $one_invoice->ts_invoice_id;
      //Get Tenant UID
      $tenant_uid = $one_invoice->user_id;
      //Tenant details
      $tenant_details = User::where('user_id', $tenant_uid)
                            ->where('user_type_id',$this->user_type_ten)->first();
      if($tenant_details)
      {
        $filename = $invoice_id.'.pdf';
        //Formatted name
        $formatted_name = "MOZI".$filename;
        $sms_text = "Hi ".ucwords($tenant_details->name) ." ! Invoice with no. ".$formatted_name." has been raised by Mozitoo. You may pay through www.mozitoo.com";
         //Plain email reminder
        $this->dispatch((new SendReminderEmail($tenant_details, $formatted_name)));
        $this->dispatch((new SendBulkSMS($tenant_details, $sms_text)));

      }
    }
    //Success response
    return response()->json([
      'rc'=>'1',
      "rd"=>"Reminder sent"
  ],200);

  }
  return response()->json([
    'rc'=>'2',
    "rd"=>"There is not pending Invoices."
],200);

}
catch(\Exception $e)
{
    echo $e->getMessage();
}
}
//End of file
}
