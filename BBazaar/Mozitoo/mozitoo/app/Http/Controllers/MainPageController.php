<?php

namespace App\Http\Controllers;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;
use App\TsSubmittedProperty;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class MainPageController extends Controller
{
      //Global variables

  public function __construct()
  {
    $this->prop_status_p = 1;
    $this->prop_status_v = 2;
    $this->invnt_level_status_p = 1;
    $this->invnt_level_status_v = 2;
    $this->invnt_level_status_a = 3;


  }
    //Get all properties
    public function getMainPage()
    {

      //Global variables
      $prop_status_v = $this->prop_status_v;
      $propertyCount = false;
      $tsSubmittedPropertyCount = TsSubmittedProperty::where('prop_status_id',$prop_status_v)->count();
      if($tsSubmittedPropertyCount > 0)
      {
        $propertyCount = true;
        $tsSubmittedProperty = TsSubmittedProperty::where('prop_status_id',$prop_status_v)->latest()->limit(3)->get();
        if(Auth::check() && Auth::user()->user_type_id == '2')
        {
            return view('welcome',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '3')
        {
            return view('welcome',['owner'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '4')
        {
            return view('welcome',['agent'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }
        if(Auth::check() && Auth::user()->user_type_id == '1')
        {
            return view('welcome',['admin'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
        }

        return view('welcome',['propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '2')
      {
        return view('welcome',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '3')
      {
          return view('welcome',['owner'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '4')
      {
          return view('welcome',['agent'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '1')
      {
          return view('welcome',['admin'=>Auth::user(),'propertyCount'=>$propertyCount]);
      }
        return view('welcome',['propertyCount'=>$propertyCount]);
    }

}
