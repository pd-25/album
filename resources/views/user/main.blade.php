<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>@yield('title')</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{asset('admin-asset/images/AlbumLogo.svg')}}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('admin-asset/images/AlbumLogo.svg')}}">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('admin-asset/images/AlbumLogo.svg')}}">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('admin-asset/images/AlbumLogo.svg')}}">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('admin-asset/images/AlbumLogo.svg')}}">
    <!-- Styles -->
    @vite(['resources/js/app.js']);
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('admin-asset/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/themify-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-asset/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-asset/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-aio-1.5.0.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</head>

<body>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="#">
                        <img src="{{asset('admin-asset/images/AlbumLogo.svg')}}" alt="Logo">
                        </a>
                    </div>
                    <li><a href="{{ route('artistDashboard') }}"><i class="ti-dashboard"></i> Dashboard </a></li>

                    <li><a href="{{ route('asset.index') }}"><i class="ti-calendar"></i> Release </a></li>

                    <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Rights Holders <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('userArtists.index') }}">Artists</a></li>

                            <li><a href="{{ route('labels.index') }}">Labels</a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('wallet.create') }}"><i class="ti-wallet"></i> Wallet </a></li>

                    <li><a href="{{ route('support.index') }}"><i class="ti-headphone"></i> Support ticket </a></li>
                    
                </ul>
                <ul>
                    <li>
                        <a href="{{ route('editProfile') }}">
                            <i class="ti-user"></i>
                            <span>Account</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="ti-power-off"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}"
                            method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header" style="margin-top: -22px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        {{-- <div class="dropdown mt-3 mr-2">
                            <h6 style="color: #1C1C1C; font-weight:500">Welcome {{ auth()->user()->name }} !</h6>
                        </div> --}}
                        {{-- <div class="dropdown dib">

                            <div class="header-icon dropdown">

                                <span class="user-avatar" data-toggle="dropdown"
                                    aria-expanded="false"> <img style="height: 30px;margin-right:5px" src="{{asset('/admin-asset/images/man.png')}}" alt="No image"> {{ auth()->user()->name }}
                                    <i class="ti-angle-down" style="font-size: 10px"></i>
                                </span>
                                <div class="dropdown-menu mt-3">
                                    <div class="">
                                        <ul>
                                            <li>
                                                <a href="{{ route('editProfile') }}">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <hr>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                              document.getElementById('logout-form').submit();">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>

                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-wrap">
        <div class="main container-fluid">
            @if(session()->has('errorMessage'))
            <div class="alert alert-danger text-white mb-0" role="alert">
                {{Session::get('errorMessage')}}
            </div>
            @elseif(session()->has('success'))
            <div class="alert alert-success text-white mb-0" role="alert">
                {{Session::get('success')}}
            </div>
            @endif
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="{{ asset('admin-asset/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-asset/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('admin-asset/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('admin-asset/js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ asset('admin-asset/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-asset/js/scripts.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap -->
    <script src="{{ asset('admin-asset/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('admin-asset/js/lib/data-table/datatables-init.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- JQUERY STEP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
    <!-- scripit init-->
    {{-- <script src="{{ asset('admin-asset/js/dashboard2.js') }}"></script> --}}
    @yield('script')
    <script>
        new SlimSelect({
            select: '#multipleSelect'
        })
    </script>
<script>
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            //  alert(form);
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this data?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Your data file is safe!");
                }
            });

        });

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // imgInp.onchange = evt => {
        //     const [file] = imgInp.files
        //     if (file) {
        //         blah.src = URL.createObjectURL(file)
        //     }
        // }
    });
    
    // $('.js-example-basic-single').select2();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
    </script>
</body>
</html>
