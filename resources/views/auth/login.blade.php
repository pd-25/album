<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Partner: Log In</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="{{ asset('admin-asset/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-asset/css/style.css') }}" rel="stylesheet">
</head>

<body style="background: #E1E1E1">
    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card" style="margin-top: 10%">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="{{asset('admin-asset/images/AlbumLogo.svg')}}" alt="Logo">
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <h5 class="mb-0 text-secondary"> <b>Partner Records - Welcome back!</b></h5>
                                        @if (Session::has('msg'))
                                            <p class="alert alert-danger">{{ Session::get('msg') }}</p>
                                        @endif
                                    </div>
                                    <form  method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary px-3">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
