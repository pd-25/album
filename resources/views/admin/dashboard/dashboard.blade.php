@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Dashboard'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Welcome {{ auth()->guard('admin')->user()->name }} !</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        {{-- <div class="col-md-8 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <span>Welcome Here</span>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-lg-12 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div> --}}
        <div class="col-md-6">
            <div class="card">
                <div>
                    <h5 class="fw-bolder" style="color:#0AC074">Latest News</h5>
                </div>
                <div class="card-body bg-light rounded" style="height: 450px; overflow-y: scroll;">
                    @foreach (@$news as $index=>$item)
                    <div class="py-1">
                        <a href="{{route('admin.newsDetails', @$item->id)}}">
                            <span style="color: #1e85eb; font-size:14px">{{@$index+1}}.</span> 
                            <span style="color: #1e85eb; font-size:14px">{{@$item->news_heading}}, {{@date('d-m-Y', strtotime(@$item->news_date))}}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card rounded" style="height: 520px;">
                <div class="card-body">
                    <div id="barchart" class="overflow-y"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card rounded" style="height: 400px;">
                <div class="card-body">
                    <div id="barchartEarning" class="overflow-y"></div>
                </div>
            </div>
        </div>
    </div>
    <section id="main-content">
        <div class="row mb-3">
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
                            <div class="text-white fs-larger" style="font-size: large">Total Release</div>
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
        <div class="card">
            <div class="row">
                <div class="col-12 mb-3 border-bottom">
                    <h4>Latest 10 Release</h4>
                </div>
                @if (!@empty($asset))
                    @foreach ($asset as $item)
                        <div class="col-2 ">
                            <a href="{{ route('asset.edit', @$item->id) }}">
                                <div class="text-center">
                                    <img src="{{asset('/admin-asset/images/man.png')}}" alt="No Image" style="height: 100px" class="img_fluid">
                                    <br>
                                    <div class="mt-2 text-primary">
                                        {{@$item->release_title}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>{{ date('Y') }} © integralsilence</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
    <script>
       var dataYear = {{$BarChartYear}}
       var dataAmmount = {{$BarChartAmmount}}

       var EarningdataYear = {{$BarChartYearEarning}}
       var EarningdataAmmount = {{$BarChartAmmountEarning}}

        var options = {
        chart: {
            type: 'bar',
            height: 400,
            enabled: false
        },
        title: {
        text: 'Yearly employee withdrawal analysis',
        align: 'left',
        },
        series: [{
            name: 'sales',
            data: dataAmmount
        }],
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories:dataYear,
        } }
        // console.log(document.querySelector("#barchart"));
        var chart = new ApexCharts(document.querySelector("#barchart"), options);
        chart.render();

        // Earning Start

        var optionsII = {
        chart: {
            type: "area",
            height: 300,
            enabled: false
        },
        stroke: {
            curve: 'smooth',
        },
        title: {
        text: 'Yearly employee earning analysis',
        align: 'left',
        },
        series: [{
            name: 'sales',
            data: EarningdataAmmount
        }],
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories:EarningdataYear,
        } }
        // console.log(document.querySelector("#barchart"));
        var chartII = new ApexCharts(document.querySelector("#barchartEarning"), optionsII);
        chartII.render();
    </script>
@endsection