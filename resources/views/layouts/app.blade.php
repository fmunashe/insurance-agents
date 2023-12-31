<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{config('app.name')}} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{route('dashboard')}}" class="brand-logo">
            {{--            <img class="logo-abbr" src="{{asset('images/logo.jpeg')}}" alt="">--}}
            <span class="brand-title">{{Config('app.name')}}</span>
            {{--            <span>{{Config('app.name')}}</span>--}}
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                {{auth()->user()->name}}
                                <div class="pulse-css"></div>
                            </a>
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <img src="{{asset('images/logo.png')}}" width="20" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                {{--                                <a href="app-profile.html" class="dropdown-item ai-icon">--}}
                                {{--                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                {{--                                    <span class="ml-2">Profile </span>--}}
                                {{--                                </a>--}}
                                <a href="#" class="dropdown-item ai-icon mt-0">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-responsive-nav-link :href="route('logout')"
                                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18"
                                                 height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-log-out ml-2">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="ml-2">{{ __('Log Out') }} </span>
                                        </x-responsive-nav-link>
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                    </ul>
                </li>
                @if(auth()->user()->role == \App\Enum\Role::ROLES[0] || auth()->user()->role == \App\Enum\Role::ROLES[2])
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-book"></i>
                            <span class="nav-text">Risks</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('products.index')}}">Risks</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-paypal"></i>
                            <span class="nav-text">Clients</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('clients.index')}}">Clients</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-paper-plane"></i>
                            <span class="nav-text">Policies</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('policies')}}">Policies</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-money"></i>
                            <span class="nav-text">Insurance Providers</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('suppliers.index')}}">Providers</a></li>

                        </ul>
                    </li>

                @endif


                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-cogs"></i>
                        <span class="nav-text">Configuration</span>
                    </a>
                    <ul aria-expanded="false">
                        @if(auth()->user()->role == \App\Enum\Role::ROLES[0])
                            <li><a href="{{route('currency.index')}}">Currency</a></li>
                            <li><a href="{{route('users.index')}}">Users</a></li>
                            <li><a href="{{route('getSubscriptionForm')}}">Subscriptions</a></li>
                            <li><a href="{{route('subscriptionPlan.index')}}">Subscription Plans</a></li>
                            <li><a href="{{route('adverts.index')}}">Adverts</a></li>
                        @endif

                        @if(auth()->user()->role == \App\Enum\Role::ROLES[0] || auth()->user()->role == \App\Enum\Role::ROLES[2])
                            <li><a href="{{route('productCategories.index')}}">Risk Categories</a></li>
                            <li><a href="{{route('commissions.index')}}">Commission Bands</a></li>
                        @endif

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="card-intro-title mb-4">Adverts</h4>
                            <div class="bootstrap-carousel">
                                <div data-ride="carousel" class="carousel slide" id="carouselExampleCaptions">
                                    <ol class="carousel-indicators">
                                        @foreach(\App\Models\Advert::query()->where('status',true)->latest()->get() as $advert)
                                            <li class="{{ $loop->first ? 'active' : '' }}"
                                                data-slide-to="{{$loop->index}}" data-target="#carouselExampleCaptions">
                                            </li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach(\App\Models\Advert::query()->where('status',true)->latest()->get() as $advert)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img class="d-block w-100"
                                                     src="{{ Storage::url('uploads/'.$advert->banner_url) }}" alt=""
                                                    style="height: 250px" >
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{$advert->title}}</h5>
                                                    <p>{{$advert->description}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a data-slide="prev" href="#carouselExampleCaptions"
                                       class="carousel-control-prev"><span class="carousel-control-prev-icon"></span>
                                        <span class="sr-only">Previous</span></a>
                                    <a data-slide="next" href="#carouselExampleCaptions"
                                       class="carousel-control-next"><span class="carousel-control-next-icon"></span>
                                        <span class="sr-only">Next</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="https://fmunashe.github.io/profile" target="_blank">Zihove</a> {{\Carbon\Carbon::now()->year}}
            </p>
        </div>
    </div>


</div>

<script src="{{asset('vendor/global/global.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/custom.min.js')}}"></script>

<script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
<script src="{{asset('vendor/morris/morris.min.js')}}"></script>

<script src="{{asset('vendor/peity/jquery.peity.min.js')}}"></script>

<script src="{{asset('js/dashboard/dashboard-2.js')}}"></script>

<script src="{{asset('vendor/svganimation/vivus.min.js')}}"></script>
<script src="{{asset('vendor/svganimation/svg.animation.js')}}"></script>

{{--<script src="{{asset('js/styleSwitcher.js')}}"></script>--}}

<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('js/plugins-init/select2-init.js')}}"></script>
@include('sweetalert::alert')
@livewireScripts
@livewireChartsScripts
@stack('scripts')
<!-- Datatable -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<script src="{{asset('vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{asset('js/plugins-init/jquery.validate-init.js')}}"></script>

<!-- Form step init -->
<script src="{{asset('js/plugins-init/jquery-steps-init.js')}}"></script>
</body>
</html>
