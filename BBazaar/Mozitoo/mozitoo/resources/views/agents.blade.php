@extends('layouts.master1')
@section('agents')
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Our Property Managers</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="{{route('home')}}">home</a></li>
                        <li>Our Property Managers</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
              @foreach($tsAgents as $tsAgent)
                <div class="col-sm-6 col-md-4 col-lg-3 agent">
                    <div class="row m0">
                        <div class="row m0 imageRow">
                          @if (Storage::disk('agent_uploads')->has($tsAgent->user_id.'.jpg'))
                          <img src="{{ route('agent.image', ['filename' => $tsAgent->user_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                          @else
                          <img src="{{ route('agent.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                          @endif
                            <ul class="nav">
                                <li><a @if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)) href="{{$tsAgent->tsAgentOtherInfo->google_plus_id}}" target="_blank" @else href="javascript:void(0)" @endif><i class="fa fa-google-plus"></i></a></li>
                                <li><a @if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)) href="{{$tsAgent->tsAgentOtherInfo->twitter_id}}" target="_blank" @else href="javascript:void(0)" @endif><i class="fa fa-twitter"></i></a></li>
                                <li><a @if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)) href="{{$tsAgent->tsAgentOtherInfo->linkedin_id}}" target="_blank" @else href="javascript:void(0)" @endif><i class="fa fa-linkedin"></i></a></li>
                                <li><a @if(!empty($tsAgent->tsAgentOtherInfo->facebook_id)) href="{{$tsAgent->tsAgentOtherInfo->facebook_id}}" target="_blank" @else href="javascript:void(0)" @endif><i class="fa fa-facebook"></i></a></li>
                            </ul>
                        </div>
                        <div class="row m0 agent_details">
                            <div class="row m0 phoneNumber"><i class="fa fa-phone-square"></i>{{$tsAgent->mobile}}</div>
                            <div class="row m0 inner">
                                <a href="agent-details.html">{{$tsAgent->name}}</a>
                                <span class="phone_trigger">
                                    <i class="fa fa-phone-square"></i>
                                    <i class="fa fa-long-arrow-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> <!--Agent Block-->
              @endforeach
            </div>
            <!-- pagination links-->
            <!-- <nav class="row m0 paginationRow">
                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>
            </nav> -->
              <!-- pagination links ends-->
        </div>
    </section>

    <!--Content Area End-->
    <script>
    var token = '{{Session::token()}}';
    var urlSignIn = '{{route('dosignin')}}';
    var urlSignUp = '{{route('dosignup')}}';
    var urlForgotPwd = '{{route('doforgetpwd')}}';
    </script>
@endsection
