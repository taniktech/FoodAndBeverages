<?php

namespace App\Http\Controllers;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;
use App\TsSubmittedProperty;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
      /* Form Search */
      // public function getSearchProperty(Request $request)
      // {
      //   $inputLat = $request['inputLat'];
      //   $inputLng = $request['inputLng'];
      //   $filterdistance = 100;
      //   $prop_status_id = 1;
      //   $propertyCount = false;
      //   $tsSubmittedPropertyCount = TsSubmittedProperty::select(DB::raw("(6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
      //     ->where('prop_status_id', $prop_status_id)
      //     ->having('distance', '<', $filterdistance)
      //     ->get();
      //
      //   $tsSubmittedPropertyCount = count($tsSubmittedPropertyCount);
      //   if($tsSubmittedPropertyCount > 0)
      //   {
      //     $propertyCount = true;
      //     $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
      //       ->where('prop_status_id', $prop_status_id)
      //       ->having('distance', '<', $filterdistance)
      //       ->orderBy('distance', 'asc')
      //       ->get();
      //     if(Auth::check() && Auth::user()->user_type_id == '2')
      //     {
      //     return view('searchpage',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
      //     }
      //     return view('searchpage',['propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
      //   }
      //   if(Auth::check() && Auth::user()->user_type_id == '2')
      //   {
      //   return view('searchpage',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount]);
      //   }
      //   return view('searchpage',['propertyCount'=>$propertyCount]);
      //
      // }
      /*Form Search ends */




      public function getSearchProperty(Request $request, $location)
      {
        if ($request->has(['lat', 'lng'])) {
          // To obtain complete path
          //$uri = $request->path();
          //return urldecode($uri);

          $inputLat = $request->query('lat', '12.9716');
          $inputLng = $request->query('lng', '77.5946');
          $filterdistance = 100;
          $prop_status_id = 1;
          $propertyCount = false;
          $tsSubmittedPropertyCount = TsSubmittedProperty::select(DB::raw("(6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->get();
          $tsSubmittedPropertyCount = count($tsSubmittedPropertyCount);
          if($tsSubmittedPropertyCount > 0)
          {
            $propertyCount = true;
            $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
              ->where('prop_status_id', $prop_status_id)
              ->having('distance', '<', $filterdistance)
              ->orderBy('distance', 'asc')
              ->get();
            if(Auth::check() && Auth::user()->user_type_id == '2')
            {
            return view('searchpage',['tenant'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '3')
            {
                return view('searchpage',['owner'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '4')
            {
                return view('searchpage',['agent'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '1')
            {
                return view('searchpage',['admin'=>Auth::user(),'propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
            }
            return view('searchpage',['propertyCount'=>$propertyCount,'tsSubmittedProperties'=>$tsSubmittedProperty]);
          }
          else {
            if(Auth::check() && Auth::user()->user_type_id == '2')
            {
            return view('searchpage',['tenant'=>Auth::user(),'location'=>$location,'propertyCount'=>$propertyCount,'propertyCount'=>$propertyCount]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '3')
            {
                return view('searchpage',['owner'=>Auth::user(),'location'=>$location,'propertyCount'=>$propertyCount,'propertyCount'=>$propertyCount]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '4')
            {
                return view('searchpage',['agent'=>Auth::user(),'location'=>$location,'propertyCount'=>$propertyCount,'propertyCount'=>$propertyCount]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '1')
            {
                return view('searchpage',['admin'=>Auth::user(),'location'=>$location,'propertyCount'=>$propertyCount,'propertyCount'=>$propertyCount]);
            }
            return view('searchpage',['location'=>$location,'propertyCount'=>$propertyCount,'propertyCount'=>$propertyCount]);
          }

        }

      }
      //Custom Search for bhks
      public function getCustomSearch(Request $request)
      {

        $inputLat = $request->query('lat', '12.9716');
        $inputLng = $request->query('lng', '77.5946');
        $filterdistance = 100;
        $bhkSelected = $request['atypes'];
        $bhkIDs = [];
        $prop_status_id = 1;
        $tsSubmittedProperty = [];
        $tsSubmittedProperty1 = [];
        if(is_array($bhkSelected))
        {

          $bhkIDs = $bhkSelected;
        }
        else {
          $formatBedIDs = explode(",",$bhkSelected);
          $bhkIDs = $formatBedIDs;
        }
        $tsSubmittedPropertyCount = TsSubmittedProperty::where('prop_status_id',$prop_status_id)->whereIn('prop_bed', $bhkIDs)->count();
        if($tsSubmittedPropertyCount > 0)
        {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->whereIn('prop_bed', $bhkIDs)
            ->orderByRaw("field(prop_bed,".implode(',',$bhkIDs).")")
            ->get();
            $tsSubmittedProperty1 = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
              ->where('prop_status_id', $prop_status_id)
              ->having('distance', '<', $filterdistance)
              ->whereNotIn('prop_bed', $bhkIDs)
              ->get();
        }
        else {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->orderBy('distance', 'asc')
            ->get();
        }


        $returnHTML = view('renderSearch',["tsSubmittedProperties"=>$tsSubmittedProperty,"tsSubmittedProperties1"=>$tsSubmittedProperty1 ])->render();// or method that you prefere to return data + RENDER is the key here


        return response()->json( array('success' => true, 'html'=>$returnHTML) );

      }
      //Custom Search for prefered types
      public function getCustomSearch1(Request $request)
      {

        $inputLat = $request->query('lat', '12.9716');
        $inputLng = $request->query('lng', '77.5946');
        $filterdistance = 100;
        $tpSelected = $request['ptypes'];
        $bhkSelected = $request['atypes'];
        $bhkIDs = [];
        $tpIDs = [];
        $prop_status_id = 1;
        $tsSubmittedProperty = [];
        $tsSubmittedProperty1 = [];
        if(is_array($tpSelected))
        {
          $tpIDs = $tpSelected;
        }
        else {
          $formatTpIDs = explode(",",$tpSelected);
          $tpIDs = $formatTpIDs;
        }
        if(is_array($bhkSelected))
        {

          $bhkIDs = $bhkSelected;
        }
        else {
          $formatBedIDs = explode(",",$bhkSelected);
          $bhkIDs = $formatBedIDs;
        }
        $tsSubmittedPropertyCount = TsSubmittedProperty::where('prop_status_id',$prop_status_id)->whereIn('tenant_prefrences_id', $tpIDs)->count();
        if($tsSubmittedPropertyCount > 0)
        {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->whereIn('tenant_prefrences_id', $tpIDs)
            ->orderByRaw("field(tenant_prefrences_id,".implode(',',$tpIDs).")")
            ->get();
            $tsSubmittedProperty1 = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
              ->where('prop_status_id', $prop_status_id)
              ->having('distance', '<', $filterdistance)
              ->whereNotIn('tenant_prefrences_id', $tpIDs)
              ->get();
        }
        else {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->orderBy('distance', 'asc')
            ->get();
        }


        $returnHTML = view('renderSearch',["tsSubmittedProperties"=>$tsSubmittedProperty,"tsSubmittedProperties1"=>$tsSubmittedProperty1 ])->render();// or method that you prefere to return data + RENDER is the key here


        return response()->json( array('success' => true, 'html'=>$returnHTML) );

      }
      //Custom Search for furnishing types
      public function getCustomSearch2(Request $request)
      {

        $inputLat = $request->query('lat', '12.9716');
        $inputLng = $request->query('lng', '77.5946');
        $filterdistance = 100;
        $tpSelected = $request['ptypes'];
        $bhkSelected = $request['atypes'];
        $ftSelected = $request['ftypes'];
        $bhkIDs = [];
        $tpIDs = [];
        $ftIDs = [];
        $prop_status_id = 1;
        $tsSubmittedProperty = [];
        $tsSubmittedProperty1 = [];
        if(is_array($tpSelected))
        {
          $tpIDs = $tpSelected;
        }
        else {
          $formatTpIDs = explode(",",$tpSelected);
          $tpIDs = $formatTpIDs;
        }
        if(is_array($bhkSelected))
        {

          $bhkIDs = $bhkSelected;
        }
        else {
          $formatBedIDs = explode(",",$bhkSelected);
          $bhkIDs = $formatBedIDs;
        }
        if(is_array($ftSelected))
        {

          $ftIDs = $ftSelected;
        }
        else {
          $formatFTIDs = explode(",",$ftSelected);
          $ftIDs = $formatFTIDs;
        }

        $tsSubmittedPropertyCount = TsSubmittedProperty::where('prop_status_id',$prop_status_id)->whereIn('prop_furnish_status_id', $ftIDs)->count();
        if($tsSubmittedPropertyCount > 0)
        {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->whereIn('prop_furnish_status_id', $ftIDs)
            ->orderByRaw("field(prop_furnish_status_id,".implode(',',$ftIDs).")")
            ->get();
            $tsSubmittedProperty1 = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
              ->where('prop_status_id', $prop_status_id)
              ->having('distance', '<', $filterdistance)
              ->whereNotIn('prop_furnish_status_id', $ftIDs)
              ->get();
        }
        else {
          $tsSubmittedProperty = TsSubmittedProperty::select(DB::raw("*, (6371 * 2 *ASIN(SQRT( POWER(SIN(($inputLat - prop_lat)*pi()/180/2),2) +COS($inputLat*pi()/180 )*COS(prop_lat*pi()/180) *POWER(SIN(($inputLng-prop_lng)*pi()/180/2),2)))) AS distance"))
            ->where('prop_status_id', $prop_status_id)
            ->having('distance', '<', $filterdistance)
            ->orderBy('distance', 'asc')
            ->get();
        }


        $returnHTML = view('renderSearch',["tsSubmittedProperties"=>$tsSubmittedProperty,"tsSubmittedProperties1"=>$tsSubmittedProperty1 ])->render();// or method that you prefere to return data + RENDER is the key here


        return response()->json( array('success' => true, 'html'=>$returnHTML) );

      }
      //Query string
      public function getSearchPropertys(Request $request)
      {
        $uri = $request->fullUrl();

        return $uri;

      }





}
