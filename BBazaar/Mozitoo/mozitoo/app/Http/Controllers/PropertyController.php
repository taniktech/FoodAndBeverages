<?php

namespace App\Http\Controllers;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;
use App\TsSubmittedProperty;
use App\MsPropertyAmenty;
use App\TsTaggedProperty;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class PropertyController extends Controller
{
    //Get all properties
    public function getProperties()
    {
      $prop_status_id = 1;
      $propertyCount = false;
      $tsSubmittedProperty = [];
      $tsSubmittedPropertyCount = TsSubmittedProperty::where('prop_status_id',$prop_status_id)->count();
      if($tsSubmittedPropertyCount > 0)
      {
        $propertyCount = true;
        $tsSubmittedProperty = TsSubmittedProperty::where('prop_status_id',$prop_status_id)->get();
        if(Auth::check() && Auth::user()->user_type_id == '2')
        {
        return view('property_grid',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '3')
        {
            return view('property_grid',['owner'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '4')
        {
            return view('property_grid',['agent'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '1')
        {
            return view('property_grid',['admin'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        return view('property_grid',['propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '2')
      {
      return view('property_grid',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '3')
      {
          return view('property_grid',['owner'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '4')
      {
          return view('property_grid',['agent'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '1')
      {
          return view('property_grid',['admin'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      return view('property_grid',['propertyCount'=>$propertyCount]);
    }

    //get property details
    public function getPropertyDetails($prop_id)
    {
        $prop_status_id = 1;
        $agentsTagged = [];
        $agentsData = [];
        $ownersPropCheck = false;
        $taggedAgentCheck = false;
        $ownersPropTaggedToAgent = false;
        $tsSubmittedProperty = TsSubmittedProperty::where('prop_id', $prop_id)->where('prop_status_id', $prop_status_id)->first();
        if($tsSubmittedProperty)
        {
          if($tsSubmittedProperty->userFun->userTypeFun->user_type_id !== 4)
          {
            $ownersPropCheck = true;
            $tsTaggedCount = TsTaggedProperty::where('prop_id', $prop_id)->count();
            if($tsTaggedCount > 0)
            {

              $tsTaggedCheckALl = TsTaggedProperty::where('prop_id', $prop_id)->get();
              foreach ($tsTaggedCheckALl as $key)
              {

                if($key->userFun->userTypeFun->user_type_id == 4)
                {
                  $taggedAgentCheck = true;
                  $agentsTagged[] = $key->user_id;
                }

              }
            }

          }
          if($taggedAgentCheck && $ownersPropCheck)
          {
            $user_type_id = 4;
            $user_status_id = 1;
            $agentsData = User::whereIn('user_id', $agentsTagged)->where('user_type_id', $user_type_id)->where('user_status_id', $user_status_id)->get();
          }


        $amenities = $tsSubmittedProperty->prop_amenty_id;
        $amenities = explode(",",$amenities);
        $msPropertyAmenties = MsPropertyAmenty::whereIn('prop_amenty_id', $amenities)->get();

        if(Auth::check() && Auth::user()->user_type_id == '2')
        {
        return view('property_details',['tenant'=>Auth::user(),"property"=>true, 'tsSubmittedProperty'=>$tsSubmittedProperty,"msPropertyAmenties"=>$msPropertyAmenties,"ownersPropCheck"=>$ownersPropCheck,'taggedAgentCheck'=>$taggedAgentCheck, 'agentsData'=>$agentsData]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '3')
        {
            return view('property_details',['owner'=>Auth::user(),"property"=>true, 'tsSubmittedProperty'=>$tsSubmittedProperty,"msPropertyAmenties"=>$msPropertyAmenties,"ownersPropCheck"=>$ownersPropCheck,'taggedAgentCheck'=>$taggedAgentCheck, 'agentsData'=>$agentsData]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '4')
        {
            return view('property_details',['agent'=>Auth::user(),"property"=>true, 'tsSubmittedProperty'=>$tsSubmittedProperty,"msPropertyAmenties"=>$msPropertyAmenties,"ownersPropCheck"=>$ownersPropCheck,'taggedAgentCheck'=>$taggedAgentCheck, 'agentsData'=>$agentsData]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '1')
        {
            return view('property_details',['admin'=>Auth::user(),"property"=>true, 'tsSubmittedProperty'=>$tsSubmittedProperty,"msPropertyAmenties"=>$msPropertyAmenties,"ownersPropCheck"=>$ownersPropCheck,'taggedAgentCheck'=>$taggedAgentCheck, 'agentsData'=>$agentsData]);
        }
        return view('property_details',["property"=>true, 'tsSubmittedProperty'=>$tsSubmittedProperty,"msPropertyAmenties"=>$msPropertyAmenties,"ownersPropCheck"=>$ownersPropCheck,'taggedAgentCheck'=>$taggedAgentCheck, 'agentsData'=>$agentsData]);
        }
        return redirect()->route('properties');

    }

}
