@if(isset($data) && !empty($data))
<!doctype html>
<html lang="en">
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Mozitoo Invoice</title>
    <style>
     .float-left
     {
         float: left;
     }     
     .float-right
     {
         float: right;
     }     
    .rent-items > tbody > tr > .no-line {
        border-top: none;
    }
    
    .rent-items > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .rent-items > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    .p-2
    {
        padding: 2px;
    }
    .upper-table td, th {
        padding: 3px;
    }
    </style>
  </head>
  <body>
    <div class="invoice-logo-section">
        <div class="logo-image">
            <img src="{{ URL::to('src/images/logos/logo3.png')}}" alt="Mozitoo Logo" height="80" width="100"> 
        </div>

    </div>
<!--Top Heading -->
<div class="top-section">
    <div class="text-center">
        <p class="">@if(isset($data['invoice_id']) && !empty($data['invoice_id']))Invoice {{$data['invoice_id']}} @else Not Availble @endif</p>
    </div>
    <div class="text-center">      
        <p class="">@if(isset($data['for_month']) && !empty($data['for_month'])){{$data['for_month']}} @else Not Availble @endif</p>
    </div>   
</div>
<!--Top Heading ends-->
<!--Invoice to Section-->
<div class="invoice-to-section">
    <div class="p-2">Invoice To:-</div>
    <div class="clearfix">
        <div class="float-left">
        @if(isset($data['tenant_details']) && !empty($data['tenant_details']))
            <div class="p-2">
                <strong>Name :</strong>
                @if($data['tenant_details']['name'])     
                {{ucwords($data['tenant_details']['name'])}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Email :</strong>
                @if($data['tenant_details']['email'])     
                {{$data['tenant_details']['email']}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Mobile :</strong>
                @if($data['tenant_details']['mobile'])     
                {{$data['tenant_details']['mobile']}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Address :</strong>
                @if($data['tenant_details']->tsTenantOtherInfo)   
                {{$data['tenant_details']->tsTenantOtherInfo->address_line_1}}, {{$data['tenant_details']->tsTenantOtherInfo->address_line_2}},<br>
                {{$data['tenant_details']->tsTenantOtherInfo->city}}, {{$data['tenant_details']->tsTenantOtherInfo->state}}
                @else
                Not Availble
                @endif
            </div>
        @else 
        <div class="p-2">Not Availble</div>@endif
        </div>
        <div class="float-right">
            <table class="upper-table" style="width:50%;background-color: azure; padding:10px;">
                <tbody>
                    <tr>
                        <td>Invoice Date</td>
                        <td style="background-color: aquamarine;">PLEASE PAY</td>
                        <td>DUE DATE</td>
                    </tr>
                    <tr>
                    <td>
                        @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                        {{$data['invoice_data']['created_at']->format('d-m-Y')}}
                        @else
                        Not Availble
                        @endif
                    </td>
                    <td style="background-color: aquamarine;">
                        @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                        {{$data['invoice_data']['total_amount']}}
                        @else
                        Not Availble
                        @endif
                    
                    </td>
                    <td>
                        @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                        @php 
                        $f_date=date_create($data['invoice_data']['due_date']);           
                        echo date_format($f_date,"d-m-Y");
                        @endphp
                        @else
                        Not Availble
                        @endif
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Invoice to Section ends-->
<!--Invoice Items -->
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Invoice summary</strong></h3>
    </div>
<div class="invoice-item-section panel-body">
<table class="table rent-items table-condensed">
    <thead>
        <tr>
            <th>Sl.</th>
            <th>Account Head</th>
            <th>Amount (Rs.)</th>
            <th style="width:138px;">NET AMOUNT (Rs.)</th>
        </tr>
    </thead>
    @if(isset($data['invoice_item_data']) && !empty($data['invoice_item_data']) && isset($data['invoice_data']) && !empty($data['invoice_data']))
    <tbody>
        @php 
        $i = 0
        @endphp
        @foreach ($data['invoice_item_data'] as $item)
        @php
        $i++
        @endphp
        <tr>
            <td>{{$i}}</td>
            <td>@if($item->item_type_id && $item->msItemTypeFun){{$item->msItemTypeFun->item_type }}@else Other @endif</td>
            <td class="text-left">@if($item->amount){{$item->amount }}@else 00 @endif</td>
            <td class="text-right">
                @if($item->total)
                    @if($item->item_type_id == 3)
                    - {{$item->total }}
                    @else
                    {{$item->total }}
                    @endif
                @else 000 @endif</td>
        </tr>
        @endforeach
        <tr>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line text-left"><strong>Subtotal (Rs.)</strong></td>
            <td class="thick-line text-right">
                @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                @if(isset($data['invoice_data']['total_amount']))
                {{$data['invoice_data']['total_amount']}}
                @endif
                @else
                000
                @endif
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>TDS (Rs.)</strong></td>
            <td class="no-line text-right">
                @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                @if(isset($data['invoice_data']['tds']))
                {{$data['invoice_data']['tds']}}
                @endif
                @else
                000
                @endif
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>GST (Rs.)</strong></td>
            <td class="no-line text-right">
                @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                @if(isset($data['invoice_data']['gst']))
                {{$data['invoice_data']['gst']}}
                @endif
                @else
                000
                @endif
            </td>
        </tr>
        <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-left"><strong>Payable (Rs.)</strong></td>
            <td class="no-line text-right">
                @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
                @if(isset($data['invoice_data']['payable_amount']))
                {{$data['invoice_data']['payable_amount']}}
                @endif
                @else
                000
                @endif
            </td>
        </tr>
    </tbody>
    @endif
</table>
</div>
</div>
<!--Invoice Items ends-->
<!--Invoice from Section-->
<div class="invoice-from-section">
    <div class="p-2">Invoice From :-</div>
    <div class="clearfix">
        <div class="float-left" style="width:50%;">
            @if(isset($data['owner_details']) && !empty($data['owner_details']))
            <div class="p-2">
                <strong>Name :</strong>
                @if($data['owner_details']['name'])     
                {{ucwords($data['owner_details']['name'])}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Email :</strong>
                @if($data['owner_details']['email'])     
                {{$data['owner_details']['email']}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Mobile :</strong>
                @if($data['owner_details']['mobile'])     
                {{$data['owner_details']['mobile']}}
                @else
                Not Availble
                @endif
            </div>
            <div class="p-2">
                <strong>Address :</strong>
                @if($data['owner_details']->tsOwnerOtherInfo)   
                {{$data['owner_details']->tsOwnerOtherInfo->address_line_1}}, {{$data['owner_details']->tsOwnerOtherInfo->address_line_2}},<br>
                {{$data['owner_details']->tsOwnerOtherInfo->city}}, {{$data['owner_details']->tsOwnerOtherInfo->state}}
                @else
                Not Availble
                @endif
            </div>
        @else 
        <div class="p-2">Not Availble</div>@endif
        </div>
        <div class="float-right">
            @if(isset($data['invoice_data']) && !empty($data['invoice_data']))
            @if(isset($data['invoice_data']['invoice_status_id']) && $data['invoice_data']['invoice_status_id'] == 3)
            @if($data['invoice_data']['payment_transaction_id'])
            <div class="p-2"><strong>Transaction ID : </strong>{{$data['invoice_data']['payment_transaction_id']}}</div>
            <div class="p-2"><strong>Date : </strong>{{$data['invoice_data']['updated_at']->format('d-M-Y h:i A')}}</div>
            @endif
                <div class="paid-invoice-image" style="margin-right:40px;">
                    <img src="{{ URL::to('src/images/paid.jpg')}}" alt="Paid Invoice Image" height="150" width="200"> 
                </div>

            @endif
            @endif
        </div>
    </div>
</div>
<!--Invoice from Section ends-->
  </body>
</html>
@endif