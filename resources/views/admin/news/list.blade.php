@extends('admin.layout.main')
@section('title', env('APP_NAME').' | News'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">All news </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 card shadow rounded">
            <div class="row my-3">
                <div class="col-6">
                    <input type="text" id="myInputNews" class="form-control" name="search" placeholder="Search news heading">
                </div>
                <div class="col-6 text-right">
                    <a href="{{route('news.create')}}" class="btn btn-primary btn-sm">Add News</a>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="myTableNews">
                        @if (!@empty($news))
                            @foreach ($news as $index=>$item)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->news_heading}}</td>
                                    <td>
                                        @if (@$item->status == 1)
                                            <span class="text-success">Active News <i class="ti-check-box text-success ml-2"></i></span>
                                        @else
                                            <span class="text-danger">Deactive News <i class="ti-na text-danger ml-2"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('news.edit', @$item->id) }}"><i
                                        class="ti-pencil btn btn-sm btn-primary"></i></a>
                                        <form method="POST"
                                            action="{{ route('news.destroy', encrypt(2)) }}"
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
            {{@$news->appends(request()->input())->links()}}
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>

    </script>
@endsection