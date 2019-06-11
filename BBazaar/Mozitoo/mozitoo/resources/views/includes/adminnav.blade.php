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
                 <a href="{{route('admin')}}">
                     <p>Home</p>
                  </a>
              </li>
                <li>
                   <a href="javascript:void(0)">
                       <p>{{ $admin->name }}</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.logout')}}">
                        <p>Log out</p>
                    </a>
                </li>
                <li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>
