<?php

namespace App\Http\Controllers;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class ExtraPagesController extends Controller
{
        //Contact Us Page
        public function getContactUs()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('contactus',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('contactus',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('contactus',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('contactus',['admin'=>Auth::user()]);
          }
          return view('contactus');
        }
        //Get Rent management page
        public function getRentMgmt()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('rentmanagement',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('rentmanagement',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('rentmanagement',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('rentmanagement',['admin'=>Auth::user()]);
          }
          return view('rentmanagement');
        }
        //Get Rent Analysis
        public function getRentAnalysis()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('freerentpriceanlys',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('freerentpriceanlys',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('freerentpriceanlys',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('freerentpriceanlys',['admin'=>Auth::user()]);
          }
          return view('freerentpriceanlys');
        }
        //Get Marketing
        public function getMarketing()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('marketingrenting',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('marketingrenting',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('marketingrenting',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('marketingrenting',['admin'=>Auth::user()]);
          }
          return view('marketingrenting');
        }
        //All Blogs
        public function getAllBlogs()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('blogs',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('blogs',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('blogs',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('blogs',['admin'=>Auth::user()]);
          }
          return view('blogs');
        }
        //One Blogs
        public function getOneBlog()
        {
          if(Auth::check() && Auth::user()->user_type_id == '2')
          {
          return view('oneblog',['tenant'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '3')
          {
              return view('oneblog',['owner'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '4')
          {
              return view('oneblog',['agent'=>Auth::user()]);
          }
          if(Auth::check() && Auth::user()->user_type_id == '1')
          {
              return view('oneblog',['admin'=>Auth::user()]);
          }
          return view('oneblog');
        }
        //Contact Us Page
        public function getShopAndEarn()
        {
            if(Auth::check() && Auth::user()->user_type_id == '2')
            {
            return view('shopearn',['tenant'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '3')
            {
                return view('shopearn',['owner'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '4')
            {
                return view('shopearn',['agent'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '1')
            {
                return view('shopearn',['admin'=>Auth::user()]);
            }
            return view('shopearn');
        }
        //Terms of use
        public function getTerms()
        {
            if(Auth::check() && Auth::user()->user_type_id == '2')
            {
            return view('terms_of_use',['tenant'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '3')
            {
                return view('terms_of_use',['owner'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '4')
            {
                return view('terms_of_use',['agent'=>Auth::user()]);
            }
            if(Auth::check() && Auth::user()->user_type_id == '1')
            {
                return view('terms_of_use',['admin'=>Auth::user()]);
            }
            return view('terms_of_use');
        }
}
