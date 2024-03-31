@extends('user.main')
@section('title', env('APP_NAME').'Frontstage | Release Details'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        {{-- <div class="d-flex align-items-center">
            <a href="{{route('label.index')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div> --}}
        <div class="ml-4 ">
            <h3 style="font-size: 400">Products</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="input-group mb-3">
                <div class="input-group-prepend border">
                  <span class="input-group-text" style="background:white; border:0px solid white">Filter</span>
                </div>
                <input type="text" id="myInput" onblur="this.setAttribute('readonly', 'readonly');" 
                onfocus="this.removeAttribute('readonly');" readonly class="form-control form-control-sm" name="search" placeholder="&#xF002; Search Artist, Product title, Label, UPC, IRSC, Tracks..." style="font-family:Arial, FontAwesome; background:white; border:1px sold white">
                <div class="input-group-append border">
                  <div class="btn-group">
                    <a class="btn btn-secondary border-0 d-flex align-items-center px-2 rounded-0"  href="{{ route('asset.create') }}" style="background:#8464CB; border:0px solid white">
                       <i class="ti-plus mx-2"></i> Create Release
                    </a>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card" >
                <div class="table-responsive">
                    <table class="table table-sm student-data-table m-t-20">
                        <thead>
                            <tr class="table-info">
                                <th>PRODUCT</th>
                                <th>ARTIST</th>
                                <th>LABEL</th>
                                <th>UPC</th>
                                <th>RELEASE DATE</th>
                                <th>CREATED</th>
                                <th>STATUS</th>
                                <th class="text-center"><i class="ti-settings"></i></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @if (!@empty($Getartist))
                            @foreach ($Getartist as $index=>$item)
                                <tr>
                                    <td> 
                                        @if (!empty(@$item->cover_image))
                                        <div class="d-flex align-ietm-center">
                                            <img style="height: 40px; margin-right:10px " src="{{ asset('storage/'.@$item->cover_image) }}" alt="No image">
                                            <div class="">{{@$item->release_title}}</div>
                                        </div>
                                        @else
                                            <img style="height: 50px;" src="{{asset('noimg.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{@$item->artist_name->name}}
                                    </td>
                                    <td> {{@$item->label_name->official_name}}</td>
                                    <td>{{@$item->upc_ean_jan}}</td>
                                    <td>
                                        @if ($item->relese_date)
                                            {{ date('d M Y', strtotime(@$item->relese_date))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->created_at)
                                            {{ date('d M Y', strtotime(@$item->created_at))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (@$item->status == 0)
                                            <span class="btn btn-outline-primary btn-sm rounded-0 px-4"> Review</span>
                                        @elseif(@$item->status == 1)
                                            <span class="btn btn-outline-success btn-sm rounded-0 px-3"><i class="bi bi-dot"></i> Published</span>
                                        @elseif(@$item->status == 2)
                                            <span class="btn btn-outline-warning btn-sm  rounded-0 px-3">Takedown</span>
                                        @elseif(@$item->status == 3)
                                        <span class="btn btn-outline-danger btn-sm  rounded-0 px-3">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (@$item->status == 0 || @$item->status == 3)
                                        <div class="d-flex">
                                            <div>
                                                <a href="{{route('distribute.index', @$item->id)}}" class="btn btn-sm btn-primary rounded-0 px-2">Distribute</a>
                                            </div>
                                            <div>
                                                <a href="{{ route('asset.edit', @$item->id) }}" class="btn btn-warning rounded-0  btn-sm mx-2"><i class="ti-pencil"></i></a>
                                            </div>
                                            <div>
                                                <form method="POST"
                                                    action="{{ route('asset.destroy', encrypt(2)) }}"
                                                    class="action-icon">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input name="DeleteId" type="hidden" value="{{@$item->id}}">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger rounded-0  delete-icon show_confirm"><i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @elseif(@$item->status == 1)
                                        <a href="{{route('distribute.index', @$item->id)}}" class="btn btn-sm btn-primary rounded-0 px-2">Distribute</a>
                                        <a href="{{ route('asset.edit', @$item->id) }}" class="btn btn-success rounded-0  btn-sm mx-2"><i class="ti-eye"></i></a>
                                        @elseif(@$item->status == 2)
                                        <a href="{{route('distribute.index', @$item->id)}}" class="btn btn-sm btn-primary rounded-0 px-2">Distribute</a>
                                        <a href="{{ route('asset.edit', @$item->id) }}" class="btn btn-success rounded-0  btn-sm mx-2"><i class="ti-eye"></i></a>
                                        @endif
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
