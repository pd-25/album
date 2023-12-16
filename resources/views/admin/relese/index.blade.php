@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Asset-index'  )
@section('content')
    <div class="row justify-content-center">

        <div class="col-lg-10">
            <div class="card">
                <div class="card-title pr">
                    <h4>All Releases</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-title text-right">
                    <a href="{{ route('admin.create') }}" class="btn btn-sm btn-success">Add Release</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Release Title</th>
                                    {{-- <th>Username</th>
                                    <th>Email</th> --}}
                                    <th> Image</th>
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
