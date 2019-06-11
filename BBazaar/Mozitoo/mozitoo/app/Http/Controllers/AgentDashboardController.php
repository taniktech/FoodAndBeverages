<?php

namespace App\Http\Controllers;
use App\Http\Middleware\AgentMiddleware;
use Illuminate\Http\Request;
use App\TsSubmittedProperty;
use App\TsTagPropertyRequest;
use App\MsPropertyAmenty;
use App\TsAgentOtherInfo;
use App\TsTaggedProperty;
use App\TsEditedSubmittedProperty;
use App\TsServiceRequest;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AgentDashboardController extends Controller
{

    //Get Agent Dashboard
    public function getAgentDashboard()
    {
      $tsServiceRequestCheck = false;
      $tsTenantTaggedCount = 0;
      $tsTenantTaggedCheck = false;
      $tsPropertiesCountCheck = false;
      $otherAgentData = false;
      $tenantPropCount = false;
      $tsServiceRequest = 0;
      $tsPropertiesSubmittedPending = 0;
      $tsPropertiesSubmittedPendingCheck = false;
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $tenantUserIDCount = 0;
      $prop_status_id = 1;
      $tagged_prop_status_id = 1;
      $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
      $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();
      $tsPropertiesCount = count($tsPropertiesTagged);
      if($tsPropertiesCount > 0)
      {
        $tsPropertiesCountCheck = true;
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->count();
        if($tsServiceRequestCount > 0)
        {
          $tsServiceRequest = $tsServiceRequestCount;
          $tsServiceRequestCheck = true;
        }
        $tsTenantTaggedCount = TsTaggedProperty::whereIn('prop_id', $tsPropertiesTagged)->count();
        if($tsTenantTaggedCount > 0)
        {
          $tsTenantTagged = TsTaggedProperty::whereIn('prop_id', $tsPropertiesTagged)->get();
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


      }
      $tsPropertiesAssignedFlag = false;
      $tsPropertiesAssignedCount = TsTaggedProperty::where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->count();
      if($tsPropertiesAssignedCount > 0)
      {
        $tsPropertiesAssignedFlag = true;
      }

      $prop_status_id_pending = 0;

      $tsPropertiesSubmittedPending = TsSubmittedProperty::where('user_id', $user_id)->where('prop_status_id',$prop_status_id_pending)->count();
      if($tsPropertiesSubmittedPending > 0)
      {
        $tsPropertiesSubmittedPendingCheck = true;
      }
      $otherInfoCheck = TsAgentOtherInfo::where('user_id', $user_id)->first();
      if($otherInfoCheck)
      {
        $otherAgentData = true;
      }

      return view('agent',['agent'=>Auth::user(),
      'tsPropertiesCountCheck'=>$tsPropertiesCountCheck,'tsPropertiesCount'=>$tsPropertiesCount,
      "tsServiceRequestCheck"=>$tsServiceRequestCheck,"tsServiceRequest"=>$tsServiceRequest,
      'otherAgentData'=>$otherAgentData, 'otherInfoCheck'=>$otherInfoCheck,
      'tenantPropCount'=>$tenantPropCount,'tenantUserIDCount'=>$tenantUserIDCount,
      'pendingPropCountCheck'=>$tsPropertiesSubmittedPendingCheck,'pendingPropCount'=>$tsPropertiesSubmittedPending,
      'tsPropertiesAssignedFlag'=>$tsPropertiesAssignedFlag,'tsPropertiesAssignedCount'=>$tsPropertiesAssignedCount]);

    }
    //Update profile

    public function getUpdateAgentProfile(Request $request)
    {
        $agentName = $request['agentName'];
        $agentEmail = $request['agentEmail'];
        $agentMobile = $request['agentMobile'];
        $agentRera = $request['agentRera'];
        $agentCompany = $request['agentCompany'];
        $agentAdhar = $request['agentAdhar'];
        $agentAddOne = $request['agentAddOne'];
        $agentAddTwo = $request['agentAddTwo'];
        $agentCity = $request['agentCity'];
        $agentState = $request['agentState'];
        $agentPincode = $request['agentPincode'];
        $agentAbout = $request['agentAbout'];
        $agentGoogleID = $request['agentGoogleID'];
        $agentTwitterID = $request['agentTwitterID'];
        $agentFacebookID = $request['agentFacebookID'];
        $agentLinkedinID = $request['agentLinkedinID'];
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $user_type_id = 4;
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

          $userCheck->name = $agentName;
          $userCheck->user_info = $agentAbout;
          if($userCheck->update())
          {

            $otherInfoCheck = TsAgentOtherInfo::where('user_id', $user_id)->first();
            if($otherInfoCheck)
            {
              $otherInfoCheck->rera_id = $agentRera;
              $otherInfoCheck->company_name = $agentCompany;
              $otherInfoCheck->adhar_id = $agentAdhar;
              $otherInfoCheck->address_line_1 = $agentAddOne;
              $otherInfoCheck->address_line_2 = $agentAddTwo;
              $otherInfoCheck->city = $agentCity;
              $otherInfoCheck->state = $agentState;
              $otherInfoCheck->pincode = $agentPincode;
              $otherInfoCheck->google_plus_id = $agentGoogleID;
              $otherInfoCheck->twitter_id = $agentTwitterID;
              $otherInfoCheck->facebook_id = $agentFacebookID;
              $otherInfoCheck->linkedin_id = $agentLinkedinID;
              if($otherInfoCheck->update())
              {
                $file = $request->file('agent_pic');
                $filename =$user_id.'.jpg';
                if($file)
                {
                  Storage::disk('agent_uploads')->put($filename, File::get($file));
                }
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

              $newAgentInfo = new TsAgentOtherInfo();
              $newAgentInfo->user_id = $user_id;
              $newAgentInfo->rera_id = $agentRera;
              $newAgentInfo->company_name = $agentCompany;
              $newAgentInfo->adhar_id = $agentAdhar;
              $newAgentInfo->address_line_1 = $agentAddOne;
              $newAgentInfo->address_line_2 = $agentAddTwo;
              $newAgentInfo->city = $agentCity;
              $newAgentInfo->state = $agentState;
              $newAgentInfo->pincode = $agentPincode;
              $newAgentInfo->google_plus_id = $agentGoogleID;
              $newAgentInfo->twitter_id = $agentTwitterID;
              $newAgentInfo->facebook_id = $agentFacebookID;
              $newAgentInfo->linkedin_id = $agentLinkedinID;
              if($newAgentInfo->save())
              {

                $file = $request->file('agent_pic');
                $filename =$user_id.'.jpg';
                if($file)
                {
                  Storage::disk('agent_uploads')->put($filename, File::get($file));
                }
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

    //Get Property Image
    public function getAgentImage($filename)
    {
      $file = Storage::disk('agent_uploads')->get($filename);
      return new Response($file, 200);
    }

    //Get all property
    public function getAllProperty()
    {
      $tsServiceRequestCheck = false;
      $tsServiceRequest = 0;
      $prop_status_id = 1;
      $data = false;
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $tagged_prop_status_id = 1;
      $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
      $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();

      $tsPropertiesCount = count($tsPropertiesTagged);
      if($tsPropertiesCount > 0)
      {
      $tsServiceRequest = $tsPropertiesCount;
      $tsServiceRequestCheck = true;
      $tsPropertiesAll = TsSubmittedProperty::whereIn('prop_id', $tsPropertiesTagged)->get();
      $data = true;
      return view('agentproperties', ['agent'=>Auth::user(),'data'=>$data, 'allProperties'=>$tsPropertiesAll, "tsServiceRequestCheck"=>$tsServiceRequestCheck,"tsServiceRequest"=>$tsServiceRequest]);

      }

      return view('agentproperties', ['agent'=>Auth::user(),'data'=>$data, "tsServiceRequestCheck"=>$tsServiceRequestCheck,"tsServiceRequest"=>$tsServiceRequest]);
    }
    //Get Submit form
    public function getSubmitForm()
    {
      $tsServiceRequestCheck = false;
      $tsServiceRequest = 0;
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;

      $prop_status_id = 1;
      $tagged_prop_status_id = 1;
      $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
      $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();
      $tsPropertiesCount = count($tsPropertiesTagged);
      if($tsPropertiesCount > 0)
      {
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->count();
        if($tsServiceRequestCount > 0)
        {
          $tsServiceRequest = $tsServiceRequestCount;
          $tsServiceRequestCheck = true;
        }

      }
      $msPropertyAmenty = MsPropertyAmenty::all();
      return view('agentsubmitform',
      [
      'propertyAmenty'=>true,'msPropertyAmenties'=>$msPropertyAmenty,'agent'=>Auth::user(),
      "tsServiceRequestCheck"=>$tsServiceRequestCheck,"tsServiceRequest"=>$tsServiceRequest
    ]);

    }

    //Get One property
    public function getOneProperty($prop_id)
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $prop_status_id = 1;
        $oneProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        $taggedOneProperty = TsTaggedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->first();
        $tsServiceRequestCheck = false;
        $tsServiceRequest = 0;

        $tagged_prop_status_id = 1;
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();
        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
          $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->count();
          if($tsServiceRequestCount > 0)
          {
            $tsServiceRequest = $tsServiceRequestCount;
            $tsServiceRequestCheck = true;
          }

        }
        if($oneProperty or $taggedOneProperty)
        {

        $onePropertyInfo = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        $amenities = $onePropertyInfo->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();
        return view('oneagentproperty',['agent'=>Auth::user(),'oneProperty'=>$onePropertyInfo,"msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,'msPropertyAmentyAll'=>$msPropertyAmentyAll,
        "tsServiceRequestCheck"=>$tsServiceRequestCheck,"tsServiceRequest"=>$tsServiceRequest]);

        }

        return redirect()->route('agent.property.all');


    }
    //update one property
    public function updateOneProperty(Request $request)
    {
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $prop_id = $request['propertyID'];
      $prop_status_id = 1;
      $oneProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
      $taggedOneProperty = TsTaggedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->first();
      if(!$oneProperty and !$taggedOneProperty)
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
        if(!$propertyAmenties==0)
        {
            $tsEditedSubmittedProperty->prop_amenty_id = $propertyAmenties;
        }
        else {
          $tsEditedSubmittedProperty->prop_amenty_id = 7;
        }

        if($tsEditedSubmittedProperty->save())
        {
          $file = $request->file('propertyPic');
          $filename =$prop_id.'_tmp.jpg';
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

    //Get One property
    public function getDeleteOneProperty($prop_id)
    {
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $prop_id = $prop_id;
      $prop_status_id = 1;
      $oneProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
      if(!$oneProperty)
      {
        return redirect()->route('agent.property.all');
      }
      $oneProperty->delete();
      TsEditedSubmittedProperty::where('prop_id', $prop_id)->delete();
      TsServiceRequest::where('prop_id', $prop_id)->delete();
      TsTaggedProperty::where('prop_id', $prop_id)->delete();
      return redirect()->route('agent.property.all');
    }

      // logout
      public function getLogout()
      {
          Auth::logout();
          return redirect()->route('home');
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

      //Get all service request
      public function getServiceRequests()
      {
        $tsServiceRequestCheck = false;
        $prop_status_id = 1;
        $data = false;
        $tsRequestAll = [];
        $tsRequestNew = 0;
        $tsRequestIntiated = 0;
        $tsRequestComp = 0;
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_prop_status_id = 1;
        $tsServiceRequestCheck = false;
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();

        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
        $data = true;
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->whereIn('service_req_action_id', [1, 2, 3])->count();
        if($tsServiceRequestCount > 0)
        {
            $tsServiceRequestCheck = true;
            $tsRequestAll = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->whereIn('service_req_action_id', [1, 2, 3])->get();
            $tsRequestNew = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 1)->count();
            $tsRequestIntiated = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 2)->count();
            $tsRequestComp = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 3)->count();
        }

        return view('agentservicereq', ['agent'=>Auth::user(),'data'=>$data, 'allRequests'=>$tsRequestAll, "tsServiceRequestCheck"=>$tsServiceRequestCheck, 'tsRequestNew'=>$tsRequestNew, 'tsRequestIntiated'=>$tsRequestIntiated, 'tsRequestComp'=>$tsRequestComp]);

        }

        return view('agentservicereq', ['agent'=>Auth::user(),'data'=>$data, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);
      }
      //New Service Request
      public function getNewServiceRequests()
      {
        $tsServiceRequestCheck = false;
        $prop_status_id = 1;
        $data = false;
        $tsRequestAll = [];
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_prop_status_id = 1;
        $tsServiceRequestCheck = false;
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();

        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
        $data = true;
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 1)->count();
        if($tsServiceRequestCount > 0)
        {
            $tsServiceRequestCheck = true;
            $tsRequestAll = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 1)->get();
        }

        return view('agentnewserreq', ['agent'=>Auth::user(),'data'=>$data, 'allRequests'=>$tsRequestAll, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);

        }

        return view('agentnewserreq', ['agent'=>Auth::user(),'data'=>$data, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);
      }
      //Ongoing Service Request
      public function getOnServiceRequests()
      {
        $tsServiceRequestCheck = false;
        $prop_status_id = 1;
        $data = false;
        $tsRequestAll = [];
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_prop_status_id = 1;
        $tsServiceRequestCheck = false;
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();

        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
        $data = true;
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 2)->count();
        if($tsServiceRequestCount > 0)
        {
            $tsServiceRequestCheck = true;
            $tsRequestAll = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 2)->get();
        }

        return view('agentonserreq', ['agent'=>Auth::user(),'data'=>$data, 'allRequests'=>$tsRequestAll, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);

        }

        return view('agentonserreq', ['agent'=>Auth::user(),'data'=>$data, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);
      }
      //Completed Service Request
      public function getCompServiceRequests()
      {
        $tsServiceRequestCheck = false;
        $prop_status_id = 1;
        $data = false;
        $tsRequestAll = [];
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_prop_status_id = 1;
        $tsServiceRequestCheck = false;
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();

        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
        $data = true;
        $tsServiceRequestCount = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 3)->count();
        if($tsServiceRequestCount > 0)
        {
            $tsServiceRequestCheck = true;
            $tsRequestAll = TsServiceRequest::whereIn('prop_id', $tsPropertiesTagged)->where('service_req_action_id', 3)->get();
        }

        return view('agentcompserreq', ['agent'=>Auth::user(),'data'=>$data, 'allRequests'=>$tsRequestAll, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);

        }

        return view('agentcompserreq', ['agent'=>Auth::user(),'data'=>$data, "tsServiceRequestCheck"=>$tsServiceRequestCheck]);
      }
      // Update service request

      public function updateOneAgentSerReq(Request $request)
      {

        $ts_service_req_id = $request['propID'];
        $newStatus = $request['newStatus'];
        $tsRequestCheck = TsServiceRequest::where('ts_service_req_id', $ts_service_req_id)->first();
        if(!$tsRequestCheck)
        {

          return response()->json([
            "rc"=>"3"
          ],200);
        }
        else {

          $tsRequestStatus = $tsRequestCheck->service_req_action_id;
          if($tsRequestStatus == $newStatus)
          {

            return response()->json([
                    'rc'=>'2',
                    "rd"=>"No Change"
                ],200);
          }
          else {

            $tsRequestCheck->service_req_action_id = $newStatus;
            if($tsRequestCheck->update())
            {
              return response()->json([
                      'rc'=>'1',
                      "rd"=>"Status Updated."
                  ],200);
            }

          }

        }

      }
      //Get basic info of all property
      public function getAgentPropInfo()
      {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tagged_prop_status_id = 1;
        $tsProperties = [];
        $tsPropertiesFlag = false;
        $prop_status_id = 1;
        $tsPropertiesTaggedCount = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->count();
        if($tsPropertiesTaggedCount > 0)
        {
          $tsPropertiesFlag = true;
          $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->get();
          $tsProperties = TsSubmittedProperty::whereIn('prop_id', $tsPropertiesTagged)->where('prop_status_id', $prop_status_id)->get();

        }

        return view('agentassignedprop',['agent'=>Auth::user(), 'tsProperties'=>$tsProperties,'tsPropertiesFlag'=>$tsPropertiesFlag]);

      }
      //Tenats Info
      public  function getAgentTenantInfo()
      {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $tenantUserIDCount = 0;
        $prop_status_id = 1;
        $tagged_prop_status_id = 1;
        $taggedID = [];
        $tenantTaggedId = [];
        $tenantPropCountFlag = false;
        $tsTenantTagged = [];
        $tsPropertiesSubmitted = TsSubmittedProperty::select('prop_id')->where('prop_status_id', $prop_status_id)->where('user_id', $user_id);
        $tsPropertiesTagged = TsTaggedProperty::select('prop_id')->where('user_id', $user_id)->where('tagged_prop_status_id', $tagged_prop_status_id)->union($tsPropertiesSubmitted)->get();
        $tsPropertiesCount = count($tsPropertiesTagged);
        if($tsPropertiesCount > 0)
        {
          $tsTenantTaggedCount = TsTaggedProperty::whereIn('prop_id', $tsPropertiesTagged)->where('tagged_prop_status_id', $tagged_prop_status_id)->count();
          if($tsTenantTaggedCount > 0)
          {
            $tsTenantTagged = TsTaggedProperty::whereIn('prop_id', $tsPropertiesTagged)->where('tagged_prop_status_id', $tagged_prop_status_id)->get();
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
      return view('agenttenants',['agent'=>Auth::user(), 'tenantPropCountFlag'=>$tenantPropCountFlag, 'tenantTaggedId'=>$tsTenantTagged]);
    }
    //Agent Pending properties for approval
    public function  getPendingProperty()
    {
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $prop_status_id = 0;
      $data = false;
      $tsPendingPropertiesCount = TsSubmittedProperty::where('user_id', $user_id)->where('prop_status_id', $prop_status_id)->count();
      if($tsPendingPropertiesCount > 0)
      {
      $tsPendingProperties = TsSubmittedProperty::where('user_id', $user_id)->where('prop_status_id', $prop_status_id)->get();
      $data = true;
      return view('agentpendingprop', ['agent'=>Auth::user(),'data'=>$data, 'pendingProperties'=>$tsPendingProperties]);

      }

      return view('agentpendingprop', ['agent'=>Auth::user(),'data'=>$data]);

    }
    //Get Pending One property
    public function getOnePendingProperty($prop_id)
    {
        $userInfo = Auth::user();
        $user_id = $userInfo->user_id;
        $prop_status_id = 0;
        $onePendingProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        if($onePendingProperty)
        {

        $amenities = $onePendingProperty->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();
        $msPropertyAmentyAll = MsPropertyAmenty::whereNotIn('prop_amenty_id', $amenities)->get();
        return view('agentpendingpropdetail',['agent'=>Auth::user(),'oneProperty'=>$onePendingProperty,"msPropertyAmenties"=>$msPropertyAmenties,'msPropertyAmentyAllCheck'=>true,'msPropertyAmentyAll'=>$msPropertyAmentyAll]);

        }

        return redirect()->route('agent.prop.requests');


    }
    //Update One Pending property approval
    public function getUpdatePendingApprovalProp(Request $request)
    {
      $userInfo = Auth::user();
      $user_id = $userInfo->user_id;
      $prop_id = $request['propertyID'];
      $prop_status_id = 0;
      $tsSubmittedProperty = TsSubmittedProperty::where('user_id', $user_id)->where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
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
        $tsSubmittedProperty->prop_status_id = $prop_status_id;
        $tsSubmittedProperty->user_id = $user_id;
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
    //Get Password view
    public function getPwdView()
    {
    return view('agentchangepwd',['agent'=>Auth::user()]);
    }


}
