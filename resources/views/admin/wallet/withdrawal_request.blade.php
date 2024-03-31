@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Withdrawal Request'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Withdrawal balance </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card rounded shadow">
        <div class="card-body">
            <form action="{{route('wallet.withdrawalstore')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 border-bottom mb-2">
                        <h6><b>Withdrawal User Wallet Balance</b></h6>
                    </div>
                    <div class="col-6 text-right border-bottom mb-2">
                        <h6><b>
                            <i class="ti-money" style="font-weight:bold; color:black"></i> <span id="UserBalance" class="text-dark"></span> 
                        </b></h6>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Select User <span class="text-danger">*</span></label>
                        <select name="userId" class="custom-select" onchange="Userbalance(value)">
                            <option value="" selected>Select User</option>
                            @if (!@empty($user))
                                @foreach ($user as $item)
                                    <option value="{{@$item->id}}">{{@$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="text-danger">
                            @error('userId')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Adjust Earning <span class="text-danger">*</span></label>
                        <input type="number" min="1" required class="form-control" name="adjust_earning" value="{{old('adjust_earning')}}">
                        <span class="text-danger">
                            @error('adjust_earning')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-2">
                        <label class="form-label">Month <span class="text-danger">*</span></label>
                        <select name="month" class="custom-select">
                            {{ $now = date('m')}}
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $now ==  $i ? 'Selected':'' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="text-danger">
                            @error('month')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-2 mb-2">
                        <label class="form-label">Year <span class="text-danger">*</span></label>
                        <select name="year" class="custom-select">
                            {{ $last= date('Y')-3 }}
                            {{ $now = date('Y') }}
                            @for ($i = $now; $i >= $last; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="text-danger">
                            @error('year')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="">Earning Referance</label>
                        <textarea name="earning_referance" class="form-control h-auto" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="type" value="D">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success"> Withdrawal Balance</button>
                        <a href="{{route('wallet.index')}}" type="button" class="btn btn-danger"> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card rounded shadow" style="height: 500px; overflow:scroll">
        <div class="card-body">
            <div>
                <table class="table table-sm table-hover">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">user</th>
                        <th scope="col">Adjust Earning</th>
                        <th scope="col">Month/Year</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (!@empty($withdrawal))
                            @foreach ($withdrawal as $index=>$item)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->userDetails->name}}</td>
                                    <td>{{$item->adjust_earning}}</td>
                                    <td>{{$item->month}}/{{$item->year}} </td>
                                    <td>
                                        @if ($item->status == 0)
                                        <button class="btn btn-warning btn-sm">p</button>
                                        @elseif($item->status == 1)
                                        <button class="btn btn-success btn-sm">A</button>
                                        @elseif($item->status == 2)
                                        <button class="btn btn-danger btn-sm">R</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#"  onclick="AddModalData({{$item}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ti-pencil btn btn-sm btn-primary" ></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                {{@$withdrawal->appends(request()->input())->links()}}
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
            <form action="{{route('wallet.update')}}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <input type="hidden" name="id" id="Modalid" value="">
                    <div class="col-12 mb-2">
                        <label class="">Adjust Earning</label>
                        <input type="number" min="1" name="adjust_earning" class="form-control" id="Modaladjust_earning"  value="" >
                        <span class="text-danger">
                            @error('adjust_earning')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="">Earning Referance</label>
                        <textarea name="earning_referance" class="form-control h-auto" rows="3" id="Modalearning_referance"></textarea>
                    </div>
                    <div class="col-12 mb-2">
                        <label class=""> Status</label>
                        <select class="custom-select" id="ModalStatus" name="status">
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-info mr-2">Update</button>
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
        function Userbalance(id){
            $.ajax({
                type: "GET",
                url: "/admin/wallet/user-balance/"+id,
                success: function(result){
                    $('#UserBalance').text(result);
                }
            });
        }
        // Notiflix.Notify.Init({});
        function AddModalData(data){
            console.log(data)
            $('#Modalid').val(data.id)
            $('#Modaladjust_earning').val(data.adjust_earning)
            $('#Modalearning_referance').val(data.earning_referance)
            $('#ModalStatus').val(data.status)
            if(data.status == 1){
                $('#ModalStatus').attr('disabled', 'disabled')
            }else{
                $('#ModalStatus').removeAttr('disabled', 'disabled')
            }

        }
    </script>
@endsection