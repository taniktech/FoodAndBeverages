<?php

namespace App\Http\Controllers;

use App\MsPropBhkType;
use App\MsPropertyAmenty;
use App\MsPropertyFurnishStatus;
use App\MsPropertyType;
use App\MsServiceRequestType;
use App\MsTenantPrefrence;
use App\TsEditedSubmittedProperty;
use App\TsInvoice;
use App\TsInvoiceItem;
use App\MsPropInvntLevel;
use App\TsOwnerOtherInfo;
use App\TsPropInventory;
use App\TsPropInvntLevel;
use App\TsServiceRequest;
use App\TsSubmittedProperty;
use App\TsTaggedProperty;
use App\TsCity;
use App\TsState;
use App\TsTaggedTenant;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;
use Validator;

class OwnerDashboardController extends Controller
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
        //Inventory level status
        $this->invnt_level_status_p = 1;
        $this->invnt_level_status_v = 2;
        $this->invnt_level_status_a = 3;
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
        //Tagged manager status
        $this->tagged_mgr_a = 1;
        //Invoice status
        //Created
        $this->invoice_status_c = 1;
        //Sent to tenants
        $this->invoice_status_s = 2;
        //Paid
        $this->invoice_status_p = 3;
    }
    //Get Agent Dashboard
    public function getOwnerDashboard()
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $ts_prop = array();
        $ts_ser_reqs = array();
        $ts_rented_prop = array();
        $ts_pend_prop = array();
        //Check if Property Exists
        $ts_prop = TsSubmittedProperty::select('prop_id')
            ->where('prop_status_id', $this->prop_status_v)
            ->where('user_id', $user_id)->get();
        if (count($ts_prop) > 0) {
            //Check if any service request from owner
            $ts_ser_reqs = TsServiceRequest::whereIn('prop_id', $ts_prop)->get();

            //Check for rented properties
            $ts_rented_prop = DB::table('ts_prop_invnt_levels')
                ->select('ts_prop_invnt_level_id')
                ->whereIn('prop_id', $ts_prop)
                ->where('invnt_level_status_id', '=', $this->invnt_level_status_a)
                ->where('morp', '>', 0)
                ->whereRaw("ts_prop_invnt_levels.ts_prop_invnt_level_id IN (Select ts_prop_invnt_level_id from ts_prop_inventories where invnt_status_id = '$this->prop_invnt_status_a' and rent > 0)")
                ->get();

        }
        //Check if pending property
        $ts_pend_prop = TsSubmittedProperty::where('user_id', $user_id)
            ->where('prop_status_id', $this->prop_status_p)->get();

        return view('owner', ['owner' => Auth::user(),
            'ts_prop' => $ts_prop, 'ts_ser_reqs' => $ts_ser_reqs,
            "ts_rented_prop" => $ts_rented_prop, "ts_pend_prop" => $ts_pend_prop,
        ]);

    }

// Get service request form
    public function getServiceReqForm()
    {

        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        //Get all service requests type
        $ms_ser_req_type = MsServiceRequestType::all();
        //Check if any approved property exists
        $owner_prop = TsSubmittedProperty::where('prop_status_id', $this->prop_status_v)->where('user_id', $user_id)->get();

        return view('ownerservicereq', ['owner' => Auth::user(), 'owner_prop' => $owner_prop, 'ms_ser_req_type' => $ms_ser_req_type]);

    }
    //Get all verified property
    public function getAllProperty()
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $ts_prop = array();
        //Check if verified Property Exists
        $ts_prop = TsSubmittedProperty::where('prop_status_id', $this->prop_status_v)
            ->where('user_id', $user_id)->get();

        return view('ownerproperties', ['owner' => Auth::user(), 'ts_prop' => $ts_prop]);
    }

    //Get Submit form
    public function getSubmitForm()
    {
        $msPropertyType = MsPropertyType::all();
        $msPropertyFurnishStatus = MsPropertyFurnishStatus::all();
        $msPropertyAmenty = MsPropertyAmenty::all();
        $msTenantPrefrence = MsTenantPrefrence::all();
        $msPropInvntLevel = MsPropInvntLevel::all();
        $msPropBhkType = MsPropBhkType::all();
        $ts_states = TsState::groupBy('name')->distinct()->get();
        return view('ownersubmitform',
            [
                'owner' => Auth::user(),
                'propertyType' => true, 'msPropertyTypes' => $msPropertyType,
                'propertyAmenty' => true, 'msPropertyAmenties' => $msPropertyAmenty,
                'tenantPrefrence' => true, 'msTenantPrefrences' => $msTenantPrefrence,
                'propertyFurnishStatus' => true, 'msPropertyFurnishStatuses' => $msPropertyFurnishStatus,
                'propInvntLevel' => true, 'msPropInvntLevels' => $msPropInvntLevel,
                'propBhkType' => true, 'msPropBhkTypes' => $msPropBhkType,
                'ts_state' => true, 'ts_states' => $ts_states,
            ]);
    }

    // Submit service requests

    public function submitServiceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_prop_id' => 'required|integer',
            'service_req_type' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'rc' => '2',
                "rd" => "Please select appropriate data.",
            ], 200);
        }
        $prop_id = $request['owner_prop_id'];
        $ser_req_type_id = $request['service_req_type'];

        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tsServiceRequest = new TsServiceRequest();
        $tsServiceRequest->prop_id = $prop_id;
        $tsServiceRequest->service_req_type_id = $ser_req_type_id;
        $tsServiceRequest->user_id = $user_id;

        $message = $request['service_msg'];
        if ($message) {
            $tsServiceRequest->message = $message;
        }

        $service_req_action_id = 1;

        $tsServiceRequest->service_req_action_id = $service_req_action_id;

        if ($tsServiceRequest->save()) {
            return response()->json([
                "rc" => "1",
                "rd" => "Request submitted.",
            ]);
        }
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
  //Insert property now
  if(!$user_id == 0)
  {

      $state_data = TsState::where('state_id', $request['inputState'])->first();
      $state_name = $state_data->name;
      $tsSubmittedProperty = new TsSubmittedProperty();
      $tsSubmittedProperty->user_id = $user_id;

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
//Get One property
public function getOneProperty($prop_id, Request $request)
{
    $userInfo = Auth::user();
    $user_id = $userInfo->user_id;
    $prop_tenants = array();
    //Check if verified Property Exists
    $one_prop = TsSubmittedProperty::where('prop_id', $prop_id)
        ->where('prop_status_id', $this->prop_status_v)
        ->where('user_id', $user_id)->latest()->first();
    if ($one_prop) {
        //Set this prop_id to session, it will be retirved when required
        $request->session()->put('curr_owner_prop', $prop_id);
        //Check tagged manager
        $prop_manager = TsTaggedProperty::where('prop_id', $prop_id)
            ->where('tagged_prop_status_id', $this->tagged_mgr_a)
            ->where('user_id', '!=', 0)
            ->latest()->first();
        //Check tenants, first check if invnt level exists
        $prop_tenants_check = TsPropInvntLevel::where('prop_id', $prop_id)
            ->where('invnt_level_status_id', $this->invnt_level_status_a)
            ->where('morp', '!=', 0)
            ->latest()->first();
        //Check if inventory level exists
        if ($prop_tenants_check) {
            //Check tenants
            $prop_tenants = TsPropInventory::where('prop_id', $prop_id)
                ->where('ts_prop_invnt_level_id', $prop_tenants_check->ts_prop_invnt_level_id)
                ->latest()->get();
        }
        $ts_prop_invnt_levels = TsPropInvntLevel::where('prop_id', $prop_id)
            ->groupBy('prop_invnt_level_id')->distinct()->get();
        //Get master table data
        $msTenantPrefrence = MsTenantPrefrence::all();
        $msPropertyType = MsPropertyType::all();
        $msPropBhkType = MsPropBhkType::all();
        $msPropertyFurnishStatus = MsPropertyFurnishStatus::all();
        $amenities = $one_prop->prop_amenty_id;
        $amenities = explode(",", $amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();
        return view('oneownerproperty', ['owner' => Auth::user(),
            'one_prop' => $one_prop, "msPropertyAmenties" => $msPropertyAmenties,
            'msPropertyAmentyAllCheck' => true, 'msPropertyAmentyAll' => $msPropertyAmentyAll,
            'prop_mgr' => $prop_manager, 'prop_tenants' => $prop_tenants,
            'msPropBhkTypes' => $msPropBhkType, 'msPropertyTypes' => $msPropertyType,
            'msTenantPrefrences' => $msTenantPrefrence, 'msPropertyFurnishStatuses' => $msPropertyFurnishStatus,
            'ts_prop_invnt_levels' => $ts_prop_invnt_levels, 'n_a' => 'N/A']);
    }

    return back();

}
    //update one property
    public function updateOneProperty(Request $request)
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $prop_id = $request['propertyID'];
        $prop_status_id = 1;
        $oneProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        if (!$oneProperty) {
            return response()->json([
                'rc' => '3',
            ], 200);
        } else {

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

            $tsEditedSubmittedProperty = new TsEditedSubmittedProperty();
            $prop_status_id = 0;
            $tsEditedSubmittedProperty->prop_id = $prop_id;
            $tsEditedSubmittedProperty->prop_status_id = $prop_status_id;
            $tsEditedSubmittedProperty->user_id = $user_id;
            $tsEditedSubmittedProperty->tenant_prefrences_id = $inputTenant;
            $tsEditedSubmittedProperty->prop_title = $propertyTitle;
            $tsEditedSubmittedProperty->prop_desc = $propertyDesc;
            $tsEditedSubmittedProperty->prop_type_id = $propertyType;
            $tsEditedSubmittedProperty->prop_rent = $propertyPrice;
            $tsEditedSubmittedProperty->prop_bed = $propertyBeds;
            $tsEditedSubmittedProperty->prop_bath = $propertyBaths;
            $tsEditedSubmittedProperty->prop_area = $propertyArea;
            $tsEditedSubmittedProperty->prop_age = $propertyAge;
            $tsEditedSubmittedProperty->prop_furnish_status_id = $propertyFurnishingStatus;
            $tsEditedSubmittedProperty->prop_furniture_age = $propertyFurnishingAge;
            $tsEditedSubmittedProperty->prop_city = $propertyCity;
            $tsEditedSubmittedProperty->prop_state = $propertyState;
            $tsEditedSubmittedProperty->prop_pincode = $propertyPincode;
            $tsEditedSubmittedProperty->prop_address_line1 = $propertyAddressLine1;
            $tsEditedSubmittedProperty->prop_locality = $propertyLocation;
            $tsEditedSubmittedProperty->prop_lat = $inputLat;
            $tsEditedSubmittedProperty->prop_lng = $inputLng;
            $tsEditedSubmittedProperty->prop_status_id = $prop_status_id;
            if (!$propertyAmenties == 0) {
                $tsEditedSubmittedProperty->prop_amenty_id = $propertyAmenties;
            } else {
                $tsEditedSubmittedProperty->prop_amenty_id = 7;
            }

            if ($tsEditedSubmittedProperty->save()) {
                $file = $request->file('propertyPic');
                $filename = $prop_id . '_tmp.jpg';
                if ($file) {
                    Storage::disk('public_uploads')->put($filename, File::get($file));
                }
                return response()->json([
                    'rc' => '1',
                    "rd" => "Property Successfully Updated.",
                ], 200);
            } else {
                return response()->json([
                    'rc' => '2',
                    "rd" => "Something went wrong.",
                ], 200);
            }

        }

    }

    //Get One property
    public function getDeleteOneProperty($prop_id)
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $prop_id = $prop_id;
        $prop_status_id = 1;
        $oneProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        if (!$oneProperty) {
            return redirect()->route('owner.property.all');
        }
        $oneProperty->delete();
        TsEditedSubmittedProperty::where('prop_id', $prop_id)->delete();
        TsServiceRequest::where('prop_id', $prop_id)->delete();
        TsTaggedProperty::where('prop_id', $prop_id)->delete();
        return redirect()->route('owner.property.all');
    }

    // logout
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    // Get All service request
    public function getOwnerServiceReq()
    {

        $user_info = Auth::user();
        $user_id = $user_info->user_id;
        $ts_ser_reqs = array();
        $prop_check = TsSubmittedProperty::where('user_id', $user_id)
            ->select('prop_id')
            ->where('prop_status_id', $this->prop_status_v)
            ->get();
        if (count($prop_check) > 0) {
            $ts_ser_reqs = TsServiceRequest::whereIn('prop_id', $prop_check)
                ->latest()->get();
        }
        return view('ownerallservicereq', ['owner' => Auth::user(), 'ts_ser_reqs' => $ts_ser_reqs]);

    }
    //Owner Pending properties for approval
    public function getPendingProperty()
    {
        $user_info = Auth::user();
        $user_id = $user_info->user_id;
        $pend_prop_check = TsSubmittedProperty::where('user_id', $user_id)
                                                ->where('prop_status_id', $this->prop_status_p)
                                                ->latest()->get();
        return view('ownerpendingprop', ['owner' => Auth::user(), 'pend_prop' => $pend_prop_check]);

    }

    //Get Pending One property
    public function getOnePendingProperty($prop_id)
    {
        $user_info = Auth::user();
        $user_id = $user_info->user_id;
        $onePendingProperty = TsSubmittedProperty::where('prop_id', $prop_id)
                                                    ->where('user_id', $user_id)
                                                    ->where('prop_status_id', $this->prop_status_p)->first();
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
 
         $ts_prop_invnt_levels = TsPropInvntLevel::where('prop_id', $prop_id)->where('invnt_level_status_id', $this->invnt_level_status_p)->groupBy('prop_invnt_level_id')->distinct()->get();
 
         return view('ownerpendingpropdetails',['owner'=>Auth::user(),'one_prop'=>$onePendingProperty,
         "msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,
         'msPropertyAmentyAll'=>$msPropertyAmentyAll,
         'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
         'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
         'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
         'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
         'ts_prop_invnt_levels' => $ts_prop_invnt_levels,'n_a' => 'N/A']);
 
         }

        return back();

    }
    //Update One Pending property approval
    public function getUpdatePendingApprovalProp(Request $request)
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        try
        {
        //Global variables
        $prop_status_p = $this->prop_status_p;
        $prop_status_v = $this->prop_status_v;
        $invnt_level_status_p = $this->invnt_level_status_p;
        $invnt_level_status_v = $this->invnt_level_status_v;
        //Get Prop ID
        $prop_id = $request['prop_id'];
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
        $ts_prop_invnt_level = $request['ts_prop_invnt_level'];
        $rental_type_data = false;
        //Validate expected rent/demposit
        if(is_array($prop_invnt_levels) && is_array($exp_rents) && is_array($exp_depos) && is_array($ts_prop_invnt_level) && (count($prop_invnt_levels) == count($exp_rents) && count($exp_rents) == count($exp_rents)))
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
          $tsSubmittedProperty = TsSubmittedProperty::where('prop_id', $prop_id)
                                                    ->where('user_id', $user_id)
                                                    ->where('prop_status_id', $prop_status_p)->first();
          if(!$tsSubmittedProperty)
          {
            return response()->json([
              'rc'=>'3',
              "rd"=>"Something went wrong."
          ],200);
          }
            else
            {
  
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
                        "exp_rent" =>$request['exp_rent'][$key],
                        "exp_deposit" => $request['exp_depo'][$key],
                        'updated_at' => Carbon::now()
                      );
  
                      $rental_data_update = DB::table('ts_prop_invnt_levels')->where('prop_id', $prop_id)->where('ts_prop_invnt_level_id',$value)->where('invnt_level_status_id',1)->update($formatted_data);
  
                     }
                        if($rental_data_update)
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
                                    "rd"=>"Property Successfully Updated"
                                ],200);
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
  
        catch(\Exception $e)
        {
          DB::rollback();
          echo $e->getMessage();
        }
    }
//Get Password view
    public function getPwdView()
    {
        return view('ownerchangepwd', ['owner' => Auth::user()]);
    }

//Switch to tenant dashboard
    public function postSwitchToTenDash(Request $request)
    {
        if (Auth::check()) {
            $user_info = Auth::user();
            $user_type = $user_info->user_type_id;
            $status = $user_info->user_status_id;
            $email = $user_info->email;
            $mobile = $user_info->mobile;

            if ($status == $this->user_status_v && $user_type == $this->user_type_ownr) {
                $tenant_check = User::where('email', $email)
                    ->where('mobile', $mobile)
                    ->where('user_type_id', $this->user_type_ten)
                    ->where('user_status_id', $this->user_status_v)
                    ->first();
                if ($tenant_check) {
                    $ten_user_id = $tenant_check->user_id;
                    if(Auth::loginUsingId($ten_user_id)) {
                        return redirect()->route('tenantaccount');
                    } else {
                        return back();
                    }
                }
            }

        }
        //Return default
        return back();
    }
//Owner Profile
    public function getOwnerProfile()
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $ts_states = TsState::groupBy('name')->distinct()->get();
        $ts_cities = TsCity::all();
        //Check User
        $other_data = TsOwnerOtherInfo::where('user_id', $user_id)->first();
                        
        return view('owner_profile', ['owner' => Auth::user(),'ts_states' => $ts_states,'ts_cities' => $ts_cities, 'other_data' => $other_data]);
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
            $all_tenants = array();
            //Check if verified Property Exists
            $prop_check = TsSubmittedProperty::where('prop_id', $prop_id)
                ->where('prop_status_id', $this->prop_status_v)
                ->where('user_id', $user_id)->latest()->first();
            //Check if inventory exists
            $invnt_check = TsPropInventory::where('prop_id', $prop_id)
                ->where('ts_prop_invnt_id', $invnt_id)
                ->where('fomatted_invnt_id', $request->check)
                ->latest()->first();
            if ($prop_check && $invnt_check) {
                //Set this inventory to session, it will be retirved when required
                $request->session()->put('curr_owner_invnt', $invnt_id);
                //Get all old/new tenants
                $all_tenants = TsTaggedTenant::where('prop_id', $prop_id)
                    ->where('ts_prop_invnt_id', $invnt_id)
                    ->latest()->get();
                //Get all invoices against this inventory
                $all_invoices = TsInvoice::where('prop_id', $prop_id)
                    ->where('ts_prop_invnt_id', $invnt_id)
                    ->whereIn('invoice_status_id', [$this->invoice_status_s, $this->invoice_status_p])
                    ->latest()->get();
                return view('owner_one_invnt_details', ['owner' => Auth::user(), 'tenants' => $all_tenants, 'invoices' => $all_invoices]);

            } else {
                return back();
            }

        } catch (DecryptException $e) {
            return back();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
//Get Invoice
    public function getInvoice($tmp_id_0, $tmp_id_1, $tmp_id_2)
    {
        try
        {
            $invoice_id = Crypt::decrypt($tmp_id_0);
            $user_status_v = $this->user_status_v;
            if (!filter_var($invoice_id, FILTER_VALIDATE_INT)) {
                return back();
            }
            $userInfo = Auth::user();
            $user_id = $userInfo->user_id;
            //Check If this invoice exists
            $get_invoice = TsInvoice::where('ts_invoice_id', '=', $invoice_id)
                ->where('for_month', '=', $tmp_id_1)
                ->latest()->first();
            if ($get_invoice) {
                //Genrate PDF from DB
                $formatted_invoice_data = array();
                $get_invoice_items = TsInvoiceItem::where('ts_invoice_id', $invoice_id)->where('item_status_id', 1)->get();
                //Check if invoice exists
                if ($get_invoice && count($get_invoice_items) > 0) {
                    if (Storage::disk('invoice')->has($invoice_id . '.pdf')) {
                        $filename = $invoice_id . '.pdf';
                        $formatted_name = "MOZI" . $filename;
                        $headers = array(
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'inline; filename="' . $formatted_name . '"');
                        return response()->file(storage_path('app/invoices/' . $invoice_id . '.pdf'), $headers);
                    } else {
                        //Formatted Invoice ID
                        $formatted_invoice_id = "MOZI" . $invoice_id;
                        //Formatted For month
                        $formatted_month = Carbon::parse($get_invoice->for_month)->format('F Y');
                        //Get Tenant UID
                        $tenant_uid = $get_invoice->user_id;
                        //Tenant details
                        $tenant_details = User::where('user_id', $tenant_uid)
                            ->where('user_type_id', $this->user_type_ten)->first();
                        //Get Property ID
                        $prop_id = $get_invoice->prop_id;
                        $prop_details = TsSubmittedProperty::where('prop_id', $prop_id)
                            ->where('prop_status_id', $this->prop_status_v)
                            ->first();
                        //Get Owner ID
                        $owner_uid = $prop_details->user_id;
                        //Tenant details
                        $owner_details = User::where('user_id', $owner_uid)->first();

                        $formatted_invoice_data = array('invoice_id' => $formatted_invoice_id, 'for_month' => $formatted_month, 'prop_details' => $prop_details,
                            'tenant_details' => $tenant_details, 'owner_details' => $owner_details,
                            'invoice_data' => $get_invoice, 'invoice_item_data' => $get_invoice_items);
                        $dompdf = PDF::loadView('rental_invoice', ['data' => $formatted_invoice_data]);
                        if ($dompdf) {
                            return $dompdf->save(storage_path('app/invoices/'.$invoice_id.'.pdf'))->stream($formatted_invoice_id . ".pdf");
                        }
                        //return view('rental_invoice', ['admin'=>Auth::user(),'data'=>$formatted_invoice_data]);

                    }
                } else {
                    return back();
                }
            }

            return back();
        } catch (DecryptException $e) {
            return back();
        }

    }
//Upload rental agreement Owner/Agent/Tenant
    public function postRentAgreement(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'oat_id' => 'required',
                'oat_ten_id' => 'required',
                'oat_rental_agrmnt' => 'required|max:10000|mimes:pdf',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'rc' => '2',
                    "rd" => "Please select appropriate data.",
                ], 200);
            }
            if (!$request->session()->has('curr_owner_prop') or !$request->session()->has('curr_owner_invnt')) {
                return response()->json([
                    "rc" => "2",
                    "rd" => "Something went wrong !",
                ]);
            }
            $ten_user_id = $request->oat_ten_id;
            $tagged_tenant_id = $request->oat_id;
            $prop_id = session('curr_owner_prop');
            $invnt_id = session('curr_owner_invnt');
            //Check if all records are correct
            $all_tenants = TsTaggedTenant::where('prop_id', $prop_id)
                ->where('ts_prop_invnt_id', $invnt_id)
                ->where('user_id', $ten_user_id)
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
//Show rental agreement
    public function getRentalAgreement($tmp_id_0, $tmp_id_1, Request $request)
    {
        try
        {
            $ten_user_id = $tmp_id_0;
            $tagged_tenant_id = Crypt::decrypt($tmp_id_1);
            if (!filter_var($tagged_tenant_id, FILTER_VALIDATE_INT)) {
                return back();
            }
            if (!filter_var($ten_user_id, FILTER_VALIDATE_INT)) {
                return back();
            }
            if (!$request->session()->has('curr_owner_prop') or !$request->session()->has('curr_owner_invnt')) {
                return back();
            }

            $prop_id = session('curr_owner_prop');
            $invnt_id = session('curr_owner_invnt');
            //Check if all records are correct
            $check_tenants = TsTaggedTenant::where('prop_id', $prop_id)
                ->where('ts_prop_invnt_id', $invnt_id)
                ->where('user_id', $ten_user_id)
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
            $userCheck = User::where('user_id', $user_id)->where('user_type_id', $this->user_type_ownr)->first();
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
                    //Check if any tenant is there with same inputs
                    $ten_check = User::where('mobile', $mobile)
                        ->where('email', $email)
                        ->where('user_type_id', $this->user_type_ten)->first();
                    if ($ten_check) {
                        $ten_check->password = bcrypt($new_pwd);
                        if (!$ten_check->update()) {
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
    $other_info_check = TsOwnerOtherInfo::where('user_id', $user_id)->first();
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
        $new_info = new TsOwnerOtherInfo();
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
        $other_info_check = TsOwnerOtherInfo::where('user_id', $user_id)->first();
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
            $new_info = new TsOwnerOtherInfo();
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
    
        $other_info_check = TsOwnerOtherInfo::where('user_id', $user_id)->first();
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
            $new_info = new TsOwnerOtherInfo();
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
//Get all Invoices
public function getAllOwnInvoices()
{
    $user_info = Auth::user();
    $user_id = $user_info->user_id;
    $all_invoices = array();
    $prop_check = TsSubmittedProperty::where('user_id', $user_id)
        ->select('prop_id')
        ->where('prop_status_id', $this->prop_status_v)
        ->get();
       
    if (count($prop_check) > 0) {
        $all_invoices = TsInvoice::whereIn('prop_id', $prop_check)
                        ->whereIn('invoice_status_id', [$this->invoice_status_s, $this->invoice_status_p])
                        ->latest()->get();
    }

    return view('owner_all_invoices', ['owner' => Auth::user(), 'invoices' => $all_invoices]);
}
//End of file
}
