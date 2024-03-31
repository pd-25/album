@extends('admin.layout.main')
@section('title', env('APP_NAME').' |  Support Ticket Category'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Create support ticket category name </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card rounded shadow">
        <div class="card-body">
            <form action="{{route('category.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <input type="hidden" name="id" value="" id="AddId">
                    <div class="col-6 mb-3">
                        <label class="">Support ticket Category Name <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" name="category_name" value="{{old('category_name')}}" id="AddCategoryName" />
                        <span class="text-danger">
                            @error('category_name')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="custom-select" id="AddStatus">
                            <option value="1" >Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        <span class="text-danger">
                            @error('status')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success mr-2" id="ShowAdd">Add Category</button>
                        <button type="submit" class="btn btn-primary mr-2" id="Showupdate">Update Category</button>
                        <a href="{{route('category.index')}}" type="buttom" class="btn btn-danger text-white">Cancel</a>
                    </div>
                </div>
            </form>
            <div class="row mt-4">
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (!@empty($supportTicketCategory))
                                @foreach ($supportTicketCategory as $index=>$item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->category_name}}</td>
                                        <td>
                                            @if (@$item->status == 1)
                                                <span class="text-success">Active <i class="ti-check-box text-success ml-2"></i></span>
                                            @else
                                                <span class="text-danger">Deactive <i class="ti-na text-danger ml-2"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="editCategory({{$item}})"><i class="ti-pencil btn btn-sm btn-primary"></i></a>
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
        $(document).ready(function() {
            $('#Showupdate').hide();
        });

        function editCategory(data){
            $('#AddId').val(data.id);
            $('#AddCategoryName').val(data.category_name);
            $('#AddStatus').val(data.status);

            $('#ShowAdd').hide();
            $('#Showupdate').show();
        }
    </script>
@endsection