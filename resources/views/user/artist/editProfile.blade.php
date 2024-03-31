@extends('user.main')
@section('title', env('APP_NAME') . ' | Artist-profile')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        {{-- <div class="d-flex align-items-center">
            <a href="{{route('userArtists.index')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div> --}}
        <div class="ml-4 ">
            <h3 style="font-size: 400">Edit User Profile</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <label class="control-label">User Name</label><span class="text-danger"> *</span>
                                <input type="text" class="form-control control-form" placeholder="full name" name="name"
                                    value="{{ auth()->user()->name }}" required>
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ 'Artist name field is required' }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Attach the banner image here</label><span class="text-danger">*</span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input control-form" id="imgInp" aria-describedby="inputGroupFileAddon01"  name="image" value="{{ old('image') }}">
                                            <label class="custom-file-label" for="imgInp">Choose file</label>
                                          </div>
                                        {{-- <input type="file" class="form-control control-form" name="image"
                                            value="{{ old('banner_image') }}" id="imgInp"> --}}
                                        <span>File format: JPG or PNG</span><br>
                                        <span>Recommended minimum width or height: 1400 pixels</span>
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <img id="blah" src="#" alt="your image"
                                            style="height: 110px; width: 150px;" /> --}}
                                        <img id="blah" src="{{ asset('storage/ArtistImage/' . auth()->user()->image) }}"
                                            alt="your image" style="height: 110px; width: 150px;" />
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
                                <label class="control-label">Biography</label><span class="text-danger">*</span>
                                <textarea name="biography" class="form-control control-form-textarea h-auto" rows="4">{{ auth()->user()->biography }}</textarea>
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
                                <label class="control-label">Indicate this artist's IDs if they already have a profile page on these music
                                    services.</label><span class="text-danger">*</span>
                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                            data-placement="top" title=""
                                            style="background-image: url(&quot;{{ asset('spy.png') }}&quot;); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                            data-original-title="Spotify artist ID"></label>
                                    </div>
                                    <div class="col-md-11">
                                        <input class="form-control ui-input has-error control-form" type="text"
                                            value="{{ auth()->user()->spotify_id }}" placeholder="Enter Spotify artist ID"
                                            name="spotify_id" data-bind="value: spotifyId.editable, attr: { maxlength: 22 }"
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
                                        <input class="form-control ui-input control-form" type="number"
                                            value="{{ auth()->user()->apple_id }}"
                                            placeholder="Enter Apple Music artist ID" name="apple_id"
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
                                        <label class="control-label">Description</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Website address (url)</label>
                                    </div>
                                </div>

                                <div id="wesite-area">
                                    @foreach (auth()->user()->websiteArtists as $website)
                                        <div class="row" id="web-id-1">
                                            <div class="col-md-4">
                                                <input type="text" name="webSiteName"
                                                    placeholder="Example: Official Website" value="{{ $website->title }}"
                                                    class="form-control" required="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="url" name="url" value="{{ $website->url }}"
                                                    placeholder="http://www.therollingstones.com" class="form-control"
                                                    required="">
                                            </div>
                                            <div class="col-md-2">
                                                <span class="btn btn-link blue no-padding-horizontal">Delete</span>
                                                <span class="btn btn-link blue no-padding-horizontal">Update</span>
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
                                        <label class="control-label">Description</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Website address (url)</label>
                                    </div>
                                </div>
                                <div id="localization-area">
                                    @foreach (auth()->user()->artistLocal as $artistLoca)
                                        <div class="row" id="localization-id-1">
                                            <div class="col-md-4">
                                                <select class="form-control" name="country[]">
                                                    <option {{ $artistLoca->country == 'US' ? 'selected' : '' }}
                                                        value="US">United States</option>
                                                    <option {{ $artistLoca->country == 'CA' ? 'selected' : '' }}
                                                        value="CA">Canada</option>
                                                    <option {{ $artistLoca->country == 'GB' ? 'selected' : '' }}
                                                        value="GB">United Kingdom</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="artist_name[]"
                                                    value="{{ $artistLoca->artist_name }}"
                                                    placeholder="Artist name written in the chosen language"
                                                    class="form-control" required="">
                                            </div>
                                            <div class="col-md-2">
                                                <span class="btn btn-link blue no-padding-horizontal">Delete</span>
                                                <span class="btn btn-link blue no-padding-horizontal">Update</span>
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

                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <label class="control-label">Password</label><span class="text-info">(If you don't want to change, keep it
                                    blank)</span>
                                <input type="password" class="form-control control-form" placeholder="" name="password" required>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

            d = 1;
            var countryOptions = <?php echo json_encode(config('country.countries'), JSON_HEX_TAG); ?>;

            function addLocalization() {
                var newRow = document.createElement('div');
                newRow.className = 'row';
                newRow.id = 'localization-id-' + d;
                var col1 = document.createElement('div');
                col1.className = 'col-md-4';
                var dropdown = document.createElement('select');
                dropdown.className = 'form-control control-form';
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
                inputUrl.className = 'form-control control-form';
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
