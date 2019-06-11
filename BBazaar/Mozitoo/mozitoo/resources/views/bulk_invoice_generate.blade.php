@extends('layouts.admin')
@section('adminpwd')
@section('active5')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Invoices / Generate Bulk Invoice
  @endsection
@include('includes.adminnav')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bulk Rent Invoice</h4>
                                <p class="category">Please Select the required details</p>
                            </div>
                            <form id="gen-bulk-invoice" method="POST">
                            <div class="content">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                            <label for="rent-for-month">Select month</label>
                                                <select class="selectpicker form-control" name="rent_for_month" id="rent-for-month">                                       
                                                    <option value="" class="ignore">Select...</option> 
                                                    @if(isset($month_year_array) && count($month_year_array) == 3)
                                                    @foreach ($month_year_array as $month)
                                                    <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach     
                                                    @endif                                                                                                               
                                                </select>
                                        </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="rent-due-date">Due date</label>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                          <input type="text" placeholder="Date" name="rent_due_date" id="rent-due-date" class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="rent-inv-desc">Description</label>
                                          <textarea rows="1" class="form-control" name="rent_inv_desc" id="rent-inv-desc" placeholder="Description can be optional"></textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="rent-inv-remarks">Remarks</label>
                                            <textarea rows="1" class="form-control" name="rent_inv_remarks" id="rent-inv-remarks" placeholder="Remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                              <div class="text-right">
                              <button type="submit" class="btn btn-info btn-fill">Generate</button>
                              </div>
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divLoading"> 

                </div>
        </div>

<script>
var token = '{{Session::token()}}';
var url_gen_bulk_invoice = '{{route('admin.invoices.genrate.bulk.invoice')}}';
var url_all_invoices = '{{route('admin.invoices.views')}}';
var url_dr_invoices = '{{route('admin.invoices.get.draft')}}';
var home = '{{route('home')}}';
</script>
@include('includes.adminfooter')
    </div>
@endsection
