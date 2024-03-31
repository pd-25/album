@extends('user.main')
@section('title', env('APP_NAME').' | Wallet'  )
@section('content')
<div class="container">
    <div class="card rounded shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mb-4">
                    <h6 class="mb-0"> 
                        {{-- <img style="height: 30px" src="{{asset('admin-asset/images/rupee.png')}}" alt="">  --}}
                        <span class="text-dark"><b><i class="ti-money"></i> {{($TotalEarning[0]->TotalEarning)-($TotalDeduction[0]->TotalDeduction)}}</b></span>
                    </h6>
                     <span> Available Balance</span>
                </div>
                <div class="col-6 mb-4 text-right">
                    <button class="btn btn-dark btn-sm px-4" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Withdrawal</button>
                </div>
                <div class="col-12 mb-4">
                    <div class="justify-content-center" id="MonthlyWidthChart" style="width:500px"></div>
                </div>
                <div class="col-12 mb-4">
                    <h6 class="text-warning rounded bg-light p-3"><i class="ti-alarm-clock mr-2"></i> <b>Pending request</b></h6>
                    <div class="row mt-3">
                        @if (!@empty($pendingWithdrawal))
                            @foreach ($pendingWithdrawal as $item)
                            @if ($item->status == 0)
                                <div class="col-12 mb-2 d-flex justify-content-between p-2 rounded">
                                    <span class="text-darnk">
                                        <button class="btn btn-warning btn-sm mr-3">P</button>{{$item->earning_referance}}
                                    </span>
                                    <span class="text-dark"> {{date('d M Y', strtotime($item->created_at))}}
                                        {{-- <img style="height: 15px; margin-left:20px;" src="{{asset('admin-asset/images/rupee.png')}}" alt=""> 
                                        <b>{{$item->adjust_earning}}</b> --}}
                                        <span class="text-warning" style="margin-left:20px;"><b ><i class="ti-money"></i> {{$item->adjust_earning}}</b></span>
                                    </span>
                                </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <h6 class="text-secondary rounded bg-light p-3"><i class="ti-reload mr-2"></i> <b>History</b></h6>
                    <div class="row mt-3">
                        @if (!@empty($pendingWithdrawal))
                            @foreach ($pendingWithdrawal as $item)
                            @if ($item->status == 1)
                                <div class="col-12 mb-2 d-flex justify-content-between p-2 rounded">
                                    <span class="text-darnk">
                                        <button class="btn btn-success btn-sm mr-3">A</button>{{$item->earning_referance}}
                                    </span>
                                    <span class="text-dark"> {{date('d M Y', strtotime($item->created_at))}}
                                        {{-- <img style="height: 15px; margin-left:20px;" src="{{asset('admin-asset/images/rupee.png')}}" alt="">  --}}
                                        <span class="text-success" style="margin-left:20px;"><b ><i class="ti-money"></i> {{$item->adjust_earning}}</b></span>
                                        
                                    </span>
                                </div>
                            @elseif($item->status == 2)
                            <div class="col-12 mb-2 d-flex justify-content-between p-2 rounded">
                                <span class="text-darnk">

                                    <button class="btn btn-danger btn-sm mr-3">R</button>{{$item->earning_referance}}
                                </span>
                                <span class="text-dark"> {{date('d M Y', strtotime($item->created_at))}}
                                    {{-- <img style="height: 15px; margin-left:20px;" src="{{asset('admin-asset/images/rupee.png')}}" alt=""> 
                                    <b>{{$item->adjust_earning}}</b> --}}
                                    <span class="text-danger" style="margin-left:20px;"><b ><i class="ti-money"></i> {{$item->adjust_earning}}</b></span>
                                </span>
                            </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h6 class="modal-title" id="staticBackdropLabel">Withdrawal</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('wallet.userstore')}}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <input type="hidden" name="userId" value="{{auth()->user()->id}}">
                    <input type="hidden" name="month" value="{{date('m')}}">
                    <input type="hidden" name="year" value="{{date('Y')}}">
                    <input type="hidden" name="type" id="" value="D">
                    <div class="col-12 mb-2">
                        <label class="">Adjust Earning</label>
                        <input type="number" min="1" name="adjust_earning" class="form-control" id="" >
                        <span class="text-danger">
                            @error('adjust_earning')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="">Earning Referance</label>
                        <textarea name="earning_referance" class="form-control h-auto" rows="3"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        var chartdata = {{$chartData}}
        var options = {
          series: [{
            name: "Monthly",
            data: chartdata
            
        }],
          chart: {
          height: 300,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Monthly Withdrawal Analysis' +' ' + new Date().getFullYear(),
          align: 'left',
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#MonthlyWidthChart"), options);
        chart.render();
    </script>
@endsection