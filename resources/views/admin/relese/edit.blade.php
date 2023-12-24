@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | release-edit')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="">
                <form class="myform" action="{{ route('admin.update', @$allDetails->id) }}" method="POST" id="yourFormId" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="wizard" class="shadow" style="margin-right:0px; margin-left:15px">
                        <!-- SECTION 1 -->
                        <h4></h4>
                        <section>
                            <div class="row">
                                <div class="col-md-6" style="margin-left: -14px">
                                    <h6><b>Add User <span class="text-danger">*</span></b></h6>
                                    <select required name="userId" class="custom-select">
                                        <option value="">select user</option>
                                        @if (!@empty($users))
                                        @foreach ($users as $k=> $user)
                                            <option value="{{ $user->id }}" {{$allDetails->user_id== $user->id ? 'selected':''}}>{{ $user->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('userId')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-12" style="margin-left: -14px">
                                    <h6><b>Cover image <span class="text-danger">*</span></b></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="file" class="custom-file-input" name="cover_image" accept="image/*" placeholder="Name"
                                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" id="inputGroupFile02">
                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        <img id="blah" alt="your image"
                                            style="height: 300px;" src="{{asset('storage/'.@$allDetails->cover_image)}}" />
                                    </div>
                                    <span class="text-danger">
                                        @error('cover_image')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <ul>
                                            <li>File format: PNG, GIF, BMP, TIF, JPG or JPEG</li>
                                            <li> Color space: RGB</li>
                                            <li>Minimum dimensions: 1400x1400 pixels, but recommend 3000x3000 pixels.</li>
                                            <li>Square image: width and height must be the same.</li>
                                            <li>Images may not contain more than 50 megapixels or be larger than 10 Mb.</li>
                                            <li>Your image cannot be stretched, upscaled, or appear to be low-resolution.
                                            </li>
                                            <li>The information on your cover art must match your album title and artist
                                                name.</li>
                                            <li>Website addresses, social media links and contact information are not
                                                permitted on album artwork.</li>
                                            <li> Your cover art may not include sexually explicit imagery.</li>
                                            <li>Your cover art cannot be misleading by figuring another artist's name more
                                                prominently than yours.</li>
                                            <li>You may not use a third-party logo or trademark without the express written
                                                permission from the trademark holder.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6><b>Language</b></h6>
                                    <div class="form-row">
                                        <h6>In what language will you be writing your titles, artist name(s) and release
                                            description? <span class="text-danger">*</span> </h6>

                                        <select required name="language" class="custom-select js-example-basic-single">
                                            <option value="">select language</option>
                                            @foreach (config('country.languages') as $k => $lan)
                                                <option value="{{ $lan }}" {{old('language', $allDetails->language)== $lan ? 'selected':''}}>{{ $lan }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('language')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h6 class="mb-0"><b>Title</b></h6>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="mb-0">Release title <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-0"> Title version </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input required type="text" name="release_title" class="form-control"
                                            placeholder="name of your release" value="{{@$allDetails->release_title}}">
                                    </div>
                                    <span class="text-danger">
                                        @error('release_title')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" name="title_version" class="form-control"
                                            placeholder="title version" value="{{@$allDetails->title_version}}">
                                    </div>
                                    <span class="text-danger">
                                        @error('title_version')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h6><b>Artist</b></h6>
                                    <div class="form-row">
                                        <h6>Is this a compilation of various artists? <span class="text-danger">*</span></h6>
                                        <div class="ml-5 row">
                                            <div class="col-6">
                                                <input required type="radio" class="form-check-input" name="is_various_artist"  value="1" {{ ($allDetails->is_various_artist=="1") ? "checked" : "" }} id="">Yes
                                            </div>
                                            <div class="col-6">
                                                <input required type="radio" class="form-check-input" name="is_various_artist"
                                                    id="" value="0" {{ ($allDetails->is_various_artist=="0") ? "checked" : "" }}>No
                                            </div>
                                            <span class="text-danger">
                                                @error('is_various_artist')
                                                <strong>{{ $message }}</strong>
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h6><b>Artist(s) – indicate ONLY ONE per field <span class="text-danger">*</span></b></h6>
                                    <div class="form-row">
                                        <select required name="asset_artist_id" class="form-control js-example-basic-single"
                                            id="">
                                            <option value="">select artist</option>
                                            @foreach ($artists as $ass_artist)
                                                <option value="{{ $ass_artist->id }}" {{ (@$allDetails->asset_artisat_details->asset_artist_id== $ass_artist->id) ? "Selected" : "" }}>{{ $ass_artist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger">
                                        @error('asset_artist_id')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Spotify? <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required class="form-check-input checkValueRadio" type="radio" onclick="handleClick(this);" name="has_spotify_asset"
                                                value="1" {{ (@$allDetails->asset_artisat_details->has_spotify_asset=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required class="form-check-input checkValueRadio" type="radio" onclick="handleClick(this);" name="has_spotify_asset" value="0" {{ (@$allDetails->asset_artisat_details->has_spotify_asset=="0") ? "checked" : "" }}>No
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('has_spotify_asset')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div id="enterSP" class="d-none">
                                        <input type="text" class="form-control" name="spotify_id_ass"
                                            placeholder="enter spotify ID" value="{{@$allDetails->asset_artisat_details->spotify_id_ass}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Apple Music? <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required type="radio" onclick="handleClickA(this);" class="form-check-input" name="has_applemusic_asset"
                                                value="1" {{ ($allDetails->asset_artisat_details->has_applemusic_asset=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" onclick="handleClickA(this);" class="form-check-input"
                                                name="has_applemusic_asset" value="0" {{ ($allDetails->asset_artisat_details->has_applemusic_asset=="0") ? "checked" : "" }}>No
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('has_applemusic_asset')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div id="enterAP" class="d-none">
                                        <input type="text" class="form-control" name="apple_id_ass"
                                            placeholder="enter apple ID" value="{{ $allDetails->asset_artisat_details->apple_id_ass}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h6><b>Info</b></h6>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <h6>Genre 1 <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Genre 2 </h6>
                                </div>

                                <div class="col-md-6">
                                    <select required name="genre_one" id="" class="form-control js-example-basic-single">
                                        <option value="">select genre1</option>
                                        @foreach (config('country.genres') as $k => $g_one)
                                            <option value="{{ $g_one }}" {{ ($allDetails->genre_one==$g_one) ? "selected" : "" }}>{{ $g_one }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('genre_one')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <select name="genre_two" id="" class="form-control js-example-basic-single">
                                        <option value="">select genre2</option>
                                        @foreach (config('country.genres') as $k => $g_two)
                                            <option value="{{ $g_two }}" {{ ($allDetails->genre_two==$g_two) ? "selected" : "" }}>{{ $g_two }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('genre_two')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>(P) Copyright <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>(C) Copyright <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" name="p_copy" class="form-control"
                                        placeholder="2008 AMC inc" value="{{$allDetails->p_copy}}">
                                    <span class="text-danger">
                                        @error('p_copy')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span> 
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" name="c_copy" class="form-control"
                                        placeholder="2008 AMC inc" value="{{$allDetails->c_copy}}">
                                        <span class="text-danger">
                                            @error('c_copy')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>Previously released? <span class="text-danger">*</span></h6>
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required type="radio" onclick="handleClickRD(this);" name="previously_release" class="form-check-input" value="1" {{ ($allDetails->previously_release=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" onclick="handleClickRD(this);" class="form-check-input" name="previously_release" value="0" {{ ($allDetails->previously_release=="0") ? "checked" : "" }}>No
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('previously_release')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-none" id="prelesr">
                                        <input type="date" name="release_date" class="form-control" id="" value="{{date('Y-m-d', strtotime(@$allDetails->release_date))}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6>Label name <span class="text-danger">*</span></h6>
                                    <select required name="label_id" class="form-control js-example-basic-single" id="">
                                        @foreach ($labels as $label)
                                            <option value="{{ $label->id }}" {{ ($allDetails->label_id==$label->id ) ? "selected" : "" }}>{{ $label->official_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h6>Internal release ID <span class="text-danger">*</span></h6>
                                    <input required readonly type="text" name="internal_release_id" class="form-control"
                                        id="" value="{{$allDetails->internal_release_id}}">
                                        <span class="text-danger">
                                            @error('internal_release_id')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>Do you already have a UPC/EAN/JAN? </h6>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" name="upc_ean_jan" class="form-control"
                                        placeholder="xxxxxxxxx" id="" value="{{$allDetails->upc_ean_jan}}" >
                                
                                        <span class="text-danger">
                                            @error('upc_ean_jan')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                </div>
                            </div>
                        </section> <!-- SECTION 2 -->
                        <h4></h4>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><b>Audio file <span class="text-danger">*</span></b></h6>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="file" onchange="previewFile()" accept="audio/*" class="custom-file-label" name="audio" id="inputGroupFi">
                                            <label class="custom-file-label" for="inputGroupFi">Choose file</label>
                                        </div>
                                        <div class="col-6">
                                            {{-- <source src="{{asset('storage/audio/m4a/'.@$allDetails->track_details->audio)}}" type="audio/ogg"> --}}
                                                <audio controls src="{{asset('storage/'.@$allDetails->track_details->audio)}}"></audio>
                                            <div id="resultImage"></div>
                                        </div>
                                        {{-- <input required type="file" class="custom-file-input" name="audio" accept="audio/*" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label> --}}
                                    </div>
                                    <span class="text-danger">
                                        @error('audio')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Language of lyrics <span class="text-danger">*</span></b></h6>
                                        <select required name="language_t623" id=""
                                            class="custom-select">
                                            <option value="">select language</option>
                                            @foreach (config('country.languages') as $k => $lanT)
                                                <option value="{{ $lanT }}" 
                                                {{$allDetails->track_details->language_t== $lanT ? 'selected':''}}>{{ $lanT }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('language_t623')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6><b>Track title <span class="text-danger">*</span></b></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6><b>Title version </b></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input required type="text" name="track_title" class="form-control" id="" value="{{@$allDetails->track_details->track_title_version}}">
                                    </div>
                                    <span class="text-danger">
                                        @error('track_title')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input  type="text" name="track_title_version" class="form-control" id=""  value="{{@$allDetails->track_details->title_version}}">
                                    </div>
                                    <span class="text-danger">
                                        @error('track_title_version')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Artist <span class="text-danger">*</span></b></h6>
                                        <select required name="contritibutor_track_artist_id"
                                            class="custom-select" id="">
                                            <option value="">select artist</option>
                                            @foreach ($artists as $ass_artist)
                                                <option value="{{ $ass_artist->id }}" {{ $allDetails->track_artisat_details->track_artist_id == $ass_artist->id ? 'selected':''}}>{{ $ass_artist->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('contritibutor_track_artist_id')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h6>Artist already on Spotify? <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required class="form-check-input" type="radio" onclick="handleClickTrack(this);"
                                                name="contritibutor_has_spotify" value="1" {{ ($allDetails->track_artisat_details->has_spotify=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required class="form-check-input" type="radio" onclick="handleClickTrack(this);"
                                                name="contritibutor_has_spotify" value="0" {{ ($allDetails->track_artisat_details->has_spotify=="0") ? "checked" : "" }}>No
                                        </div>
                                        <span class="text-danger">
                                            @error('contritibutor_has_spotify')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickTrack" class="d-none">
                                        <input type="text" class="form-control"
                                            name="contritibutor_track_spotify_id" placeholder="enter spotify ID" value="{{$allDetails->track_artisat_details->track_spotify_id}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Apple Music? <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input class="form-check-input" required type="radio" onclick="handleClickATrack(this);"
                                                name="contritibutor_has_applemusic" value="1" {{ ($allDetails->track_artisat_details->has_applemusic=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" onclick="handleClickATrack(this);" class="form-check-input"
                                                name="contritibutor_has_applemusic" value="0" {{ ($allDetails->track_artisat_details->has_applemusic=="0") ? "checked" : "" }}>No
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('contritibutor_has_applemusic')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickATrack" class="d-none">
                                        <input type="text" class="form-control"
                                            name="contritibutor_track_apple_id" placeholder="enter apple ID" value="{{$allDetails->track_artisat_details->track_apple_id}}">
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-12">
                                    <h6>Do you have ISRC code? <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required class="form-check-input" type="radio" onclick="handleClickISRC(this);" name="has_isrc"
                                                value="1" {{ ($allDetails->track_details->has_isrc=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" onclick="handleClickISRC(this);" class="form-check-input"
                                                name="has_isrc" value="0" {{ ($allDetails->track_details->has_isrc=="0") ? "checked" : "" }}>No
                                            <span id="noIsrc" class="">(Ok, we will generate for you)</span>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('has_isrc')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickISRC" class="d-none">
                                        <input type="text" name="isrc_code" class="form-control" placeholder="ISRC" value="{{@$allDetails->track_details->isrc_code}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Explicit lyrics? <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required class="form-check-input" type="radio" name="explicit_lyrics" value="1" {{ ($allDetails->track_details->explicit_lyrics=="1") ? "checked" : "" }}>Yes
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" class="form-check-input" name="explicit_lyrics" value="0" {{ ($allDetails->track_details->explicit_lyrics=="0") ? "checked" : "" }}>No
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('explicit_lyrics')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <h6>The track is: <span class="text-danger">*</span> </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-4 ml-3">
                                            <input required class="form-check-input" type="radio" onclick="trackIs(this);" name="original_public"
                                                value="1" {{ ($allDetails->track_details->original_public=="1") ? "checked" : "" }}>An original song (publishing info will be required)
                                        </div>
                                        <div class="col-6">
                                            <input required type="radio" onclick="trackIs(this);" class="form-check-input" name="original_public" value="0"  {{ ($allDetails->track_details->original_public=="0") ? "checked" : "" }}>A public domain song (publishing info
                                            will be required)
                                        </div>
                                        <span class="text-danger">
                                            @error('original_public')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div id="trackIssecond" class="d-none"
                                        style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                        <p>
                                            Public​ ​domain​ ​compositions​ ​are​ ​ones​ ​in​ ​which​ ​the
                                            intellectual​ ​property​ ​rights​ ​have​ ​expired​ ​or​ ​been​ ​forfeited.
                                            This​ ​generally​ ​applies​ ​to​ ​songs​ ​written​ ​before​ ​1923.
                                        </p>
                                    </div>
                                    <div id="trackIsfirst" class="d-none"
                                        style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                        <p>
                                            An​ ​original​ ​composition​ ​is​ ​a​ ​track​ ​to​ ​which​ ​you’ve​ ​contributed
                                            lyrics​ ​and/or​ ​music,​ ​but​ ​which​ ​does​ ​NOT​ ​borrow​ ​elements
                                            from​ ​previously​ ​created​ ​works.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Advance info</b></h6>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <h6>Genre 1 <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Genre 2 </h6>
                                </div>

                                <div class="col-md-6">
                                    <select required name="genre_one_track" id=""
                                        class="custom-select">
                                        <option value="">select genre1</option>
                                        @foreach (config('country.genres') as $k => $t_one)
                                            <option value="{{ $t_one }}" {{ ($allDetails->track_details->genre_one_track==$t_one) ? "selected" : "" }}>{{ $t_one }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('genre_one_track')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">

                                    <select name="genre_two_track" id=""
                                        class="custom-select">
                                        <option value="">select genre2</option>
                                        @foreach (config('country.genres') as $k => $t_two)
                                            <option value="{{ $t_two }}" {{ ($allDetails->track_details->genre_two_track==$t_two) ? "selected" : "" }}>{{ $t_two }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('genre_two_track')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>(P) Copyright <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>(C) Copyright <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" name="p_copy_t" class="form-control"
                                        placeholder="2008 AMC inc" value="{{$allDetails->track_details->p_copy_t}}">
                                        <span class="text-danger">
                                            @error('p_copy_t')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" name="c_copy_t" class="form-control"
                                        placeholder="2008 AMC inc" value="{{$allDetails->track_details->c_copy_t}}">
                                        <span class="text-danger">
                                            @error('c_copy_t')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>Label name <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Internal track ID <span class="text-danger">*</span></h6>
                                </div>

                                <div class="col-md-6">
                                    <select required name="track_label_id" class="custom-select">
                                        @foreach ($labels as $label_t)
                                            <option value="{{ $label_t->id }}" {{ ($allDetails->track_details->track_label_id==$label_t->id) ? "selected" : "" }}>{{ $label_t->official_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('track_label_id')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <input readonly required type="text" name="internal_track_id" class="form-control" value="{{$allDetails->track_details->internal_track_id}}">
                                    <span class="text-danger">
                                        @error('internal_track_id')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Lyrics (Optional)</b></h6>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 18px">
                                <textarea name="lyrics" id="" class="form-control"
                                    placeholder="Any order note about delivery or special offer" style="height: 108px">{{$allDetails->track_details->lyrics}}</textarea>
                            </div>


                        </section> <!-- SECTION 3 -->
                        <h4></h4>
                        <section>
                            <h6>Add more contributor *</h6>
                            <div class="row">

                                <div class="col-md-6">
                                    <h6>Contributor name <span class="text-danger">*</span></h6>
                                    <select required name="contritibutor_track_artist_name"
                                        class="custom-select" id="">
                                        <option value="">select contributor</option>
                                        @foreach ($artists as $ass_artist)
                                            <option value="{{ $ass_artist->id }}" {{ ($allDetails->track_artisat_details->track_artist_name==$ass_artist->id) ? "selected" : "" }}>{{ $ass_artist->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('contritibutor_track_artist_name')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-4">
                                    <h6>Role <span class="text-danger">*</span></h6>
                                    <select required name="contritibutor_role" class="custom-select">
                                        <option value="">select role</option>
                                        <option value="Adaptor" {{@$allDetails->track_artisat_details->role == 'Adaptor' ? 'selected':''}}>Adaptor</option>
                                        <option value="Arranger" {{@$allDetails->track_artisat_details->role == 'Arranger' ? 'selected':''}}>Arranger</option>
                                        <option value="Composer" {{@$allDetails->track_artisat_details->role == 'Composer' ? 'selected':''}}>Composer</option>
                                        <option value="Composer&Lyricist" 
                                        {{@$allDetails->track_artisat_details->role == 'Composer&Lyricist' ? 'selected':''}}>Composer&Lyricist</option>
                                        <option value="Income Participant" 
                                        {{@$allDetails->track_artisat_details->role == 'Income Participant' ? 'selected':''}}>Income Participant</option>
                                        <option value="Lyricist" {{@$allDetails->track_artisat_details->role == 'Lyricist' ? 'selected':''}}>Lyricist</option>
                                        <option value="Sub-Author" 
                                        {{@$allDetails->track_artisat_details->role == 'Sub-Author' ? 'selected':''}}>Sub-Author</option>
                                        <option value="Translator" {{@$allDetails->track_artisat_details->role == 'Translator' ? 'selected':''}}>Translator</option>
                                        <option value="Writer" {{@$allDetails->track_artisat_details->role == 'Writer' ? 'selected':''}}>Writer</option>

                                    </select>
                                    <span class="text-danger">
                                        @error('contritibutor_role')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-2">
                                    <h6>Share <span class="text-danger">*</span></h6>
                                    <input required type="number" name="contritibutor_share" class="form-control" value="{{@$allDetails->track_artisat_details->share}}">
                                    <span class="text-danger">
                                        @error('contritibutor_share')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-6">
                                    <h6>Publishing <span class="text-danger">*</span></h6>
                                    <select required name="contritibutor_publishing" class="custom-select">
                                        <option value="">select publishing</option>
                                        <option value="Copyright control (self-published)" {{@$allDetails->track_artisat_details->publishing == 'Copyright control (self-published)' ? 'selected':''}}>Copyright control (self-published)</option>
                                        <option value="Public domain (no publisher)" {{@$allDetails->track_artisat_details->publishing == 'Public domain (no publisher)' ? 'selected':''}}>Public domain (no publisher)</option>
                                        <option value="Published (managed by a publisher)" {{@$allDetails->track_artisat_details->publishing == 'Published (managed by a publisher)' ? 'selected':''}}>Published (managed by a publisher)</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('contritibutor_publishing')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </section> <!-- SECTION 4 -->
                        <h4></h4>
                        <section>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6"
                                    stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6"
                                    stroke-linecap="round" stroke-miterlimit="10"
                                    points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                            </svg>
                            <p class="success">You have fill up the form sucessfully. Submit it for approval</p>
                            <div class="text-right">
                                <a id="PreviewData" href="#" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#exampleModalCenter">Preview </a>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4" style="margin-left: -14px">
                    <label class="form-label"><b>Add User </b></label>
                    <select disabled required name="userId" class="custom-select">
                        <option value="">select user</option>
                        @if (!@empty($users))
                        @foreach ($users as $k=> $user)
                            <option value="{{ $user->id }}" {{$allDetails->user_id== $user->id ? 'selected':''}}>{{ $user->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <div>
                        <label class="form-label"><b>Cover image</b></label>
                    </div>
                    <div>
                        <img id="blah" alt="your image" style="height:200px;" src="{{asset('storage/'.@$allDetails->cover_image)}}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label> <b>Language</b></label>
                    </div>
                    <div>
                        <select required name="language" class="custom-select" disabled>
                            <option value="">select language</option>
                            @foreach (config('country.languages') as $k => $lan)
                                <option value="{{ $lan }}" {{old('language', $allDetails->language)== $lan ? 'selected':''}}>{{ $lan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Release title </label>
                        <input required type="text" disabled name="release_title" class="form-control"
                        placeholder="name of your release" value="{{@$allDetails->release_title}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"> Title version </label>
                        <input required type="text" disabled name="title_version" class="form-control"
                            placeholder="title version" value="{{@$allDetails->title_version}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"><b>Artist</b></label>
                        <div class="ml-5 row">
                            <div class="col-6">
                                <input required type="radio" class="form-check-input" name="is_various_artist"  value="1" {{ ($allDetails->is_various_artist=="1") ? "checked" : "" }} id="">Yes
                            </div>
                            <div class="col-6">
                                <input required type="radio" class="form-check-input" name="is_various_artist"
                                    id="" value="0" {{ ($allDetails->is_various_artist=="0") ? "checked" : "" }}>No
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div>
                            <label class="form-label"><b>Artist(s) </b></label>
                        </div>
                        <div>
                            <select required name="asset_artist_id" class="custom-select" disabled id="">
                                @foreach ($artists as $ass_artist)
                                    <option value="{{ $ass_artist->id }}" {{ (@$allDetails->asset_artisat_details->asset_artist_id== $ass_artist->id) ? "Selected" : "" }}>{{ $ass_artist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Artist already on Spotify? </label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required class="form-check-input checkValueRadio" type="radio" onclick="handleClick(this);" name="has_spotify_asset"
                                value="1" {{ (@$allDetails->asset_artisat_details->has_spotify_asset=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required class="form-check-input checkValueRadio" type="radio" onclick="handleClick(this);" name="has_spotify_asset" value="0" {{ (@$allDetails->asset_artisat_details->has_spotify_asset=="0") ? "checked" : "" }}>No
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Spotify(Optional)</label>
                        <input disabled type="text" class="form-control" name="spotify_id_ass"
                            placeholder="enter spotify ID" value="{{@$allDetails->asset_artisat_details->spotify_id_ass}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Artist already on Apple Music? </h6>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required type="radio" onclick="handleClickA(this);" class="form-check-input" name="has_applemusic_asset"
                                value="1" {{ ($allDetails->asset_artisat_details->has_applemusic_asset=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required type="radio" onclick="handleClickA(this);" class="form-check-input"
                                name="has_applemusic_asset" value="0" {{ ($allDetails->asset_artisat_details->has_applemusic_asset=="0") ? "checked" : "" }}>No
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Apple Music(Optional)</label>
                        <input disabled type="text" class="form-control" name="apple_id_ass"
                            placeholder="enter apple ID" value="{{ $allDetails->asset_artisat_details->apple_id_ass}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Genre 1</label>
                    <select required name="genre_one" id="" class="custom-select" disabled>
                        <option value="">select genre1</option>
                        @foreach (config('country.genres') as $k => $g_one)
                            <option value="{{ $g_one }}" {{ ($allDetails->genre_one==$g_one) ? "selected" : "" }}>{{ $g_one }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Genre 2</label>
                    <select name="genre_two" id="" class="custom-select" disabled>
                        <option value="">select genre2</option>
                        @foreach (config('country.genres') as $k => $g_two)
                            <option value="{{ $g_two }}" {{ ($allDetails->genre_two==$g_two) ? "selected" : "" }}>{{ $g_two }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">(P) Copyright </label>
                    <input disabled required type="text" name="p_copy" class="custom-select"
                    placeholder="2008 AMC inc" value="{{$allDetails->p_copy}}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">(C) Copyright </label>
                    <input disabled required type="text" name="c_copy" class="custom-select"
                        placeholder="2008 AMC inc" value="{{$allDetails->c_copy}}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Previously released? </label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required type="radio" onclick="handleClickRD(this);" name="previously_release" class="form-check-input" value="1" {{ ($allDetails->previously_release=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required type="radio" onclick="handleClickRD(this);" class="form-check-input" name="previously_release" value="0" {{ ($allDetails->previously_release=="0") ? "checked" : "" }}>No
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" >
                        <label class="form-label">Previously released date(Optional)</label>
                        <input disabled type="date" name="release_date" class="form-control" id="" value="{{date('Y-m-d', strtotime(@$allDetails->release_date))}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Label name</label>
                    <select disabled required name="label_id" class="custom-select" id="">
                        @foreach ($labels as $label)
                            <option value="{{ $label->id }}" {{ ($allDetails->label_id==$label->id ) ? "selected" : "" }}>{{ $label->official_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Internal release ID <label>
                        <input disabled required type="text" name="internal_release_id" class="form-control"
                        id="" value="{{$allDetails->internal_release_id}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Do you already have a UPC/EAN/JAN? </label>
                        <input disabled type="number" name="upc_ean_jan" class="form-control"
                        placeholder="xxxxxxxxx" id="" value="{{$allDetails->upc_ean_jan}}" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label"><b>Audio file </b></label>
                    <audio controls src="{{asset('storage/'.@$allDetails->track_details->audio)}}"></audio>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <label class="form-label"><b>Language of lyrics </b></label>
                        <select disabled required name="language_t623" id=""
                            class="custom-select">
                            <option value="">select language</option>
                            @foreach (config('country.languages') as $k => $lanT)
                                <option value="{{ $lanT }}" 
                                {{$allDetails->track_details->language_t== $lanT ? 'selected':''}}>{{ $lanT }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"><b>Track title </b></label>
                        <input disabled required type="text" name="track_title" class="form-control" id="" value="{{@$allDetails->track_details->track_title_version}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"><b>Title version </b></label>
                        <input disabled required type="text" name="track_title_version" class="form-control" id=""  value="{{@$allDetails->track_details->title_version}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label"><b>Artist </b></label>
                        <select disabled required name="contritibutor_track_artist_id"
                            class="custom-select" id="">
                            <option value="">select artist</option>
                            @foreach ($artists as $ass_artist)
                                <option value="{{ $ass_artist->id }}" {{ $allDetails->track_artisat_details->track_artist_id == $ass_artist->id ? 'selected':''}}>{{ $ass_artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Artist already on Spotify? </h6>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required class="form-check-input" type="radio" onclick="handleClickTrack(this);"
                                name="contritibutor_has_spotify" value="1" {{ ($allDetails->track_artisat_details->has_spotify=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required class="form-check-input" type="radio" onclick="handleClickTrack(this);"
                                name="contritibutor_has_spotify" value="0" {{ ($allDetails->track_artisat_details->has_spotify=="0") ? "checked" : "" }}>No
                        </div>
                        <span class="text-danger">
                            @error('contritibutor_has_spotify')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Spotify(Optional)</label>
                        <input disabled type="text" class="form-control"
                            name="contritibutor_track_spotify_id" placeholder="enter spotify ID" value="{{$allDetails->track_artisat_details->track_spotify_id}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Artist already on Apple Music? </label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input class="form-check-input" required type="radio" onclick="handleClickATrack(this);"
                                name="contritibutor_has_applemusic" value="1" {{ ($allDetails->track_artisat_details->has_applemusic=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required type="radio" onclick="handleClickATrack(this);" class="form-check-input"
                                name="contritibutor_has_applemusic" value="0" {{ ($allDetails->track_artisat_details->has_applemusic=="0") ? "checked" : "" }}>No
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Apple Music(Optional)</label>
                        <input disabled type="text" class="form-control"
                            name="contritibutor_track_apple_id" placeholder="enter apple ID" value="{{$allDetails->track_artisat_details->track_apple_id}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Do you have ISRC code?</label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required class="form-check-input" type="radio" onclick="handleClickISRC(this);" name="has_isrc"
                                value="1" {{ ($allDetails->track_details->has_isrc=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required type="radio" onclick="handleClickISRC(this);" class="form-check-input"
                                name="has_isrc" value="0" {{ ($allDetails->track_details->has_isrc=="0") ? "checked" : "" }}>No
                            <span id="noIsrc" class="">(Ok, we will generate for you)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">ISRC code(Optional)</label>
                        <input disabled type="text" name="isrc_code" class="form-control" placeholder="ISRC" value="{{@$allDetails->track_details->isrc_code}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Explicit lyrics?</label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required class="form-check-input" type="radio" name="explicit_lyrics" value="1" {{ ($allDetails->track_details->explicit_lyrics=="1") ? "checked" : "" }}>Yes
                        </div>
                        <div class="col-6">
                            <input required type="radio" class="form-check-input" name="explicit_lyrics" value="0" {{ ($allDetails->track_details->explicit_lyrics=="0") ? "checked" : "" }}>No
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">The track is:</label>
                    <div class="row">
                        <div class="col-4 ml-3">
                            <input required class="form-check-input" type="radio" onclick="trackIs(this);" name="original_public"
                                value="1" {{ ($allDetails->track_details->original_public=="1") ? "checked" : "" }}>An original song (publishing info will be required)
                        </div>
                        <div class="col-6">
                            <input required type="radio" onclick="trackIs(this);" class="form-check-input" name="original_public" value="0"  {{ ($allDetails->track_details->original_public=="0") ? "checked" : "" }}>A public domain song (publishing info
                            will be required)
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"
                        style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                        <p>
                            Public​ ​domain​ ​compositions​ ​are​ ​ones​ ​in​ ​which​ ​the
                            intellectual​ ​property​ ​rights​ ​have​ ​expired​ ​or​ ​been​ ​forfeited.
                            This​ ​generally​ ​applies​ ​to​ ​songs​ ​written​ ​before​ ​1923.
                        </p>
                    </div>
                    <div id="trackIsfirst" class="d-none"
                        style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                        <p>
                            An​ ​original​ ​composition​ ​is​ ​a​ ​track​ ​to​ ​which​ ​you’ve​ ​contributed
                            lyrics​ ​and/or​ ​music,​ ​but​ ​which​ ​does​ ​NOT​ ​borrow​ ​elements
                            from​ ​previously​ ​created​ ​works.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Genre 1 </label>
                    <select disabled required name="genre_one_track" id=""
                    class="custom-select">
                        <option value="">select genre1</option>
                        @foreach (config('country.genres') as $k => $t_one)
                        <option value="{{ $t_one }}" {{ ($allDetails->track_details->genre_one_track==$t_one) ? "selected" : "" }}>{{ $t_one }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Genre 2 </label>
                    <select disabled name="genre_two_track" id=""
                            class="custom-select">
                            <option value="">select genre2</option>
                        @foreach (config('country.genres') as $k => $t_two)
                            <option value="{{ $t_two }}" {{ ($allDetails->track_details->genre_two_track==$t_two) ? "selected" : "" }}>{{ $t_two }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">(P) Copyright</label>
                    <input disabled required type="text" name="p_copy_t" class="form-control"
                    placeholder="2008 AMC inc" value="{{$allDetails->track_details->p_copy_t}}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">(C) Copyright </label>
                    <input disabled required type="text" name="c_copy_t" class="form-control"
                        placeholder="2008 AMC inc" value="{{$allDetails->track_details->c_copy_t}}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Label name</label>
                    <select disabled required name="track_label_id" class="custom-select">
                        @foreach ($labels as $label_t)
                        <option value="{{ $label_t->id }}" {{ ($allDetails->track_details->track_label_id==$label_t->id) ? "selected" : "" }}>{{ $label_t->official_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Internal track ID </label>
                    <input readonly required type="text" name="internal_track_id" class="form-control" value="{{$allDetails->track_details->internal_track_id}}">
                </div>
                <div class="col-md-12" class="mb-4">
                    <label class="form-label"><b>Lyrics (Optional)</b></label>
                    <div class="form-row">
                        <textarea disabled name="lyrics" id="" class="form-control"
                            placeholder="Any order note about delivery or special offer" style="height: 108px">{{$allDetails->track_details->lyrics}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Contributor name</label>
                    <select disabled required name="contritibutor_track_artist_name"
                        class="custom-select" id="">
                        <option value="">select contributor</option>
                        @foreach ($artists as $ass_artist)
                            <option value="{{ $ass_artist->id }}" {{ ($allDetails->track_artisat_details->track_artist_name==$ass_artist->id) ? "selected" : "" }}>{{ $ass_artist->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Role </label>
                    <select disabled required name="contritibutor_role" class="custom-select">
                        <option value="">select role</option>
                        <option value="Adaptor" {{@$allDetails->track_artisat_details->role == 'Adaptor' ? 'selected':''}}>Adaptor</option>
                        <option value="Arranger" {{@$allDetails->track_artisat_details->role == 'Arranger' ? 'selected':''}}>Arranger</option>
                        <option value="Composer" {{@$allDetails->track_artisat_details->role == 'Composer' ? 'selected':''}}>Composer</option>
                        <option value="Composer&Lyricist" 
                        {{@$allDetails->track_artisat_details->role == 'Composer&Lyricist' ? 'selected':''}}>Composer&Lyricist</option>
                        <option value="Income Participant" 
                        {{@$allDetails->track_artisat_details->role == 'Income Participant' ? 'selected':''}}>Income Participant</option>
                        <option value="Lyricist" {{@$allDetails->track_artisat_details->role == 'Lyricist' ? 'selected':''}}>Lyricist</option>
                        <option value="Sub-Author" 
                        {{@$allDetails->track_artisat_details->role == 'Sub-Author' ? 'selected':''}}>Sub-Author</option>
                        <option value="Translator" {{@$allDetails->track_artisat_details->role == 'Translator' ? 'selected':''}}>Translator</option>
                        <option value="Writer" {{@$allDetails->track_artisat_details->role == 'Writer' ? 'selected':''}}>Writer</option>

                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Share </label>
                    <input disabled required type="number" name="contritibutor_share" class="form-control" value="{{@$allDetails->track_artisat_details->share}}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Publishing </label>
                    <select disabled required name="contritibutor_publishing" class="custom-select">
                        <option value="">select publishing</option>
                        <option value="Copyright control (self-published)" {{@$allDetails->track_artisat_details->publishing == 'Copyright control (self-published)' ? 'selected':''}}>Copyright control (self-published)</option>
                        <option value="Public domain (no publisher)" {{@$allDetails->track_artisat_details->publishing == 'Public domain (no publisher)' ? 'selected':''}}>Public domain (no publisher)</option>
                        <option value="Published (managed by a publisher)" {{@$allDetails->track_artisat_details->publishing == 'Published (managed by a publisher)' ? 'selected':''}}>Published (managed by a publisher)</option>
                    </select>
                </div>
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $( document ).ready(function() {
            var array =  {!! json_encode($allDetails) !!};
            if(array.asset_artisat_details.has_spotify_asset == 1)
            {
                document.getElementById('enterSP').classList.remove('d-none');
            }
            if(array.asset_artisat_details.has_applemusic_asset == 1)
            {
                document.getElementById('enterAP').classList.remove('d-none');
            }
            if(array.previously_release == 1)
            {
                document.getElementById('prelesr').classList.remove('d-none');
            }
            if(array.track_artisat_details.has_spotify == 1)
            {
                document.getElementById('handleClickTrack').classList.remove('d-none');
            }
            if(array.track_artisat_details.has_applemusic == 1)
            {
                document.getElementById('handleClickATrack').classList.remove('d-none');
            }
            if(array.track_details.has_isrc == 1)
            {
                document.getElementById('handleClickISRC').classList.remove('d-none');
            }
            if(array.track_details.original_public == 1)
            {
                document.getElementById('trackIsfirst').classList.remove('d-none');
                document.getElementById('trackIssecond').classList.add('d-none');
            } else {
                document.getElementById('trackIsfirst').classList.add('d-none');
                document.getElementById('trackIssecond').classList.remove('d-none');
            }
        });
        function validation () {
            var form = $(".myform");
            form.validate({
                rules: {
                    release_title: {required: true},
                    language: "required",
                    title_version:"required"
                },
                messages: {
                    release_title: {required: "This is required."},
                    language:{required: "This is required."},
                    title_version:{required: "This is required."}
                }
            });
            if (form.valid() === true) {
                $(".slide.one").removeClass("active");
                $(".slide.two").addClass("active");
            }
            return form.valid()
        };
        $(function() {
            $("#wizard").steps({
                headerTag: "h4",
                bodyTag: "section",
                transitionEffect: "fade",
                enableAllSteps: true,
                transitionEffectSpeed: 500,
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (newIndex === 1) {
                        $('.steps ul').addClass('step-2');
                    } else {
                        $('.steps ul').removeClass('step-2');
                    }
                    if (newIndex === 2) {
                        $('.steps ul').addClass('step-3');
                    } else {
                        $('.steps ul').removeClass('step-3');
                    }

                    if (newIndex === 3) {
                        // $('.steps ul').addClass('step-4');
                        // $('.actions ul').addClass('step-last');
                    } else {
                        $('.steps ul').removeClass('step-4');
                        $('.actions ul').removeClass('step-last');
                    }
                    if(validation() == true){
                        return true;
                    }
                },
                labels: {
                    finish: "Approve",
                    next: "Next",
                    previous: "Previous"
                }
            });
            // Custom Steps Jquery Steps
            $('.wizard > .steps li a').click(function() {
                $(this).parent().addClass('checked');
                $(this).parent().prevAll().addClass('checked');
                $(this).parent().nextAll().removeClass('checked');
            });
            // Custom Button Jquery Steps
            $('.forward').click(function() {
                $("#wizard").steps('next');
            })
            $('.backward').click(function() {
                $("#wizard").steps('previous');
            })
            // Checkbox
            $('.checkbox-circle label').click(function() {
                $('.checkbox-circle label').removeClass('active');
                $(this).addClass('active');
            })
            $('.actions ul li:last-child a').on('click', function() {
                // Submit the form when the "Approve" button is clicked
                $("#yourFormId").submit();
            });
        })

        function handleClick(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('enterSP').classList.remove('d-none');
            } else {
                document.getElementById('enterSP').classList.add('d-none');
            }
        }

        function trackIs(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('trackIsfirst').classList.remove('d-none');
                document.getElementById('trackIssecond').classList.add('d-none');
            } else {
                document.getElementById('trackIsfirst').classList.add('d-none');
                document.getElementById('trackIssecond').classList.remove('d-none');
            }
        }


        function handleClickTrack(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('handleClickTrack').classList.remove('d-none');
            } else {
                document.getElementById('handleClickTrack').classList.add('d-none');
            }
        }

        function handleClickATrack(result, data) {
            if (result.value == 1 || data==1) {
                // alert(result.value);
                document.getElementById('handleClickATrack').classList.remove('d-none');
                // document.getElementById('noIsrc').classList.add('d-none');
            } else {
                document.getElementById('handleClickATrack').classList.add('d-none');
                document.getElementById('noIsrc').classList.remove('d-none');

            }
        }

        function handleClickISRC(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('handleClickISRC').classList.remove('d-none');
            } else {
                document.getElementById('handleClickISRC').classList.add('d-none');
            }
        }



        function handleClickA(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('enterAP').classList.remove('d-none');
            } else {
                document.getElementById('enterAP').classList.add('d-none');
            }
        }

        function handleClickRD(result) {
            if (result.value == 1) {
                // alert(result.value);
                document.getElementById('prelesr').classList.remove('d-none');
            } else {
                document.getElementById('prelesr').classList.add('d-none');
            }
        }

        function previewFile() {
            var preview = document.querySelector("audio");
            var file = document.querySelector("input[name=audio]").files[0];
            var reader = new FileReader();
            reader.addEventListener(
                "load",
                function () {
                    preview.src = reader.result;
                    },
                false
            );
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection