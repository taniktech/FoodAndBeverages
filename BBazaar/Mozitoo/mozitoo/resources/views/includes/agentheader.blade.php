<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#173327;">
        <div class="logo">
            <a href="{{route('home')}}" class="simple-text">
            <img src="{{ URL::to('src/images/logos/logo3.png') }}" alt="Mozitoo.com">
            </a>
        </div>

        <ul class="nav">
            <li @yield('active')>
                <a href="{{route('agent')}}">
                  <i class="pe-7s-graph"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            <li @yield('active1')>
                <a href="{{route('agent.property.all')}}">
                    <i class="pe-7s-check"></i>
                    <p>My Properties</p>
                </a>
            </li>
            <li @yield('active2')>
                <a href="{{route('agentsubmitform')}}">
                    <i class="pe-7s-plus"></i>
                    <p>Add new Property</p>
                </a>
            </li>
            <li @yield('active3')>
                <a href="{{route('agent.servicerequests')}}">
                    <i class="pe-7s-news-paper"></i>
                    <p>Service Requests</p>
                </a>
            </li>
            <li @yield('active4')>
                <a href="{{route('agent.changepwd')}}">
                    <i class="pe-7s-lock"></i>
                    <p>Change Password</p>
                </a>
            </li>
        </ul>
  </div>
</div>
