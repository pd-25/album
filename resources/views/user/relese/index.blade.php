@extends('user.main')
@section('title', env('APP_NAME').' | Asset-index'  )
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card rounded shadow">
                <div class="card-title pr">
                    <h4>All Releases</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-title text-right">
                    <a href="{{ route('asset.create') }}" class="btn btn-sm btn-success">Add Release</a>

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
                            <tbody>
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
                                        <td>
                                            @if (@$item->status == 0)
                                                <span class="text-info">Review</span>
                                            @elseif(@$item->status == 1)
                                                <span class="text-success">Approved</span>
                                            @elseif(@$item->status == 2)
                                                <span class="text-danger">Track down</span>
                                            @endif
                                        </td>
                                        {{-- <td><span id="status-btn{{ $artist->id }}">
                                            <button class="btn btn-sm {{ $artist->status == 'Available' ? 'btn-success' : ($artist->status == 'Inactive' ? 'bg-danger' : 'bg-warning'); }}"  onclick="changeStatus('{{ $artist->id }}', {{ $artist->id}})" >
                                                {{ $artist->status }}
                                            </button>
                                        </span>
                                        </td> --}}
                                        <td>
                                            @if (@$item->status == 0)
                                                <a href="{{ route('asset.edit', @$item->id) }}"><i
                                                        class="ti-pencil btn btn-sm btn-primary"></i></a>
                                                <form method="POST"
                                                    action="{{ route('asset.destroy', encrypt(2)) }}"
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
                                            @elseif(@$item->status == 1)
                                                <a href="{{ route('asset.edit', @$item->id) }}"><i
                                                class="ti-pencil btn btn-sm btn-primary"></i></a>
                                            @elseif(@$item->status == 2)
                                                <span class="text-danger">Not Allowed</span>
                                            @endif
                                            {{-- <a href="{{ route('artists.show', encrypt($artist->id)) }}"><i
                                                class="ti-eye btn btn-sm btn-success"></i></a> --}}
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
