<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#131242;">
        <div class="logo">
            <a href="{{route('home')}}" class="simple-text">
               <img src="{{ URL::to('src/images/logos/logo3.png') }}" alt="Mozitoo.com">
            </a>
        </div>
        <ul class="nav">
            <li @yield('active')>
                <a href="{{route('tenantaccount')}}">
                    <i class="pe-7s-user"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li @yield('active1')>
                <a href="{{route('tenant.propfile')}}">
                    <i class="pe-7s-user"></i>
                    <p>My Profile</p>
                </a>
            </li>
            <li @yield('active2')>
                <a href="{{route('tenant.property.all')}}">
                    <i class="pe-7s-home"></i>
                    <p>My Home</p>
                </a>
            </li>
            <li @yield('active3')>
                    <a href="{{route('tenant.invoices.all')}}">
                        <i class="pe-7s-home"></i>
                        <p>My Invoices</p>
                    </a>
            </li>
            <li @yield('active4')>
                <a href="{{route('tenant.service.req.form')}}">
                    <i class="pe-7s-volume"></i>
                    <p>Raise request</p>
                </a>
            </li>
            <li @yield('active5')>
                <a href="{{route('tenant.service.req.all')}}">
                    <i class="pe-7s-news-paper"></i>
                    <p>My Service Request</p>
                </a>
            </li>
            <li @yield('active6')>
              <a href="{{route('tenant.changepwd')}}">
                  <i class="pe-7s-lock"></i>
                  <p>Change Password</p>
              </a>
            </li>
        </ul>
  </div>
</div>
