@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | Label-create')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form action="{{ route('label.update', encrypt($label->id)) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-title">
                        <h4>Edit Label</h4>
                        @if (Session::has('msg'))
                            <p class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Official Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="label name" name="official_name"
                                            value="{{ $label->official_name }}" required>


                                        @error('official_name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ 'Label name field is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Contact email (private)</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control" placeholder="abc@mail.com" name="email"
                                            value="{{ $label->email }}" disabled>


                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Attach the label image here</label><span class="text-danger">*</span>
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
                                        
                                        <img id="blah" src="{{ asset('storage/LabelImage/'. $label->image) }}" alt="your image"
                                            style="height: 110px; width: 150px;" />
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
                                <label>User</label><span class="text-danger">*</span>
                               <select name="user_id" class="form-control">
                                <option value="">select user</option>
                                @foreach ($users as $user)
                                <option {{  $label->user_id == $user->id ? 'selected': '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                    
                                @endforeach
                               </select>


                                @error('user_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Genres</label><span class="text-danger">*</span>
                               <select name="gener_id[]" class="form-control js-example-basic-multiple" multiple="multiple">
                                @foreach (config('country.genres') as $k => $v)
                                <option {{ $label->genress->contains('genre_id', $k) ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                                    
                                @endforeach
                               </select>


                                @error('gener_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                            <div class="form-group">
                                <label>Description</label><span class="text-danger">*</span>
                                <textarea name="description" class="form-control" cols="40" rows="10">{{ $label->description }}</textarea>


                                @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Contact phone (Private)</label><span class="text-danger">*</span>
                                <input type="number" name="number" class="form-control" value="{{ $label->number }}">


                                @error('number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Location</label><span class="text-danger">*</span>
                                <input type="text" name="location" class="form-control" value="{{ $label->location }}">


                                @error('location')
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

                                <div id="wesite-area">
                                    @foreach ($label->websitelabels as $website)
                                    <div class="row" id="web-id-1">
                                        <div class="col-md-4">
                                            <input type="text" name="webSiteName[]" placeholder="Example: Official Website" value="{{ $website->title }}" class="form-control" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="url[]" value="{{ $website->url }}"  placeholder="http://www.therollingstones.com" class="form-control" required="">
                                        </div>
                                        <div class="col-md-2">
                                            {{-- <span class="btn btn-link blue no-padding-horizontal">Delete</span> --}}
                                            {{-- <span class="btn btn-link blue no-padding-horizontal">Update</span> --}}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

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
                inputText.className = 'form-control';
                inputText.required = true;
                col1.appendChild(inputText);

                var col2 = document.createElement('div');
                col2.className = 'col-md-6';
                var inputUrl = document.createElement('input');
                inputUrl.type = 'url';
                inputUrl.name = 'url[]';
                inputUrl.placeholder = 'http://www.therollingstones.com';
                inputUrl.className = 'form-control';
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
