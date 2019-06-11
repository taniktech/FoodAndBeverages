<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)">@yield('DashboardSiteMap')</a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
              <li>
                 <a href="{{route('ownerdashboard')}}">
                     <p>Home</p>
                  </a>
              </li>
              <li>
                  <a href="{{route('switch.toten.dashboard')}}">Switch To Tenant Dashboard</a>
               </li>
              <li>
                <li>
                   <a href="javascript:void(0)">
                       <p>Hello {{ $owner->name }}</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('owner.logout')}}">
                        <p>Log out</p>
                    </a>
                </li>
    <li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>
<!--Switch to tenant modal-->
{{-- <div class="modal fade" id="switch-to-tenant" role="dialog" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Verify Your Password</h4>
            </div>
            <div class="modal-body">
                <form id="tenant-dash-switch-form">
                <div class="form-group">
                    <label for="input-password">Password</label>
                    <input type="password" name="input_password" class="form-control" id="input-password" placeholder="Your Password">
                </div>
                <button type="submit" class="btn btn-info btn-fill">Switch</button>
                </form>
            </div>
            </div>
        </div>
    </div> --}}
<!--Switch to tenant modal ends-->
<script>
var token = '{{Session::token()}}';
var url_switch_owner_dash = '{{route('switch.toten.dashboard')}}';
var url_tenant_dashboard = '{{route('tenantaccount')}}';
</script>