<!-- List Search -->
<div id="customSearch">
		@foreach($tsSubmittedProperties as $tsSubmittedProperty)
    <div class="info_content row">
        <div class="col-sm-6 p0 imageRow">
					@if (Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg'))
						<img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
					@else
					<img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
					@endif
        </div>
        <div class="col-sm-6 p0 description">
            <div class="row m0 priceRow">
							 <div class="saleTag fleft">{{$tsSubmittedProperty->furnishFUn->prop_furnish_status}}</div>
                <div class="price fleft">Rs. {{$tsSubmittedProperty->prop_morp}}</div>
            </div>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="location_link"><h4 class="location">{{$tsSubmittedProperty->prop_locality}}</h4></a>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty->prop_area}} Sq Ft</a>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bed}} bedroom</a>
        </div>
    </div>
		<br>
		@endforeach

    @if(!empty($tsSubmittedProperties1))
    @foreach($tsSubmittedProperties1 as $tsSubmittedProperty1)
    <div class="info_content row">
        <div class="col-sm-6 p0 imageRow">
          @if (Storage::disk('public_uploads')->has($tsSubmittedProperty1->prop_id.'.jpg'))
            <img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty1->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
          @else
          <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
          @endif
        </div>
        <div class="col-sm-6 p0 description">
            <div class="row m0 priceRow">
               <div class="saleTag fleft">{{$tsSubmittedProperty1->furnishFUn->prop_furnish_status}}</div>
                <div class="price fleft">Rs. {{$tsSubmittedProperty1->prop_morp}}</div>
            </div>
            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty1->prop_id])}}" class="location_link"><h4 class="location">{{$tsSubmittedProperty1->prop_locality}}</h4></a>
            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty1->prop_id])}}" class="specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty1->prop_area}} Sq Ft</a>
            <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty1->prop_id])}}" class="specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty1->prop_bed}} bedroom</a>
        </div>
    </div>
    <br>
    @endforeach
    @endif
</div>
