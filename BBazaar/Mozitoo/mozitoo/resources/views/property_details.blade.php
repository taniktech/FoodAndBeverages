@extends('layouts.master1')
@section('property_details')
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">{{$tsSubmittedProperty->prop_city}}</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="index.html">home</a></li>
                        <li><a href="listing-list.html">listings</a></li>
                        <li>{{$tsSubmittedProperty->prop_city}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row m0 listing_details">
                        <div class="info_content row m0">
                            <div class="row m0 imageRow">
                              @if (Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg'))
                                <img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                              @else
                              <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                              @endif
                                <div class="saleTag">{{$tsSubmittedProperty->furnishFUn->prop_furnish_status}}</div>
                            </div>
                            <div class="row m0 description">
                                <div class="row m0">
                                    <div class="row m0 priceRow">
                                        <div class="price fleft">Rs. {{$tsSubmittedProperty->prop_morp}}</div>
                                    </div>
                                    <h4 class="location">{{$tsSubmittedProperty->prop_location}}</h4>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty->prop_area}} Sq Ft</a>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bed}} bedroom</a>
                                    <a href="#" class="detail_page_specify_btn specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bath}} bathroom</a>
                                    <p>{{$tsSubmittedProperty->prop_desc}}</p>
                                </div>
                                <div class="row m0 additional_features">
                                    <h4 class="location">Amenities</h4>
                                    @foreach($msPropertyAmenties as $msPropertyAmenty)
                                    <a href="#" class="feature"><i class="fa fa-check-circle"></i>{{$msPropertyAmenty->prop_amenty_name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> <!--Grid Listing-->
                </div>
                <div class="col-sm-4 sidebar">
                  @if($ownersPropCheck == true)
                  @if($taggedAgentCheck == true)
                  @foreach($agentsData as $tsAgent)
                  <div class="row m0 widget listedBy">
                      <h4>Listed by:</h4>
                      <div class="row m0 agent">
                          <div class="row m0">
                              <div class="row m0 imageRow">
                                @if (Storage::disk('agent_uploads')->has($tsAgent->user_id.'.jpg'))
                                <img src="{{ route('agent.image', ['filename' => $tsAgent->user_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                                @else
                                <img src="{{ route('agent.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                                @endif
                                  <ul class="nav">
                                      <li><a href="http://google.com"><i class="fa fa-google-plus"></i></a></li>
                                      <li><a href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                      <li><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i></a></li>
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
                  </div>
                  @endforeach
                  @endif
                  @else
                  <div class="row m0 widget listedBy">
                      <h4>Listed by:</h4>
                      <div class="row m0 agent">
                          <div class="row m0">
                              <div class="row m0 imageRow">
                                @if($tsSubmittedProperty->userFun->userTypeFun->user_type_id == 4)
                                @if (Storage::disk('agent_uploads')->has($tsSubmittedProperty->user_id.'.jpg'))
                                <img src="{{ route('agent.image', ['filename' => $tsSubmittedProperty->user_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                                @else
                                <img src="{{ route('agent.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                                @endif
                                @endif
                                  <ul class="nav">
                                      <li><a href="http://google.com"><i class="fa fa-google-plus"></i></a></li>
                                      <li><a href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                      <li><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                  </ul>
                              </div>
                              <div class="row m0 agent_details">
                                  <div class="row m0 phoneNumber"><i class="fa fa-phone-square"></i>{{$tsSubmittedProperty->userFun->mobile}}</div>
                                  <div class="row m0 inner">
                                      <a href="agent-details.html">{{$tsSubmittedProperty->userFun->name}}</a>
                                      <span class="phone_trigger">
                                          <i class="fa fa-phone-square"></i>
                                          <i class="fa fa-long-arrow-down"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div> <!--Agent Block-->
                  </div>
                  @endif
                </div>
            </div>
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
