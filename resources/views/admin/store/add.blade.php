@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Store'  )
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-11 card shadow">
                        <div class="card-body">
                            <div class="justify-content-between d-flex">
                                <h6 class="mb-0">Store Add</h6>
                                <a href="{{route('store.index')}}" type="button" class="btn btn-sm btn-primary">List Store</a>
                            </div>
                            <hr>
                            <form action="{{route('store.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <label class="form-label">label Name <span class="text-danger">*</span></label>
                                        <input required type="text" name="label_name" class="form-control" value="{{old('label_name')}}">
                                        <span class="text-danger">
                                            @error('label_name')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-8 mb-4 d-flex">
                                        <div>
                                            <label class="form-label">Image <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input required type="file" class="custom-file-input" id="inputGroupFile01" name="cover_image" accept="image/*" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <img id="blah" alt="your image" style="height: 100px;" />
                                        </div>
                                        <span class="text-danger">
                                            @error('cover_image')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-12 mb-4 text-center">
                                        <button type="submit" class="btn btn-success mr-2">Save</button>
                                        <a href="{{route('store.create')}}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
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