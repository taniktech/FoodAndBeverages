<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#543011;">
        <div class="logo">
            <a href="{{route('home')}}" class="simple-text">
              <img src="{{ URL::to('src/images/logos/logo3.png') }}" alt="Mozitoo.com">
            </a>
        </div>

        <ul class="nav">
            <li @yield('active')>
                <a href="{{route('ownerdashboard')}}">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
          <li @yield('active1')>
                <a href="{{route('owner.property.all')}}">
                    <i class="pe-7s-check"></i>
                    <p>My Properties</p>
                </a>
            </li>
            <li @yield('active2')>
                <a href="{{route('owner.profile')}}">
                    <i class="pe-7s-check"></i>
                    <p>My Profile</p>
                </a>
            </li>
            <li @yield('active3')>
                    <a href="{{route('owner.invoices.all')}}">
                        <i class="pe-7s-check"></i>
                        <p>All Invoices</p>
                    </a>
            </li>
            <li @yield('active4')>
                <a href="{{route('ownersubmitform')}}">
                    <i class="pe-7s-plus"></i>
                    <p>Add new Property</p>
                </a>
            </li>
            <li @yield('active5')>
                <a href="{{route('owner.service.req.form')}}">
                    <i class="pe-7s-volume"></i>
                    <p>Raise Service Request</p>
                </a>
            </li>
            <li @yield('active6')>
                <a href="{{route('owner.service.req.all')}}">
                    <i class="pe-7s-news-paper"></i>
                    <p>My Service Requests</p>
                </a>
            </li>
            <li @yield('active7')>
                <a href="{{route('owner.changepwd')}}">
                    <i class="pe-7s-lock"></i>
                    <p>Change Password</p>
                </a>
            </li>
        </ul>
  </div>
</div>
