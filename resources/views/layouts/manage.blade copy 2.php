<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <meta name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description"
            content="This dashboard was created as an example of the flexibility that Architect offers.">
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
          <!-- App favicon -->
          <link rel="shortcut icon" href="{{ asset('pkclaim/images/logo150.ico') }}">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <link href="{{ asset('pkclaim/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
          <link href="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
          <link href="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    
          
        <link rel="stylesheet" href="{{ asset('disacc/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('disacc/vendors/ionicons-npm/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('disacc/vendors/linearicons-master/dist/web-font/style.css') }}">
        <link rel="stylesheet"
            href="{{ asset('disacc/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
        <link href="{{ asset('disacc/styles/css/base.css') }}" rel="stylesheet">
    </head>

<style>
    body{
        /* background: */
            /* url(/pkbackoffice/public/images/bg7.png);  */
            /* -webkit-background-size: cover; */
        background-color:rgb(245, 240, 240);
        background-repeat: no-repeat;
		background-attachment: fixed;
		/* background-size: cover; */
        background-size: 100% 100%;
        /* display: flex; */
        /* align-items: center; */
        /* justify-content: center; */
        /* width: 100vw;   ให้เต็มพอดี */
        /* height: 100vh; ให้เต็มพอดี  */
        }
    .Bgsidebar {
  		background-image: url('/mahathep/public/images/bgside.jpg');
		background-repeat: no-repeat;
	}
    .Bgheader {
  		background-image: url('/mahathep/public/images/bgheader.jpg');
		background-repeat: no-repeat;
	}
    
</style>
<body data-topbar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            {{-- <div class="navbar-header" style="background-color: rgb(252, 252, 252)"> --}}
                <div class="navbar-header shadow" style="background-color: rgba(237, 199, 247)">

                <div class="d-flex">
                    <!-- LOGO -->
                    {{-- <div class="navbar-brand-box"> --}}
                        <div class="navbar-brand-box" style="background-color: rgb(255, 255, 255)">
                        <a href="" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="distemplate/images/dataaudit.jpg" alt="logo-sm" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="distemplate/images/dataaudit.jpg" alt="logo-dark" height="20">
                            </span>
                        </a>

                        <a href="" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('distemplate/images/dataaudit.jpg') }}" alt="logo-sm-light" height="40">
                            </span>
                            <span class="logo-lg">
                                <h4 style="color:rgb(237, 199, 247, 0.781)" class="mt-4">MAHATHEP</h4>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle" style="color: rgb(255, 255, 255)"></i>
                    </button>
                    <h4 style="color:rgb(255, 255, 255)" class="mt-4">Checksit Auto</h4>
                    <?php
                        $org = DB::connection('mysql')->select(                                                            '
                                select * from orginfo
                                where orginfo_id = 1                                                                                                                      ',
                        );
                    ?>
                    {{-- <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            @foreach ($org as $item)
                            <h4 style="color:rgb(48, 46, 46)" class="mt-2">{{$item->orginfo_name}}</h4>
                            @endforeach

                        </div>
                    </form> --}}
                </div>



                <div class="d-flex">
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line" style="color: rgb(54, 53, 53)"></i>
                        </button>
                    </div>
                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->img == null)
                                <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px"
                                    width="32px" alt="Header Avatar" class="rounded-circle header-profile-user">
                            @else
                                <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                                    width="32px" alt="Header Avatar" class="rounded-circle header-profile-user">
                            @endif
                            <span class="d-none d-xl-inline-block ms-1">
                                {{ Auth::user()->fullname }}
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{-- <a class="dropdown-item" href="{{ url('profile_edit/' . Auth::user()->id) }}"><i
                                    class="ri-user-line align-middle me-1"></i> Profile</a>
                            <div class="dropdown-divider"></div> --}}
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                class="text-reset notification-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="ri-shut-down-line align-middle me-1 text-danger"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block user-dropdown">

                    </div>
                </div>
            </div>
        </header>
        {{-- <style>
            .nom6{
                background: linear-gradient(to right,#ffafbd);
                /* background: linear-gradient(to right, #c9ffbf, #ffafbd); */
            }
        </style> --}}

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
            {{-- <div data-simplebar class="h-100" style="background-color: #ffafbd"> --}}
                {{-- <div data-simplebar class="h-100 nom6"> --}}
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ url('manage_dashboard') }}" target="_blank">
                                <i class="fa-solid fa-gauge-high text-info"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ url('authencode_auto') }}" target="_blank">
                                <i class="fa-solid fa-gauge-high text-info"></i>
                                <span >authencode_auto</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-clipboard-user text-info"></i>
                                <span style="color: white">Check Sit</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ url('check_sit_day') }}">เช็คสิทธิ์รายวัน</a></li>
                                <li><a href="{{ url('check_sit_money') }}"> เช็คสิทธิ์ Money PK</a></li>
                            </ul>
                        </li> --}}

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"> 
                                <i class="fa-solid fa-user-check text-danger"></i>
                                <span>Checksit Auto</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li ><a href="{{ url('pullhosauto') }}">Pull Data Hos</a></li> 
                            </ul>
                        </li>  
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-regular fa-credit-card text-danger"></i>
                                <span>ลูกหนี้</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li ><a href="{{ url('manage_pullacc') }}" target="_blank">ดึงลูกหนี้</a></li>
                             
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-gears text-danger me-2"></i>
                                <span style="color: white">ตั่งค่า</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li ><a href="{{ url('manage_setting') }}" style="color: white">กำหนดสิทธิ์ที่ต้องการดึง</a></li>
                            </ul> 
                        </li> --}}

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © โรงพยาบาลภูเขียวเฉลิมพระเกียรติ
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Created with <i class="mdi mdi-heart text-danger"></i> by ประดิษฐ์ ระหา - งานประกันสุขภาพ
                            </div>
                        </div>
                    </div>
                </div>
            </footer>


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <script type="text/javascript" src="{{ asset('disacc/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/metismenu/dist/metisMenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/jquery-circle-progress/dist/circle-progress.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/toastr/build/toastr.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/chart.js/dist/Chart.min.js') }}"></script>

    <!-- datatables.js -->
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap-table/dist/bootstrap-table.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Loadding.js -->
    <script type="text/javascript" src="{{ asset('disacc/vendors/block-ui/jquery.blockUI.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/blockui.js') }}"></script>
    <!-- custome.js -->
    <script type="text/javascript" src="{{ asset('disacc/js/charts/apex-charts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/circle-progress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/toastr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/treeview.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/form-components/toggle-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/charts/chartjs.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('disacc/js/app.js') }}"></script> --}}

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('pkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ asset('pkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js" integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('footer')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#example3').DataTable();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


        function Addopd() {
            var aopd = document.getElementById("ADDOPD").value;
            var code_name = document.getElementById("CODE_NAME").value;


                var _token = $('input[name="_token"]').val();
                $.ajax({
                url: "{{url('add_opd_new')}}",
                method: "GET",
                data: {
                    aopd: aopd,
                    code_name:code_name,
                    _token: _token
                },
                success: function (result) {
                    $('.show_opd').html(result);
                }
            })
        }
        function addpangipd() {
            var aipd = document.getElementById("ADDIPD").value;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('add_ipd_new')}}",
                method: "GET",
                data: {
                    aipd: aipd,
                    _token: _token
                },
                success: function (result) {
                    $('.show_ipd').html(result);
                }
            })
        }
    </script>

</body>

</html>
