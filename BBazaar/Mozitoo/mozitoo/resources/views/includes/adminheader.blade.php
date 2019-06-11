<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#3c3e0a;">
        <div class="logo">
            <a href="{{route('home')}}" class="simple-text">
              <img src="{{ URL::to('src/images/logos/logo3.png') }}" alt="Mozitoo.com">
            </a>
        </div>

        <ul class="nav">
            <li @yield('active')>
                <a href="{{route('admin')}}">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li @yield('active1')>
                <a href="{{route('property.all')}}">
                    <i class="pe-7s-check"></i>
                    <p>All Properties</p>
                </a>
            </li>
            <li @yield('active2')>
                <a href="{{route('adminsubmitform')}}">
                    <i class="pe-7s-plus"></i>
                    <p>Add property</p>
                </a>
            </li>
            <li @yield('active3')>
                <a href="{{route('servicerequests.all')}}">
                    <i class="pe-7s-news-paper"></i>
                    <p>Service Requests</p>
                </a>
            </li>
            <li @yield('active4')>
                <a href="{{route('admin.inventory.review.createnew')}}">
                    <i class="pe-7s-plus"></i>
                    <p>inventory</p>
                </a>
            </li>
            <li @yield('active5')>
                <a href="{{route('admin.invoices.views')}}">
                    <i class="pe-7s-plus"></i>
                    <p>Invoices</p>
                </a>
            </li>
            <li @yield('active6')>
                    <a href="{{route('admin.changepwd')}}">
                        <i class="pe-7s-lock"></i>
                        <p>Change Password</p>
                    </a>
            </li>
        </ul>
  </div>
</div>
