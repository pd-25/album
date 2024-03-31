@extends('user.main')
@section('title', env('APP_NAME') . ' | Label-create')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        <div class="d-flex align-items-center">
            <a href="{{route('labels.index')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="ml-4 ">
            <h3 style="font-size: 400">Create New Label</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form action="{{ route('labels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Official Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="label name" name="official_name"
                                            value="{{ old('official_name') }}" required>
                                        @error('official_name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ 'Label name field is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Contact email (private)</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control" placeholder="abc@mail.com" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <label>Attach the banner image here</label><span class="text-danger">*</span>
                                        <input type="file" class="form-control" name="image"
                                            value="{{ old('image') }}" id="imgInp">
                                        <span>File format: JPG or PNG</span><br>
                                        <span>Recommended minimum width or height: 1400 pixels</span>
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <img id="blah" src="#" alt="your image"
                                            style="height: 110px; width: 150px;" />
                                    </div> --}}
                                    <div class="col-8">
                                        <label class="control-label">Label Image</label></span>
                                        <div class="d-flex">
                                            <div>
                                                <input type="image" src="{{asset('admin-asset/images/photo.png')}}" onclick="UploadLabelImage()" style="height:100px">
                                                <input required type="file" class="custom-file-input" name="image" accept="image/*"
                                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0]);" id="UploadLabelImages" style="display: none">
                                            </div>
                                            <div class="ImageHidden text-center">
                                                <img id="blah" alt="your image" style="height: 200px;" />
                                            </div>
                                            @error('image')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <ul class="text-secondary">
                                            <li>
                                                File format: JPG or PNG.
                                            </li>
                                            <li>
                                                Recommended minimum width or height: 1400 pixels.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <h4>Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <label class="control-label">Genres</label>
                                <select name="gener_id[]" id="multipleSelect" class="form-control js-example-basic-multiple" multiple="multiple">
                                    @foreach (config('country.genres') as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                   </select>
                                @error('gener_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Official Name</label><span class="text-danger">*  <a type="button" class="text-info" data-toggle="tooltip" title="This is how your artist name will appear on the web, iTunes, ect...?">
                                    <i class="ti-help-alt"></i></a>
                                    </span> 
                                
                                <input type="text" class="form-control control-form" placeholder="Enter name" name="official_name"
                                    value="{{ old('official_name') }}" required>
                                @error('official_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ 'Label name field is required' }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" class="form-control h-auto control-form-textarea" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contact email (private)</label>
                                <input type="email" class="form-control control-form" placeholder="Enter valid email" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contact phone (Private)</label>
                                <input type="number" name="number" class="form-control control-form" value="{{ old('number') }}" placeholder="xxx-xxx-xxxx">
                                @error('number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <h4>Websites</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Description</label>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Website address (url)</label>
                                    </div>
                                </div>
                                <div id="wesite-area"></div>
                                <div onclick="addWeb()">
                                    <span class="text-blue bold large vertical-sub link-cursor"> + </span>
                                    <span class="btn btn-link blue no-padding-horizontal">Add website</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    @endsection
    @section('script')
        <script>
            $( document ).ready(function() {
                $('.ImageHidden').hide();
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            });
            function UploadLabelImage(){
                $("#UploadLabelImages").click();
                $('.ImageHidden').show();
            }

            var c = 1;
            function addWeb() {
                var newRow = document.createElement('div');
                newRow.className = 'row';
                newRow.id = 'web-id-' + c;

                var col1 = document.createElement('div');
                col1.className = 'col-md-4';
                var inputText = document.createElement('input');
                inputText.type = 'text';
                inputText.name = 'webSiteName[]';
                inputText.placeholder = 'Example: Official Website';
                inputText.className = 'form-control control-form';
                inputText.required = true;
                col1.appendChild(inputText);

                var col2 = document.createElement('div');
                col2.className = 'col-md-6';
                var inputUrl = document.createElement('input');
                inputUrl.type = 'url';
                inputUrl.name = 'url[]';
                inputUrl.placeholder = 'http://www.therollingstones.com';
                inputUrl.className = 'form-control control-form';
                inputUrl.required = true;
                col2.appendChild(inputUrl);

                var col3 = document.createElement('div');
                col3.className = 'col-md-2';
                var deleteBtn = document.createElement('span');
                deleteBtn.className = 'btn btn-link blue no-padding-horizontal';
                deleteBtn.textContent = 'Delete';
                deleteBtn.onclick = function() {
                    remWeb(c);
                };
                console.log(col3);
                console.log(deleteBtn);
                col3.appendChild(deleteBtn);

                newRow.appendChild(col1);
                newRow.appendChild(col2);
                newRow.appendChild(col3);
                // console.log(newRow);

                document.getElementById("wesite-area").appendChild(newRow);
                c++;
            }

            function remWeb(divNo) {
                var elementToRemove = document.getElementById('web-id-' + divNo);
                if (elementToRemove) {
                    elementToRemove.remove();
                }
            }

            
        </script>

    @endsection
