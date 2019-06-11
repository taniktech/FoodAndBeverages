<?php

namespace App\Http\Controllers;
use App\Http\Requests\CheckPropSubmitForm;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;
use App\User;
use App\Functions\CustomFunctions;
use Validator;
use App\MsPropertyType;
use App\TsCity;
use App\TsState;
use App\MsPropertyAmenty;
use App\TsSubmittedProperty;
use App\MsPropertyFurnishStatus;
use App\MsTenantPrefrence;
use App\MsPropInvntLevel;
use App\MsPropBhkType;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class SubmitController extends Controller
{
  
  //Global variables

  public function __construct()
  {
    $this->prop_status_p = 1;
    $this->prop_status_v = 2;
    $this->invnt_level_status_p = 1;
    $this->invnt_level_status_v = 2;
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
    //Return submit form
    public function getSubmitForm()
    {

      $msPropertyType = MsPropertyType::all();
      $msPropertyFurnishStatus = MsPropertyFurnishStatus::all();
      $msPropertyAmenty = MsPropertyAmenty::all();
      $msTenantPrefrence = MsTenantPrefrence::all();
      $msPropInvntLevel = MsPropInvntLevel::all();
      $msPropBhkType = MsPropBhkType::all();
      $ts_states = TsState::groupBy('name')->distinct()->get();
      if(Auth::check() && Auth::user()->user_type_id == '2')
      {
      return view('submitnew',
        [
      'tenant'=>Auth::user(),
      'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,
      'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
      'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
      'propInvntLevel'=>true, 'msPropInvntLevels'=>$msPropInvntLevel,
      'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
      'ts_state'=> true, 'ts_states' => $ts_states
        ]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '3')
      {
      return view('submitnew',
        [
      'owner'=>Auth::user(),
      'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,
      'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
      'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
      'propInvntLevel'=>true, 'msPropInvntLevels'=>$msPropInvntLevel,
      'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
      'ts_state'=> true, 'ts_states' => $ts_states
        ]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '4')
      {
      return view('submitnew',
        [
      'agent'=>Auth::user(),
      'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,
      'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
      'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
      'propInvntLevel'=>true, 'msPropInvntLevels'=>$msPropInvntLevel,
      'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
      'ts_state'=> true, 'ts_states' => $ts_states
        ]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '1')
      {
      return view('submitnew',
        [
      'admin'=>Auth::user(),
      'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,
      'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
      'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
      'propInvntLevel'=>true, 'msPropInvntLevels'=>$msPropInvntLevel,
      'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
      'ts_state'=> true, 'ts_states' => $ts_states
        ]);
      }
      return view('submitnew',
        [
      'propertyType'=>true,'msPropertyTypes'=>$msPropertyType,
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,
      'tenantPrefrence'=>true,'msTenantPrefrences'=>$msTenantPrefrence,
      'propertyFurnishStatus'=>true,'msPropertyFurnishStatuses'=>$msPropertyFurnishStatus,
      'propInvntLevel'=>true, 'msPropInvntLevels'=>$msPropInvntLevel,
      'propBhkType'=> true, 'msPropBhkTypes' => $msPropBhkType,
      'ts_state'=> true, 'ts_states' => $ts_states

        ]);

    }
//Insert Property
public function submitNewForm(Request $request)
{
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
  try
  {
  //Begin Transaction
  DB::beginTransaction();
  if($user_type_id == 1)
  {
    //Get new user data
    $name = $request['new_user_name'];
    $email = $request['new_user_email'];
    $mobile = $request['new_user_mobile'];
    $password = $request['new_user_pwd'];
    $password = bcrypt($password);

    $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_ownr)->where('user_status_id',$user_status_v)->first();
    $mobileCheck = User::where('mobile', $mobile)->where('user_type_id', $user_type_ownr)->where('user_status_id',$user_status_v)->first();
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
      $user->user_type_id = $user_type_ownr;
      $user->user_status_id = $user_status_id;
      if($user->save())
      {
      $user_id = $user->user_id;
      Auth::login($user);
      }
      //Add a tenant with same details
      $insert_tenant = new User();
      $insert_tenant->email = $email;
      $insert_tenant->name = $name;
      $insert_tenant->mobile = $mobile;
      $insert_tenant->password = $password;
      $insert_tenant->user_type_id = $user_type_ten;
      $insert_tenant->user_status_id = $user_status_id;
      $insert_tenant->save();
    }
  }
  //If registerd user
  else if($user_type_id == 2)
  {
    $email = $request['user_email'];
    $password = $request['user_password'];
    $emailCheck = User::where('email', $email)->where('user_type_id', $user_type_ownr)->where('user_status_id',$user_status_v)->first();
    if(!$emailCheck)
    {
      return response()->json([
        "rc"=>"4",
        "rd"=>"Email does not exists"
      ]);
    }
    else {
      if(Auth::attempt(['email'=>$email,'user_type_id'=>$user_type_ownr, 'password'=>$password,'user_status_id'=>$user_status_v]))
      {
        $userinfo = Auth::user();
        $user_id = $userinfo->user_id;
      }
      else {
        return response()->json([
          "rc"=>"5",
          "rd"=>"Password does not matches"
        ]);
      }

  }
}
  else
  {
    return response()->json([
      "rc"=>"6",
      "rd"=>"Something went wrong !"
    ]);
  }
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


  }
  catch(\Exception $e)
  {
    DB::rollback();
    echo $e->getMessage();
  }

}
//Insert Property
public function getCities(Request $request)
{
  $state_id = $request['inputState'];
  $ts_cities = TsCity::where('state_id', $state_id)->groupBy('name')->distinct()->get();
  if(count($ts_cities) > 0)
  {
    return response()->json([
      "rc"=>"1",
      "rd"=> $ts_cities
    ]);
  }
  else
  {
    return response()->json([
      "rc"=>"2",
      "rd"=> "No data availble"
    ]);
  }
}
//End of file
}
