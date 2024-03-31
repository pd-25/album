@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Add News'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Create news </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 card shadow rounded">
            <form action="{{route('news.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-12 d-flex justify-content-between mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Create News</h5>
                        </div>
                        <div>
                           <a href="{{route('news.index')}}">Back</a>
                        </div>
                    </div>
                    <div class="col-8 mb-2">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="news_heading" class="form-control" value="{{old('news_heading')}}">
                        <span class="text-danger">
                            @error('news_heading')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-4 mb-2">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" name="news_date" class="form-control" value="{{old('news_date')}}">
                        <span class="text-danger">
                            @error('news_date')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label">Short Description </label>
                        <textarea id="short_description" type="text" rows="3" name="short_description" class="form-control h-auto"> </textarea>
                        <span class="text-danger">
                            @error('short_description')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label">Long Description </label>
                        <textarea id="editor" type="text" rows="8" name="long_description" class="form-control h-auto"></textarea>
                        <span class="text-danger">
                            @error('long_description')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-4 mb-2">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="custom-select">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        <span class="text-danger">
                            @error('status')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 text-right mb-3">
                        <button class="btn btn-success mr-2" type="submit">Save</button>
                        <a href="{{route('news.create')}}" class="btn btn-danger" type="submit">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
   ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } )
</script>
@endsection