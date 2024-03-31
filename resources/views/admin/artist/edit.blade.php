@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | Artist-Edit')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Edit artist </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form action="{{ route('artists.update', encrypt($artist->id)) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-title">
                        <h4>Edit Artist</h4>
                        @if (Session::has('msg'))
                            <p class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Name</label><span class="text-danger">*</span>
                                        <select name="user_id" class="form-control" id="">
                                            @foreach ($users as $item)
                                                <option value="{{@$item->id}}" {{$item->user_id == $artist->user_id ? 'selected': ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ 'User name field is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Artist Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="full name" name="name"
                                            value="{{ $artist->name }}" required>


                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ 'Artist name field is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control" placeholder="abc@mail.com" name="email"
                                            value="{{$artist->email }}" required>


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
                                        <label>Attach the banner image here</label><span class="text-danger">*</span>
                                        <input type="file" class="form-control" name="image"
                                             id="imgInp">
                                        <span>File format: JPG or PNG</span><br>
                                        <span>Recommended minimum width or height: 1400 pixels</span>
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <img id="blah" src="{{ asset('storage/ArtistImage/'. $artist->image) }}" alt="your image"
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
                                <label>Biography</label><span class="text-danger">*</span>
                                <textarea name="biography" class="form-control" cols="40" rows="10">{{ $artist->biography }}</textarea>


                                @error('biography')
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
                        <h4>Artist Profile IDs</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                            <div class="form-group">
                                <label>Indicate this artist's IDs if they already have a profile page on these music
                                    services.</label><span class="text-danger">*</span>
                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                            data-placement="top" title=""
                                            style="background-image: url(&quot;{{ asset('spy.png') }}&quot;); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                            data-original-title="Spotify artist ID"></label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control ui-input has-error" type="text" value="{{ $artist->spotify_id }}"
                                            placeholder="Enter Spotify artist ID" name="spotify_id"
                                            data-bind="value: spotifyId.editable, attr: { maxlength: 22 }"
                                            title="Invalid Spotify Id, it must start with a number from 0 to 7, followed by 21 characters, which must be either a number or letter from Latin alphabet."
                                            maxlength="22" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                            data-placement="top" title=""
                                            style="background-image: url(&quot;{{ asset('aple.png') }}&quot;); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                            data-original-title="Apple Music artist ID"></label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control ui-input" type="number"
                                            placeholder="Enter Apple Music artist ID" name="apple_id" value="{{ $artist->apple_id }}"
                                            data-bind="value: appleId.editable, attr: { maxlength: 10 }" maxlength="10"
                                            title="" required>
                                    </div>
                                </div>




                                @error('user_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ 'Artist name field is required' }}</strong>
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
                                    @foreach ($artist->websiteArtists as $website)
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

                <div class="card">
                    <div class="card-title">
                        <h4>Artist Name Localization </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Description</label>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                </div>

                                <div id="localization-area">
                                    @foreach ($artist->artistLocal as $artistLoca)
                                        <div class="row" id="localization-id-1">
                                            <div class="col-md-4">
                                                <select class="form-control" name="country[]">
                                                    @foreach (config('country.countries') as $key => $value)
                                                    <option {{ $artistLoca->language == $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                    
                                                   
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="artist_name[]"
                                                    value="{{ $artistLoca->name }}"
                                                    placeholder="Artist name written in the chosen language"
                                                    class="form-control" required="">
                                            </div>
                                           
                                        </div>
                                    @endforeach
                                </div>

                                <div onclick="addLocalization()">
                                    <span class="text-blue bold large vertical-sub link-cursor"> + </span>
                                    <span class="btn btn-link blue no-padding-horizontal">Add Localization</span>
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

            d = 1;
            var countryOptions = <?php echo json_encode(config('country.countries'), JSON_HEX_TAG); ?>;

            function addLocalization() {
                var newRow = document.createElement('div');
                newRow.className = 'row';
                newRow.id = 'localization-id-' + d;
                var col1 = document.createElement('div');
                col1.className = 'col-md-4';
                var dropdown = document.createElement('select');
                dropdown.className = 'form-control';
                dropdown.name = 'country[]';

                for (var countryCode in countryOptions) {
                    if (countryOptions.hasOwnProperty(countryCode)) {
                        var option = document.createElement('option');
                        option.value = countryCode;
                        option.text = countryOptions[countryCode];
                        dropdown.appendChild(option);
                    }
                }
                // Add the dropdown to col1
                col1.appendChild(dropdown);

                var col2 = document.createElement('div');
                col2.className = 'col-md-6';
                var inputUrl = document.createElement('input');
                inputUrl.type = 'text';
                inputUrl.name = 'artist_name[]';
                inputUrl.placeholder = 'Artist name written in the chosen language';
                inputUrl.className = 'form-control';
                inputUrl.required = true;

                col2.appendChild(inputUrl);

                var col3 = document.createElement('div');
                col3.className = 'col-md-2';
                var deleteBtn = document.createElement('span');
                deleteBtn.className = 'btn btn-link blue no-padding-horizontal';
                deleteBtn.textContent = 'Delete';
                deleteBtn.onclick = function() {
                    remLocalization(d);
                };
                console.log(col3);
                console.log(deleteBtn);
                col3.appendChild(deleteBtn);

                newRow.appendChild(col1);
                newRow.appendChild(col2);
                newRow.appendChild(col3);
                // console.log(newRow);

                document.getElementById("localization-area").appendChild(newRow);
                c++;
            }
        </script>

    @endsection
