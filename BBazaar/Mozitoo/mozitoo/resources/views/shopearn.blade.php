@extends('layouts.master1')
@section('shopearn')
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Shop & Earn</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="{{route('home')}}">home</a></li>
                        <li>Shop And Earn</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="slider" class="row" style="margin-top:70px;">
        <div class="flexslider mainSlider" id="mainSlider">
            <ul class="slides">
                <li>
                    <img src="{{ URL::to('src/images/slides/x1.jpg') }}" alt="">
                    <div class="row m0 captions">
                        <div class="container">
                            <div class="row m0">

                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="{{ URL::to('src/images/slides/x2.jpg') }}" alt="">
                    <div class="row m0 captions">
                        <div class="container">
                            <div class="row m0">

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section> <!--Slider End-->
    <section class="row contentRow">
        <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-4 col-lg-3 agent">
                <div class="row m0">
                    <div class="row m0 imageRow">

                            <a target="_blank" href="https://www.amazon.in?&_encoding=UTF8&tag=mozitoo-21&linkCode=ur2&linkId=c13f7d9b38f386f73c29427e9facc9bc&camp=3638&creative=24630">Go To Amazon Store
                        <img src="{{ URL::to('src/images/slides/x3.jpg') }}" alt="" class="img-responsive"></a>
                    </div>
                </div>
            </div> <!--Agent Block-->
            </div>
        </div>
    </section>

    <!--Content Area End-->
@endsection
