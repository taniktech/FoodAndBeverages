<?php

namespace App\Http\Controllers;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Http\Request;
use App\User;
use App\TsAgentOtherInfo;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class AgentController extends Controller
{
    //Get all agents
    public function getAgents()
    {
      $user_type_id = 4;
      $user_status_id = 1;
      $agents = User::where('user_type_id', $user_type_id)->where('user_status_id', $user_status_id)->get();
      if(Auth::check() && Auth::user()->user_type_id == '2')
      {
      return view('agents',['tenant'=>Auth::user(),'agents'=>true,'tsAgents'=>$agents]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '3')
      {
          return view('agents',['owner'=>Auth::user(),'agents'=>true,'tsAgents'=>$agents]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '4')
      {
          return view('agents',['agent'=>Auth::user(),'agents'=>true,'tsAgents'=>$agents]);
      }
      if(Auth::check() && Auth::user()->user_type_id == '1')
      {
          return view('agents',['admin'=>Auth::user(),'agents'=>true,'tsAgents'=>$agents]);
      }
      return view('agents',['agents'=>true,'tsAgents'=>$agents]);
    }
}
