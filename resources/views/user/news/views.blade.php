@extends('user.main')
@section('title', env('APP_NAME').' | News Details'  )
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 justify-content-between d-flex">
                    <div>
                        {{@date('d-m-Y', strtotime(@$news->news_date))}}
                    </div>
                    <div>
                        <a href="{{route('artistDashboard')}}">Back</a>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <h3><b>{{@$news->news_heading}}</b></h3>
                    <p class="mb-0 px-4" style="font-size:12px">{{@$news->short_description}}</p>
                </div>
                <div class="col-12">
                    <span style="font-size:12px">{!!@$news->long_description!!}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>

    </script>
@endsection