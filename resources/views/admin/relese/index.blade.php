@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Asset-index'  )
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow rounded">
                <div class="card-title justify-content-between d-flex">
                    <div>
                        <h4 class="mb-0"><b>All Releases</b></h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-success btn-sm">Add Release</a>
                    </div>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-title text-right">
                    <form action="" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" name="search" id="myInput" placeholder="Search Release Title" autocomplete="nope">
                            </div>
                            {{-- <div class="col-3">
                                <input type="date" class="form-control form-control-sm" name="formdate">
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control form-control-sm" name="todate">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-info btn-sm px-3" type="submit">Search</button>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Release Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @if (!@empty($Getartist))
                                @foreach ($Getartist as $index=>$item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>
                                            {{ @$item->release_title}}
                                        <td>
                                            {{-- @if (!empty($artist->image) && File::exists(public_path('storage/ArtistImage/' . $artist->image))) --}}
                                            {{-- <img style="height: 82px; width: 82px;" src="{{ asset('storage/ArtistImage/'.$artist->image) }}" alt=""> --}}
                                                
                                            {{-- @else --}}
                                            <img style="height: 82px; width: 82px;" src="{{asset('storage/'.@$item->cover_image)}}" alt="">
                                                
                                            {{-- @endif --}}
                                        </td>
                                        <td style="width: 150px;">
                                            <select name="status" class="custom-select" onchange="StatusUpdate(@json($item->id), value)">
                                                <option value="0"  {{($item->status)== 0 ? 'selected':''}}>Review</option>
                                                <option value="1" {{($item->status)== 1 ? 'selected':''}}>Approved</option>
                                                <option value="2" {{($item->status)== 2 ? 'selected':''}}>Track down</option>
                                            </select>
                                        </td>
                                        {{-- <td><span id="status-btn{{ $artist->id }}">
                                            <button class="btn btn-sm {{ $artist->status == 'Available' ? 'btn-success' : ($artist->status == 'Inactive' ? 'bg-danger' : 'bg-warning'); }}"  onclick="changeStatus('{{ $artist->id }}', {{ $artist->id}})" >
                                                {{ $artist->status }}
                                            </button>
                                        </span>
                                        </td> --}}
                                        <td>
                                            {{-- <a href="{{ route('artists.show', encrypt($artist->id)) }}"><i
                                                class="ti-eye btn btn-sm btn-success"></i></a> --}}
                                            <a href="{{ route('admin.edit', @$item->id) }}"><i
                                                    class="ti-pencil btn btn-sm btn-primary"></i></a>
                                            <form method="POST"
                                                action="{{ route('admin.destroy', encrypt(2)) }}"
                                                class="action-icon">
                                                @csrf
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
                        {{$Getartist->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        Notiflix.Notify.Init({});
        function StatusUpdate(id, value){
            $.ajax({
                type: "POST",
                url: "/admin/asset/status",
                data: {
                    'id': id,
                    'status': value,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    if (response == 'success') {
                        Notiflix.Notify.Success('Status changed successfully');
                    }else {
                        Notiflix.Notify.Failure("Something went wrong");
                    }
                }
            });
        }

        function changeStatus(slug, id) {
            $.ajax({
                type: "POST",
                url: "#",
                data: {
                    'service_slug': slug,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        $("#status-btn"+ id).load(window.location.href + " #status-btn"+ id);
                        swal('Status updated');
                    }else {
                        swal('Some Error occur, relode the page');
                    }
                }
            });
        }
    </script>
@endsection
