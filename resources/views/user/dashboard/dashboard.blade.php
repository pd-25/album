@extends('user.main')
@section('title', env('APP_NAME').' | Dashboard'  )

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Hello {{Auth::user()->name}}, <span>Welcome Here.</span></h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 rounded shadow w-100 h-100 p-3" style="background-color: #6571FF;">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-ticket text-white"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="text-white fs-larger" style="font-size: large">Total Labels</div>
                            <div class="text-white" style="font-size: larger">{{@$dashboard['label']}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 rounded shadow w-100 h-100 p-3" style="background-color: #0AC074">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-cta-right text-white"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="text-white fs-larger" style="font-size: large">Total Reelase</div>
                            <div class="text-white" style="font-size: larger">{{@$dashboard['reelase']}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 rounded shadow w-100 h-100 p-3" style="background-color: #6F42C1">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-white"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="text-white fs-larger" style="font-size: large">Total Artist</div>
                            <div class="text-white" style="font-size: larger">{{@$dashboard['artist']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>{{ date('Y') }} © Artist Board. - <a href="#">abc.com</a></p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection