@extends('layouts.master1')
@section('property_grid')
<!--Content Area Begin-->
    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Listing</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="index.html">home</a></li>
                        <li>listing</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
      @if($propertyCount == true)
        <div class="container">
            <div class="row">
              @foreach($tsSubmittedProperties as $tsSubmittedProperty)
                <div class="col-sm-4 listing_grid">
                    <div class="info_content row">
                        <div class="row m0 imageRow">
                          @if (Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg'))
                            <img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                          @else
                          <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                          @endif
                            <div class="saleTag">{{$tsSubmittedProperty->furnishFUn->prop_furnish_status}}</div>
                        </div>
                        <div class="row m0 description">
                            <div class="row m0 priceRow">
                                <div class="price fleft">Rs. {{$tsSubmittedProperty->prop_morp}}</div>
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="location_link"><h4 class="location">{{$tsSubmittedProperty->prop_locality}}</h4></a>
                            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty->prop_area}} Sq Ft</a>
                            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bed}} bedroom</a>
                        </div>
                    </div>
                </div> <!--Grid Listing-->
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
        @endif
    </section>

    <!--Content Area End-->
@endsection
