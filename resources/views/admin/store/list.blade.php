@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Store'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">All Store </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-12 card shadow rounded">
                        <div class="card-body">
                            <div class="justify-content-between d-flex">
                                <h6 class="mb-0">Store List</h6>
                                <a href="{{route('store.create')}}" type="button" class="btn btn-sm btn-primary">Add Store</a>
                            </div>
                            <hr>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Label Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (!@empty($store))
                                            @foreach ($store as $index=>$item)
                                                <tr>
                                                    <th scope="row">{{$index+1}}</th>
                                                    <td>{{$item->label_name}}</td>
                                                    <td>
                                                        <img style="height: 50px;" src="{{asset('storage/store/'.@$item->cover_image)}}" alt="Img">
                                                    </td>
                                                    <td>
                                                        @if (@$item->status == 1)
                                                            <i class="ti-check-box text-success"></i>
                                                        @else
                                                            <i class="ti-na text-danger"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('store.edit', @$item->id) }}"><i
                                                        class="ti-pencil btn btn-sm btn-primary"></i></a>
                                                        <form method="POST"
                                                            action="{{ route('store.destroy', encrypt(2)) }}"
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
                            {{@$store->appends(request()->input())->links()}}
                        </div>
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