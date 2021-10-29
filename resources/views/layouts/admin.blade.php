
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>{{$comm->shortname}} - @yield('title')</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/weather-icons/css/weather-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/themify-icons/css/themify-icons.css')}}">
        <link href="{{asset('images/logo/'.$comm->favicon)}}" style="max-width: 16px; max-height: 16px" rel="shortcut icon">
        <!-- endinject -->
        @yield('style')
        <!-- Main Style  -->
        <link rel="stylesheet" href="{{asset('admins/dist/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('admins/assets/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/assets/css/waitMe.min.css')}}">

        <!--horizontal-timeline-->
        <link rel="stylesheet" href="{{asset('admins/assets/js/horizontal-timeline/css/style.css')}}">


        <script src="{{asset('admins/assets/js/modernizr-custom.js')}}"></script>
    </head>
    <body id="page">

        <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="{{asset('/admin/')}}" class="navbar-brand">
                        <span class="logo"><img src="{{asset('images/logo/'.$comm->logo)}}" style="max-height: 40px; max-width:40px" alt=""/></span>
                     </a>
                    <!--logo end-->
                </div>

                <div class="search-dropdown dropdown pull-right visible-xs">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                    <div class="dropdown-menu">
                        <form >
                            <input class="form-control" placeholder="Search here..." type="text">
                        </form>
                    </div>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->

                    <!--search start-->
                    <!--<form class="search-content hidden-xs" >
                        <button type="submit" name="search" class="btn srch-btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" class="form-control" name="keyword" placeholder="Search here...">
                    </form>-->
                    <!--search end-->

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            @if(!empty(Auth::guard('admin')->user()->image))
                                <div class="user-avatar"><img src="{{asset('images/users/'.Auth::guard('admin')->user()->image)}}" alt=""></div>
                                @else
                                <div class="user-avatar"><img src="{{asset('images/avatar.png')}}" alt=""></div>
                                @endif
                                <span class="hidden-sm hidden-xs">{{Auth::guard('admin')->user()->fname}} {{Auth::guard('admin')->user()->lname}}</span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="{{url('/admin/account-update')}}"><i class="fa fa-user"></i>  Profile</a></li>
                                <li><a href="{{url('/admin/change-password')}}"><i class="fa fa-commenting-o"></i>  Change Password</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/admin/logout')}}"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li>
                            <a data-toggle="ui-aside-right" href=""><i class="glyphicon glyphicon-option-vertical"></i></a>
                        </li>
                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside id="aside" class="ui-aside">
                <ul class="nav" ui-nav>
                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">Navigation</h5>
                    </li>
                    <li class="active"><a href="{{url('/admin/')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                    <li>
                        <a href=""><i class="fa fa-info"></i><span>Business Setup</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Setup</span></a></li>
                            <li><a href="{{url('/admin/business-setup')}}"><span> Setup</span></a></li>
                            <li><a href="{{url('/admin/social-accounts')}}"><span>Social Accounts</span></a></li>
                            <li><a href="{{url('/admin/messaging-settings')}}"><span>Mail Settings</span></a></li>
                        </ul>
                    </li>

                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">Layouts</h5>
                    </li>
                                       
                    <li>
                        <a href=""><i class="fa fa-shopping-cart"></i><span>Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Products</span></a></li>
                            <li><a href="{{url('/admin/products')}}"><span>Products</span></a></li>
                            <li><a href="{{url('/admin/product-categories')}}"><span>Product categories</span></a></li>
                            <li><a href="{{url('/admin/orders')}}"><span>Product Orders</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href=""><i class="fa fa-th-large"></i><span>Blog</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Blog</span></a></li>
                            <li><a href="{{url('/admin/blog')}}"><span>Blog Posts</span></a></li>
                            <li><a href="{{url('/admin/blog-categories')}}"><span>Blog categories</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href=""><i class="fa fa-users"></i><span>Users</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Users</span></a></li>
                            <li><a href="{{url('/admin/members')}}"><span>Members</span></a></li>
                            <li><a href="{{url('/admin/users')}}"><span>Visitors</span></a></li>
                            <li><a href="{{url('/admin/admin-users')}}"><span>Admin Users</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-users"></i><span>Leadership Team</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Leadership Team</span></a></li>
                            <li><a href="{{url('/admin/teams')}}"><span>Current Leadership</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-money"></i><span>Payments</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Payment</span></a></li>
                            <li><a href="{{url('/admin/payments')}}"><span>Payment History</span></a></li>
                            <li><a href="{{url('/admin/banks')}}"><span>Bank Accounts</span></a></li>
                            <li><a href="{{url('/admin/payment-gateways')}}"><span>Payment Gateway</span></a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/admin/banners')}}"><i class="fa fa-image"></i><span>Home Banners</span></a></li>
                    
                    <li><a href="{{url('/admin/newsletter-subscriptions')}}"><i class="fa fa-th-large"></i><span>Newsletter Subscriptions</span></a></li>
                    <li><a href="{{url('/admin/enquiries')}}"><i class="fa fa-info"></i><span>Client Enquiries</span></a></li>
                    <li><a href="{{url('/admin/testimonies')}}"><i class="fa fa-group"></i><span>Testimonies</span></a></li>
                    
                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">Extra</h5>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-television"></i><span>Settings</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub">
                            <li class="nav-sub-header"><a href=""><span>Settings</span></a></li>
                            <li><a href="{{url('/admin/account-update')}}"><span>Update Profile</span></a></li>
                            <li><a href="{{url('/admin/change-password')}}"><span>Change Password</span></a></li>
                            <li><a href="{{url('/admin/logout')}}"><span>Logout</span></a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/admin/log')}}"><i class="fa fa-th-large"></i><span>Log History</span></a></li>
                    
                </ul>
            </aside>
            <!--sidebar end-->
            @yield('content')


            <!--footer start-->
            <div id="footer" class="ui-footer">
                <?php echo date("Y"); ?> &copy; {{$comm->shortname}}. Designed by <a href="https://optisoft.ng">Optisoft Technologies Ltd</a>.
            </div>
            <!--footer end-->

        </div>

        <!-- inject:js -->
        <script src="{{asset('admins/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/autosize/dist/autosize.min.js')}}"></script>
        <!-- endinject -->


        <!--sparkline-->
        <script src="{{asset('admins/bower_components/bower-jquery-sparkline/dist/jquery.sparkline.retina.js')}}"></script>
        <script src="{{asset('admins/assets/js/init-sparkline.js')}}"></script>


        <!--horizontal-timeline-->
        <script src="{{asset('admins/assets/js/horizontal-timeline/js/jquery.mobile.custom.min.js')}}"></script>
        <script src="{{asset('admins/assets/js/horizontal-timeline/js/main.js')}}"></script>

        <!-- Common Script   -->
        <script src="{{asset('admins/dist/js/main.js')}}"></script>
        <script src="{{asset('admins/assets/js/toastr.min.js')}}"></script>
        <script src="{{asset('admins/assets/js/waitMe.min.js')}}"></script>
        <script>
        function open_loader(container) {
        $(container).waitMe({
            effect : 'bounce',
            text : '',
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            maxSize : '',
            waitTime : '-1',
            textPos : 'vertical',
            fontSize : '',
            source : '',
            onClose : function() {}
        });
    }

    function close_loader(container) {
        $(container).waitMe("hide");
    }
        </script>
        @yield('script')

    </body>
</html>
