@extends('layouts.tenant')
@section('tenant')
@section('active')
    class="active"
@endsection
@include('includes.tenantheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Tenant Dashboard
  @endsection
@include('includes.tenantnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <!--Payment Options Modal -->
        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="payment-option-modal" data-backdrop="false" data-keyboard="false" aria-labelledby="payment-option-modal" style="background-color: rgba(0, 0, 0, .5);">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div style="" class="modal-header">
                      <h4 class="modal-title">Select a Payment Method</h4>
                  </div>
                  <form id="payment-options-form">
                  <div class="modal-body">  
                        <p class="title text-info"><b><u>Payment Gateway 1</u></b></p>
                        <label>
                            <input type="radio" name="pay_option" value="1"> Pay by Net Banking (Zero Convenience charges)
                        </label><br/>
                        <label>
                            <input type="radio" name="pay_option" value="2"> Pay by Debit Card (1 % charges)  
                        </label><br/>
                        <label>
                            <input type="radio" name="pay_option" value="3"> Pay by Credit Card, Wallets and EMI (1.5 % charges)  
                        </label><br/>
                        <p class="title text-info"><b><u>Payment Gateway 2</u></b></p>
                        <label>
                            <input type="radio" name="pay_option" value="4"> Payment Gateway 2 
                        </label><br/>
                        <label id="err_pay_options"></label><br/>
                  </div>
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-fill">Pay</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      <!--Payment Options Modal ends-->
      </div>
    </div>
    <div id="divLoading"> 

    </div>
</div>
<script>
var token = '{{Session::token()}}';
var url_payment = '{{route('tenant.go.to.pay')}}';
</script>
@include('includes.adminfooter')
</div>
@endsection
