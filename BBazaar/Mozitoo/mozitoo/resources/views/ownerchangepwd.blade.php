@extends('layouts.owner')
@section('ownerpwd')
@section('active7')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / Change Password
  @endsection
@include('includes.ownernav')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Change Password</h4>
                                <p class="category">Please enter your current Password</p>
                            </div>
                            <form id="change-owner-dpwd">
                            <div class="content">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="old_pwd">Current Password</label>
                                          <input class="form-control" name="old_pwd" id="old_pwd" type="password" placeholder="Enter your current password">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="new_pwd">Current Password</label>
                                          <input class="form-control" name="new_pwd" id="new_pwd" type="password" placeholder="Enter new password">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label for="re_pwd">Re-enter Password</label>
                                          <input class="form-control" name="re_pwd" id="re_pwd" type="password" placeholder="Repeat your password">
                                      </div>
                                  </div>
                              </div>
                              <div class="text-right">
                              <button type="submit" id="changeDashPwdBtn" class="btn btn-info btn-fill">Change Password</button>
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
var url_chnage_pwd = '{{route('owner.change.pwd')}}';
var home = '{{route('home')}}';
</script>
@include('includes.adminfooter')
    </div>
@endsection
