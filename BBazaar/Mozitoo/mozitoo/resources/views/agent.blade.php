@extends('layouts.agent')
@section('agent')
@section('active')
    class="active"
@endsection
@include('includes.agentheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Property Manager Dashboard
  @endsection
@include('includes.agentnav')
<div class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-warning text-center">
                                <i class="pe-7s-home"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Total Property Assigned</p>
                                {{ $tsPropertiesAssignedCount}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tsPropertiesAssignedCount > 0)
                          <a href="{{route('allpropinfo.agent')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-success text-center">
                                <i class="pe-7s-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                              <p>Total Rented Property</p>
                              {{$tenantUserIDCount}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tenantUserIDCount > 0)
                          <a href="{{route('tenatinfo.agent')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-danger text-center">
                                <i class="pe-7s-volume2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Assigned Service Request</p>
                                {{ $tsServiceRequest}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tsServiceRequest > 0)
                          <a href="{{route('agent.servicerequests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-danger text-center">
                                <i class="pe-7s-attention"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Pending Property Approvals</p>
                                {{$pendingPropCount}}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($pendingPropCount > 0)
                          <a href="{{route('agent.prop.requests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="container-fluid">
       <div class="row">
         <div class="col-md-4" id="mobile-property-image">
           <div class="card">
           <div class="image">
             @if (Storage::disk('agent_uploads')->has($agent->user_id.'.jpg'))
               <img src="{{ route('agent.image', ['filename' =>$agent->user_id.'.jpg']) }}" alt="..." class="img-responsive"/>
               @else
               <img src="{{ route('agent.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
               @endif
           </div>
         </div>
         </div>
           <div class="col-md-8">
               <div class="card">
                   <div class="header">
                       <h4 class="title">Personal Information</h4>
                   </div>
                   <div class="content">
                       <form id="agentProfileForm">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentName">Name</label>
                                       <input type="text" class="form-control" name="agentName" id="agentName" placeholder="Your Name" value="{!! $agent->name !!}">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentEmail">Email address</label>
                                       <input type="email" class="form-control" name="agentEmail" id="agentEmail" disabled placeholder="Your Email" value="{!! $agent->email !!}">
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentMobile">Mobile No.</label>
                                       <input type="text" class="form-control" name="agentMobile" id="agentMobile" disabled placeholder="Mobile No." value="{!! $agent->mobile !!}">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentRera">Rera ID</label>
                                       <input type="text" class="form-control" id="agentRera" name="agentRera" placeholder="Your Rera ID" value="@if($otherAgentData){!! $otherInfoCheck->rera_id !!}@endif">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentCompany">Company Name</label>
                                       <input type="text" id="agentCompany" name="agentCompany" class="form-control" placeholder="Firm Name" value="@if($otherAgentData){!! $otherInfoCheck->company_name !!}@endif">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentAdhar">Adhar ID</label>
                                       <input type="text" class="form-control" name="agentAdhar" id="agentAdhar" placeholder="Your Adhar ID" value="@if($otherAgentData){!! $otherInfoCheck->adhar_id !!}@endif">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentAddOne">Address Line 1</label>
                                       <input type="text" class="form-control" id="agentAddOne" name="agentAddOne" placeholder="Address line 1" value="@if($otherAgentData){!! $otherInfoCheck->address_line_1 !!}@endif">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentAddTwo">Address Line 2</label>
                                       <input type="text" class="form-control" id="agentAddTwo" name="agentAddTwo" placeholder="Address line 2" value="@if($otherAgentData){!! $otherInfoCheck->address_line_2 !!}@endif">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="agentCity">City</label>
                                       <input type="text" id="agentCity" name="agentCity" class="form-control" placeholder="City" value="@if($otherAgentData){!! $otherInfoCheck->city !!}@endif">
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="agentState">State</label>
                                       <input type="text" class="form-control" id="agentState" name="agentState" placeholder="State" value="@if($otherAgentData){!! $otherInfoCheck->state !!}@endif">
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="agentPincode">Pincode</label>
                                       <input type="text" class="form-control" id="agentPincode" name="agentPincode" placeholder="Pincode" value="@if($otherAgentData){!! $otherInfoCheck->pincode !!}@endif">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label for="agentAbout">About Me</label>
                                       <textarea rows="5" class="form-control" name="agentAbout" id="agentAbout" placeholder="Here can be your description">{!! $agent->user_info !!}</textarea>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentGoogleID">Google Plus</label>
                                       <input type="text" id="agentGoogleID" name="agentGoogleID" class="form-control" placeholder="http://google.com/yourid" value="@if($otherAgentData){!! $otherInfoCheck->google_plus_id !!}@endif">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="agentTwitterID">Twitter</label>
                                       <input type="text" class="form-control" id="agentTwitterID" name="agentTwitterID" placeholder="http://twitter.com/yourid" value="@if($otherAgentData){!! $otherInfoCheck->twitter_id !!}@endif">
                                   </div>
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agentFacebookID">Facebok</label>
                                        <input type="text" id="agentFacebookID" name="agentFacebookID" class="form-control" placeholder="http://facebook.com/yourid" value="@if($otherAgentData){!! $otherInfoCheck->facebook_id !!}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agentLinkedinID">Linkedin</label>
                                        <input type="text" class="form-control" id="agentLinkedinID" name="agentLinkedinID" placeholder="http://linkedin.com/yourid" value="@if($otherAgentData){!! $otherInfoCheck->linkedin_id !!}@endif">
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label for="agent_pic">Profile Pic</label>
                                       <input id="agent_pic" name="agent_pic" class="file" type="file" data-show-upload="false">
                                   </div>
                               </div>
                           </div>
                           <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                           <div class="clearfix"></div>
                       </form>
                   </div>
               </div>
           </div>
           <div class="col-md-4" id="desktop-property-image">
             <div class="card">
             <div class="image">
               @if (Storage::disk('agent_uploads')->has($agent->user_id.'.jpg'))
                 <img src="{{ route('agent.image', ['filename' =>$agent->user_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                 @else
                 <img src="{{ route('agent.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                 @endif
             </div>
           </div>
           </div>

       </div>
   </div>

</div>
<div class="modal" tabindex="-1" role="dialog" id="success-review-modal" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
  <div class="modal-dialog">
      <div class="modal-content">
          <div style="" class="modal-header">
              <h3 style="text-align:center" class="modal-title"> Profile Updated</h3>
          </div>
          <div class="modal-body">
              <div class="text-center">
                 <i style="font-size: 40px;" class="pe-7s-check animated rotateIn"></i>
                  <p> Profile Successfully Updated</p>
              </div>
          </div>
      <div style="text-align:center" class="modal-footer">
      <button style="" type="button" class="btn btn-primary" class="button button-block" id="reloadSucModal">
        Ok
      </button>
      </div>
    </div>
  </div>
</div><!-- /.modal -->
<script>
var token = '{{Session::token()}}';
var UrlUpdateAgentProfile = '{{route('update.agent.profile')}}';
</script>
@include('includes.adminfooter')
    </div>
@endsection
