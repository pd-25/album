<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- ================= Favicon ================== -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.js"></script>

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
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link href="{{ asset('admin-asset/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/themify-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-asset/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-asset/css/style.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-aio-1.5.0.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="#">
                            {{-- <span>{{ env('APP_NAME') }}</span> --}}
                            <img src="{{asset('admin-asset/images/AlbumLogo.svg')}}" alt="Logo">
                        </a></div>
                    {{-- <li><a href="#"><i class="ti-calendar"></i> Site Info </a></li> --}}
                    <li><a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i> Dashboard </a></li>

                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> User Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('users.create') }}">Add User</a></li>

                            <li><a href="{{ route('users.index') }}">All Users</a>
                            </li>


                        </ul>
                    </li>

                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Artist Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('artists.create') }}">Add Artist</a></li>

                            <li><a href="{{ route('artists.index') }}">All Artists</a>
                            </li>


                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-ticket"></i> Label Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('label.create') }}">Add Label</a></li>

                            <li><a href="{{ route('label.index') }}">All Labels</a>
                            </li>


                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-calendar"></i> Release Management <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.create') }}">Add Release</a></li>

                            <li><a href="{{ route('admin.index') }}">All Release</a>
                            </li>

                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-harddrives"></i> Store Management <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('store.index') }}">Stores</a></li>
                            {{-- <li><a href="{{ route('storePermission.index') }}">Store Permission</a></li> --}}
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-wallet"></i> User Wallet<span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('wallet.index') }}">Add Wallet Balance</a></li>
                            <li><a href="{{ route('wallet.withdrawalRequest') }}">Withdrawal Request</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-headphone"></i> Support ticket <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('category.index') }}">Create category</a></li>
                            <li><a href="{{ route('support.create') }}">Support ticket</a></li>
                            <li><a href="{{ route('support.tickethistory') }}">Ticket History</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i> Settings <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('news.index') }}">News</a></li>
                            <li><a href="{{ route('roles.index') }}">Other key roles</a></li>
                        </ul>
                    </li>
                    {{-- <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Banner Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('banners.create') }}">Add Banner</a></li>

                            <li><a href="{{ route('banners.index') }}">All Banners</a>
                            </li>


                        </ul>
                    </li> --}}

                    {{-- <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Order Management <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">All Orders</a></li>
                            <li><a href="#">New Orders</a></li>
                            <li><a href="#">Completed Orders</a></li>


                        </ul>
                    </li> --}}

                    <li>
                         <a href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ti-power-off"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}"
                            method="get" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->
    <div class="header" style="margin-top: -20px">
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
                    {{-- <div class="float-right">
                        <div class="dropdown dib">

                            <div class="header-icon dropdown">

                                <span class="user-avatar" data-toggle="dropdown"
                                    aria-expanded="false"><img style="height: 30px;margin-right:5px" src="{{asset('/admin-asset/images/man.png')}}" alt="No image"> {{ auth()->guard('admin')->user()->name }}
                                    <i class="ti-angle-down" style="font-size:10px"></i>
                                </span>
                                <div class="dropdown-menu mt-3">
                                    <ul>
                                        <li>
                                            <a href="{{ route('admin.logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <i class="ti-power-off"></i>
                                                <span>Logout</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('admin.logout') }}"
                                                method="get" class="d-none">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- JQUERY STEP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    {{-- <script src="{{ asset('admin-asset/js/dashboard2.js') }}"></script> --}}
    @yield('script')
    <script>
        new SlimSelect({
            select: '#multipleSelect'
        })
    </script>
    <script>
        $(document).ready(function() {

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#myInputNews").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTableNews tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

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
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // imgInp.onchange = evt => {
        //     const [file] = imgInp.files
        //     if (file) {
        //         blah.src = URL.createObjectURL(file)
        //     }
        // }
    </script>
</body>

</html>
