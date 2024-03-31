@extends('admin.layout.main')
@section('title', env('APP_NAME').' |  Add Wallet'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Add wallet balance </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card rounded shadow">
        <div class="card-body">
            <form action="{{route('wallet.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 border-bottom mb-2">
                        <h6><b>Add User Wallet Balance</b></h6>
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
                        <label class="form-label">Earning <span class="text-danger">*</span></label>
                        <input type="number" min="1" required class="form-control" name="earning" value="{{old('earning')}}">
                        <span class="text-danger">
                            @error('earning')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-4">
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
                    <div class="col-4 mb-2">
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
                    <input type="hidden" name="type" value="E">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success"> Add Wallet Balance</button>
                        <a href="{{route('wallet.index')}}" type="button" class="btn btn-danger"> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card rounded shadow" style="height: 450px; overflow:scroll">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-sm table-hover">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">user</th>
                        <th scope="col">Earning</th>
                        <th scope="col">Month/Year</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (!@empty($Wallet))
                            @foreach ($Wallet as $index=>$item)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->userDetails->name}}</td>
                                    <td>{{$item->earning}}</td>
                                    <td>{{$item->month}}/{{$item->year}} </td>
                                    <td>
                                        <form method="POST"
                                            action="{{ route('wallet.destroy', encrypt(2)) }}"
                                            class="action-icon">
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="DeleteId" type="hidden" value="{{@$item->id}}">
                                            <button type="submit"
                                                class="btn btn-sm btn-danger  delete-icon show_confirm"
                                                data-toggle="tooltip" title='Delete'>
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                {{@$Wallet->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        // Notiflix.Notify.Init({});
        function Userbalance(id){
            $.ajax({
                type: "GET",
                url: "/admin/wallet/user-balance/"+id,
                success: function(result){
                    $('#UserBalance').text(result);
                }
            });
        }
    </script>
@endsection