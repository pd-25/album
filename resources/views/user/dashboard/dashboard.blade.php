@extends('user.main')
@section('title', 'Welcome to Frontstage'  )

@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Welcome {{ auth()->user()->name }} !</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div>
                    <h5 class="fw-bolder" style="color:#1C1C1C; font-weight:500">Latest News</h5>
                </div>
                <div class="card-body bg-light" style="height: 380px; overflow-y: scroll;">
                    @foreach (@$news as $index=>$item)
                    <div class="py-1">
                        <a href="{{route('user.newsDetails', @$item->id)}}">
                            <span style="color: #1e85eb; font-size:14px">{{@$index+1}}.</span> 
                            <span style="color: #1e85eb; font-size:14px">{{@$item->news_heading}}, {{@date('d-m-Y', strtotime(@$item->news_date))}}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="height: 450px;">
                <div class="card-body">
                    <div id="barchart" class="overflow-y"></div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card mb-3 w-100 h-100 p-3" style="background-color: #6571FF;">
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
            <div class="card mb-3 w-100 h-100 p-3" style="background-color: #0AC074">
                <div class="stat-widget-one">
                    <div class="stat-icon dib"><i class="ti-layout-cta-right text-white"></i>
                    </div>
                    <div class="stat-content dib">
                        <div class="text-white fs-larger" style="font-size: large">Total Release</div>
                        <div class="text-white" style="font-size: larger">{{@$dashboard['userreelase']}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 w-100 h-100 p-3" style="background-color: #6F42C1">
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
                <h4>Latest 5 Release</h4>
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
        <div class="col-lg-12 ">
            <div class="footer text-right">
                <p style="text-align: end">{{ date('Y') }} © integralsilence</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        let chartData = [];
        chartData = {{$BarChartdata}}
        // console.log(chartData);

        // function GetBarchartData(year){
        //     $.ajax({
        //         type: "GET",
        //         url: "/dashboard/barchart/"+year,
        //         success: function(result){
        //             chartData = []
        //             // chartData = result;
        //             console.log(chartData);
                    
        //         }
        //     });
        // }

        var options = {
        chart: {
            type: 'bar',
            height: 340,
        },
        title: {
        text: 'Monthly Earning Analysis'+' ' + new Date().getFullYear(),
        align: 'left',
        },
        series: [{
            name: 'sales',
            data: chartData
        }],
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        } }
        // console.log(document.querySelector("#barchart"));
        var chart = new ApexCharts(document.querySelector("#barchart"), options);
        chart.render();

        
    </script>
@endsection