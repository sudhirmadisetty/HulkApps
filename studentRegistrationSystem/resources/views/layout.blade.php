<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }

        /* Sidebar */
        .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0; /* Height of navbar */
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 230px;
        z-index: 600;
        }

        /* @media (max-width: 991.98px) {
        .sidebar {
        width: 100%;
        } */
        /* } */
        .sidebar .active {
        border-radius: 5px;
        border-color: #EA7A2F #EA7A2F !important;
        background: #EA7A2F !important;
        }

        .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto;
        }

        .cmn_card_view {
        border-radius: 0.25rem;
        background: #fff;
        padding: 20px;
        width: 100%;
        position: relative;
        box-shadow: unset !important;
        }

        .cmn_ttl_sec .lft h6 {
            font-weight: 400;
            color: #858ea1;
            font-size: 13px;
            margin: 5px 0px 0px 0px;
        }

        .icon_with_cnts {
        position: relative;
        padding-left: 40px;
        display: flex;
        align-items: center;
        }
        .icon_with_cnts i {
        position: absolute;
        left: 0;
        color: #EA7A2F;
        font-size: 24px;
        }
        .icon_with_cnts strong {
        display: block;
        font-weight: 700;
        color: #222740;
        font-size: 18px;
        line-height: 20px;
        }
        .icon_with_cnts span {
        display: block;
        font-weight: 400;
        color: #5a607f;
        font-size: 13px;
        }

        .btn.cmn_btn.cta_one {
        background: #EA7A2F;
        color: #fff;
        }

    </style>
     
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item mr-0">
                        <a class="nav-link text-dark" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest
            </ul>
  
        </div>
    </div>
</nav>

@guest
    @yield('content')
@else
   
    <div id="main" class="row">
       <!-- sidebar content -->
       <div id="sidebar" class="col-md-2">
             <!-- Sidebar -->
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                <div class="position-sticky"> 
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action py-2 ripple link {{ request()->routeIs('dashboard') ? 'active' : null }}" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span> Dashboard</span>
                    </a>
        
                    <a href="{{ route('student') }}" class="list-group-item list-group-item-action py-2 ripple link {{ request()->routeIs('student') ? 'active' : null }}">
                        <i class="fas fa-user-friends"></i><span> Student</span>
                    </a>
                    
                </div>
                </div>
            </nav>
        </div>
      
        <!-- main content -->
        <div id="content" class="col-md-10">
            @yield('content')
        </div>
    </div>
@endguest


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>