<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--search -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!--收合.摺疊-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
    

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team+ Support</title>
    <title>{{ config('app.name', 'Team+ Support') }}</title>

    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/notosanstc.css" />
    <!--LocalCSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header" style="margin-left:120px;">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a  href="/" title="Home"><img src="/pic/team+.png" style="width:20%;margin-left:5px;" ></a>
                    <!--
                    <a class="navbar-brand" href="{ { url('/') }}">
                        { { config('app.name', 'Team+ Support') }}
                    </a>
                    -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="width:1040px;">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <img class="personal-pic" style="margin-top: 10px;" src="/storage/user_img/{{Auth::user()->user_img}}" alt="" width="30" height="30"  onclick="location.href='{{route('user_view', Auth::user()->id)}}'"/>

                            </li>
                            
                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <ul class="dropdown-menu" style="min-width:120px!important;" role="menu">
                                    <li>

                                        <a href="{{route('user_view', Auth::user()->id)}}">
                                        <i class="glyphicon glyphicon-cog" style="margin-right:5px;"></i>
                                            Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="glyphicon glyphicon-new-window" style="margin-right:5px;"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                            
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
	
       
    </div> 
   
     @yield('content')


    <!-- Scripts -->
        <script src="/js/autosize.min.js" type="text/javascript" ></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    

<div id="pageTop" style="position:fixed;bottom:50px;right:60px;cursor:pointer;display: none;z-index:99;" ><img src="/storage/goTop.png" style="height:32px;" ></div>




<script type="text/javascript">
    $("#pageTop").click(function () {
        jQuery("html,body").animate({
            scrollTop: 0
        }, 300);
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('#pageTop').fadeIn("fast");
        } else {
            $('#pageTop').stop().fadeOut("fast");
        }
    });
</script>
</body>
</html>
	
