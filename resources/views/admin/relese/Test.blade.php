@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | release-create')
@section('content')
<style>
    .error{
        color: red;
    }
    /* js-example-basic-single */
</style>
<div id="app">  
    {{-- <relese-component> </relese-component> --}}
    <div class="row justify-content-center">
        <div class="col-lg-12">
            {{-- <form class="myform" action="{{ route('admin.store') }}" method="POST" id="yourFormId" enctype="multipart/form-data"> --}}
                {{-- @method('POST')
                @csrf --}}
                <div id="wizard" class="shadow" style="margin-right:0px; margin-left:10px">
                    <!-- SECTION 1 -->
                    <h4></h4>
                    <section>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Add user <span class="text-danger">*</span></b></label>
                                <select required v-model="userId" name="userId" class="custom-select" id="userIdPreview">
                                    <option value="">select user</option>
                                    @if (!@empty($users))
                                    @foreach ($users as $k=> $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('userId')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-4 mb-2"></div>
                            <div class="col-md-6 mb-2"> 
                                <label class="form-label"><b>Cover image <span class="text-danger">*</span></b></label>
                                <div>
                                    <input type="image" src="{{asset('admin-asset/images/photo.png')}}" id="clickimageforupload" onclick="UploadImage()" style="height:50px">
                                    <input required type="file" class="custom-file-input imageUpload" name="cover_image" accept="image/*"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0]); document.getElementById('PVImage').src = window.URL.createObjectURL(this.files[0]);" id="inputGroupFile02" style="display: none">
                                </div>
                                <div class="WithOutImageHidden text-center">
                                    <img id="blah" alt="your image" style="height: 200px;" />
                                </div>
                                <span class="text-danger">
                                    @error('cover_image')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-row" style="font-size: 11px;font-family: emoji;color: #ff0326;">
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
                            <div class="col-md-12 mb-2">
                                <label class="form-label"><b>Language <span class="text-danger">*</span></b><br>
                                    <span class="mb-0">In what language will you be writing your titles, artist name(s) and release
                                        description?</span>
                                </label>
                                <select required name="language" v-model="language" class="custom-select" id="previewlanguage">
                                    <option value="">select language</option>
                                    @foreach (config('country.languages') as $k => $lan)
                                        <option value="{{ $lan }}">{{ $lan }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('language')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Title <span class="text-danger">*</span></b> 
                                    <span> (Release title)</span></label>
                                <input required v-model="release_title" type="text" name="release_title" id="Previewrelease_title" value="{{old('release_title')}}" class="form-control"
                                    placeholder="Enter Name of release">
                                <span class="text-danger">
                                    @error('release_title')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>Title version</b> <span class="text-danger">*</span></label>
                                <input type="text" v-model="title_version" name="title_version" class="form-control"
                                    placeholder="Enter title version" id="Previewtitle_version" value="{{old('title_version')}}">
                                <span class="text-danger">
                                    @error('title_version')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label mr-4"><b>Artist <span class="text-danger">*</span></b>
                                <br> <span>Is this a compilation of various artists? </span>
                                </label>
                                <div class="form-check form-check-inline">
                                    <input required v-model="is_various_artist" class="form-check-input" type="radio" id="PreviewinlineRadio1" name="is_various_artist"  value="1" onclick="Addartistbutton(Val=1)">
                                    <label class="form-check-label" for="PreviewinlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required v-model="is_various_artist"  class="form-check-input" type="radio" id="PreviewinlineRadio2" name="is_various_artist" onclick="Addartistbutton(Val=0)" value="0">
                                    <label class="form-check-label" for="PreviewinlineRadio2" >No</label>
                                </div>
                                <span class="text-danger">
                                    @error('is_various_artist')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label"><b>Artist(s) – indicate ONLY ONE per field <span class="text-danger">*</span></b></label>
                                <select disabled id="Previewasset_artist_id" v-model="asset_artist_id" required name="asset_artist_id" class="custom-select ArtistDisableEnable"
                                    onchange="GetArtistDetails(value)">
                                    <option value="">select artist</option>
                                    @foreach ($artists as $ass_artist)
                                        <option value="{{ $ass_artist->id }}">{{ $ass_artist->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('asset_artist_id')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>Artist already on Spotify?</b> <span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="has_spotify_asset" required class="form-check-input has_spotify_asset" type="radio" id="inlineRadio1" onclick="handleClick(this);" name="has_spotify_asset" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input  v-model="has_spotify_asset" required class="form-check-input" type="radio" id="inlineRadio2" onclick="handleClick(this);" name="has_spotify_asset" value="0">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('has_spotify_asset')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label></label>
                                <div id="enterSP" class="d-none">
                                    <input v-model="spotify_id_ass" type="text" class="form-control" name="spotify_id_ass"
                                        placeholder="Enter spotify ID" id="spotify_id_ass">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b> Artist already on Apple Music?</b> <span class="text-danger">*</span> </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="has_applemusic_asset" required class="form-check-input has_applemusic_asset" type="radio" id="inlineRadio1"  onclick="handleClickA(this);"  name="has_applemusic_asset" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="has_applemusic_asset" required class="form-check-input" type="radio" id="inlineRadio2"  onclick="handleClickA(this);" name="has_applemusic_asset" value="0">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('has_applemusic_asset')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label></label>
                                <div id="enterAP" class="d-none">
                                    <input v-model="apple_id_ass" type="text" class="form-control" name="apple_id_ass"
                                        placeholder="Enter apple ID" id="apple_id_ass">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="border-bottom">
                                    <label class="form-label"><b>Info</b></label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>Genre 1</b> <span class="text-danger">*</span></label>
                                <select v-model="genre_one" required name="genre_one" class="custom-select" id="Previewgenre_one">
                                    <option value="">select genre1</option>
                                    @foreach (config('country.genres') as $k => $g_one)
                                        <option value="{{ $g_one }}">{{ $g_one }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('genre_one')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>Genre 2 </b></label>
                                <select v-model="genre_two" name="genre_two" id="Previewgenre_two" class="custom-select">
                                    <option value="">select genre2</option>
                                    @foreach (config('country.genres') as $k => $g_two)
                                        <option value="{{ $g_two }}">{{ $g_two }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('genre_two')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>(P) Copyright</b><span class="text-danger">*</span></label>
                                <input  v-model="p_copy" required type="text" id="Previewp_copy" name="p_copy" class="form-control"
                                    placeholder="2008 M" value="{{old('p_copy')}}" maxlength="6" pattern="\d{6}" name="mobileNo">
                                <span class="text-danger">
                                    @error('p_copy')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span> 
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>(C) Copyright </b><span class="text-danger">*</span></label>
                                <input v-model="c_copy" required type="text" id="Previewc_copy" name="c_copy" class="form-control"
                                    placeholder="2008 A" maxlength="6" pattern="\d{6}" value="{{old('c_copy')}}">
                                    <span class="text-danger">
                                        @error('c_copy')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Previously released? </b><span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio1" onclick="handleClickRD(this);" name="previously_release" value="1">
                                        <label class="form-check-label" for="releasedinlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio2" onclick="handleClickRD(this);" name="previously_release" value="0">
                                        <label class="form-check-label" for="releasedinlineRadio2">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('previously_release')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label></label>
                                <div class="d-none" id="prelesr">
                                    <input v-model="release_date" type="date" id="releasedrelease_date" name="release_date" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b> Label name </b><span class="text-danger">*</span></label>
                                <select v-model="label_id" required name="label_id" id="Previewlabel_id" class="custom-select">
                                    @foreach ($labels as $label)
                                        <option value="{{ $label->id }}">{{ $label->official_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><b>Catelog release ID </b><span class="text-danger">*</span></label>
                                <input v-model="internal_release_id"  readonly required type="text" id="internal_release_id" name="internal_release_id" class="form-control"
                                     value="">
                                    <span class="text-danger">
                                        @error('internal_release_id')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><b>Do you already have a UPC/EAN/JAN? </b> </label>
                                <input v-model="upc_ean_jan" type="number" name="upc_ean_jan" class="form-control"
                                    placeholder="xxxxxxxxx" id="Previewupc_ean_jan" value="{{old('upc_ean_jan')}}">
                                    <span class="text-danger" id="ShowUPCValidation"> UPC number should be 7-8 or 11-14 character </span>
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
                        <div class="row" v-for="(track, index) in tracks" :key="index">
                            <div class="col-md-12 mb-2">
                                <label class="form-label"><b>Audio file <span class="text-danger">*</span></b></label>
                                <div class="justify-content-between d-flex">
                                    <input type="image" src="{{asset('admin-asset/images/upload.png')}}" id="clickimageforupload" onclick="UploadAudio()" style="height:50px">
                                    <input required type="file" onchange="previewFile()" accept="audio/*" class="custom-file-label" name="audio" id="inputGroupFi" style="display: none">
                                    <div>
                                        <audio controls src=""></audio>
                                        <div id="resultImage"></div>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('audio')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label"><b>Language of lyrics <span class="text-danger">*</span></b></label>
                                <select required v-model="track.language_t623" name="language_t623" id="" class="custom-select">
                                    <option value="">select language</option>
                                    @foreach (config('country.languages') as $k => $lanT)
                                        <option value="{{ $lanT }}">{{ $lanT }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('language_t623')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Track title <span class="text-danger">*</span></b></label>
                                <input required v-model="track.track_title" type="text" name="track_title" class="form-control" value="{{old('track_title')}}" id="">
                                <span class="text-danger">
                                    @error('track_title')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Title version </b></label>
                                <input type="text" v-model="track.track_title_version" name="track_title_version" class="form-control" id="" value="{{old('track_title_version')}}">
                                <span class="text-danger">
                                    @error('track_title_version')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-8 mb-2">
                                <label class="form-label"><b>Artist</b> <span class="text-danger">*</span></label>
                                <select multiple  v-model="track.contritibutor_track_artist_id"  id="ArtistOption" required name="contritibutor_track_artist_id"  class="custom-select">
                                    {{-- <option value="">select artist</option> --}}
                                    {{-- @foreach ($artists as $ass_artist)
                                        <option value="{{ $ass_artist->id }}">{{ $ass_artist->name }}</option>
                                    @endforeach --}}
                                </select>
                                <span class="text-danger">
                                    @error('contritibutor_track_artist_id')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-4 text-center m-auto">
                                <label for=""></label>
                                <button type="button" class="btn btn-primary btn-sm mt-4" data-toggle="modal" data-target="#addartist">Add Artist</button>
                            </div>
                            <div class="col md-12">
                                <label class="form-label"><b>CRBT</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Time</label>
                                        <input type="time" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-right">
                                        <button type="button" class="btn btn-primary btn-sm">Add CRBT</button>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Artist already on Spotify? </b> <span class="text-danger">*</span> </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="contritibutor_has_spotify" id="alreadyonSpotify" onclick="handleClickTrack(this);" value="1">
                                        <label class="form-check-label" for="alreadyonSpotify">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="contritibutor_has_spotify" id="alreadyonSpotifyPP" onclick="handleClickTrack(this);" value="0">
                                        <label class="form-check-label" for="alreadyonSpotifyPP">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('contritibutor_has_spotify')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div id="handleClickTrack" class="d-none">
                                    <label for=""></label>
                                    <input type="text" class="form-control" name="contritibutor_track_spotify_id" id="contritibutor_track_spotify_id" placeholder="Enter spotify ID">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Artist already on Apple Music? </b> <span class="text-danger">*</span> </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="contritibutor_has_applemusic" id="alreadyonApple" onclick="handleClickATrack(this);" value="1">
                                        <label class="form-check-label" for="alreadyonApple">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="contritibutor_has_applemusic" id="AppleMusic" onclick="handleClickATrack(this);" value="0">
                                        <label class="form-check-label" for="AppleMusic">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('contritibutor_has_applemusic')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div id="handleClickATrack" class="d-none">
                                    <label for=""></label>
                                    <input type="text" class="form-control"
                                        name="contritibutor_track_apple_id" id="contritibutor_track_apple_id" placeholder="enter apple ID">
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Do you have ISRC code? </b> <span class="text-danger">*</span> </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.has_isrc" required class="form-check-input" type="radio" name="has_isrc" id="ISRCcode" onclick="handleClickISRC(this);" value="1">
                                        <label class="form-check-label" for="ISRCcode">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.has_isrc" required class="form-check-input" type="radio" name="has_isrc" id="ISRCcodePP" onclick="handleClickISRC(this);" value="0">
                                        <label class="form-check-label" for="ISRCcodePP">No (Ok, we will generate for you)</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('has_isrc')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div id="handleClickISRC" class="d-none">
                                    <label for=""></label>
                                    <input v-model="track.isrc_code" type="text" name="isrc_code" class="form-control"  maxlength="12" pattern="\d{12}" placeholder="ISRC">
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label"><b>Explicit lyrics? </b><span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.explicit_lyrics" required class="form-check-input" type="radio" name="explicit_lyrics" id="explicit_lyrics" value="1">
                                        <label class="form-check-label" for="explicit_lyrics">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.explicit_lyrics" required class="form-check-input" type="radio" name="explicit_lyrics" id="explicit_lyricsPP" value="0">
                                        <label class="form-check-label" for="explicit_lyricsPP">No</label>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('explicit_lyrics')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>The track is: </b><span class="text-danger">*</span> </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.original_public" required class="form-check-input" type="radio" name="original_public" id="original_public" onclick="trackIs(this);" value="1">
                                        <label class="form-check-label" for="original_public">An original song (publishing info will be required)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="track.original_public" required class="form-check-input" type="radio" name="original_public" id="original_publicPP" onclick="trackIs(this);" value="0">
                                        <label class="form-check-label" for="original_publicPP">A public domain song (publishing info will be required)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
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
                                <h6 class="form-label">Advance info</b></h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Genre 1 </b><span class="text-danger">*</span></label>
                                <select v-model="track.genre_one_track" required name="genre_one_track" id=""
                                    class="custom-select">
                                    <option value="">select genre1</option>
                                    @foreach (config('country.genres') as $k => $t_one)
                                        <option value="{{ $t_one }}">{{ $t_one }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('genre_one_track')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Genre 2 </b></label>
                                <select v-model="track.genre_two_track" name="genre_two_track" id=""
                                    class="custom-select">
                                    <option value="">select genre2</option>
                                    @foreach (config('country.genres') as $k => $t_two)
                                        <option value="{{ $t_two }}">{{ $t_two }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('genre_two_track')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>(P) Copyright </b><span class="text-danger">*</span></label>
                                <input v-model="track.p_copy_t" required type="text" name="p_copy_t" class="form-control"
                                    placeholder="2008 M" maxlength="6" pattern="\d{6}" value="{{old('p_copy_t')}}">
                                <span class="text-danger">
                                    @error('p_copy_t')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>(C) Copyright </b><span class="text-danger">*</span></label>
                                <input v-model="track.c_copy_t" required type="text" name="c_copy_t" class="form-control"
                                    placeholder="2008 A" maxlength="6" pattern="\d{6}" value="{{old('c_copy_t')}}">
                                <span class="text-danger">
                                    @error('c_copy_t')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Label name </b><span class="text-danger">*</span></label>
                                <select v-model="track.track_label_id" required name="track_label_id" class="custom-select">
                                    @foreach ($labels as $label_t)
                                        <option value="{{ $label_t->id }}">{{ $label_t->official_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('track_label_id')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Catelog track ID </b><span class="text-danger">*</span></label>
                                <input  v-model="track.internal_track_id" required readonly type="text" id="internal_track_id" name="internal_track_id" class="form-control internal_track_id" value="">
                                <span class="text-danger">
                                    @error('internal_track_id')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"><b>Lyrics (Optional)</b></label>
                                <div class="form-row" style="margin-bottom: 18px">
                                    <textarea name="lyrics" id="" class="form-control"
                                        placeholder="Any order note about delivery or special offer" style="height: 108px" v-model="track.lyrics">{{old('lyrics')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary" onclick="AddNewTrack()">Add track</button>
                                {{-- <button type="submit" class="btn btn-primary" click="AddNewTrack()">Add track</button> --}}
                            </div>
                        </div>
                    </section> <!-- SECTION 3 -->
                    <h4></h4>
                    <section>
                        <div class="row">
                            <div class="col-12">
                                <h6>Add more contributor</h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Contributor name </b><span class="text-danger">*</span></label>
                                <select required name="contritibutor_track_artist_name"
                                    class="custom-select" id="Previewcontritibutor_track_artist_name">
                                    <option value="">select contributor</option>
                                    @foreach ($artists as $ass_artist)
                                        <option value="{{ $ass_artist->id }}">{{ $ass_artist->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('contritibutor_track_artist_name')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label"><b>Role </b><span class="text-danger">*</span></label>
                                <select required name="contritibutor_role" id="Previewcontritibutor_role" class="custom-select">
                                    <option value="">select role</option>
                                    <option value="Adaptor">Adaptor</option>
                                    <option value="Arranger">Arranger</option>
                                    <option value="Composer">Composer</option>
                                    <option value="Composer&Lyricist">Composer&Lyricist</option>
                                    <option value="Income Participant">Income Participant</option>
                                    <option value="Lyricist">Lyricist</option>
                                    <option value="Sub-Author">Sub-Author</option>
                                    <option value="Translator">Translator</option>
                                    <option value="Writer">Writer</option>
                                </select>
                                <span class="text-danger">
                                    @error('contritibutor_role')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label"><b>Share </b><span class="text-danger">*</span></label>
                                <input required type="number" id="Previewcontritibutor_share" name="contritibutor_share" class="form-control" value="{{old('contritibutor_share')}}">
                                <span class="text-danger">
                                    @error('contritibutor_share')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label"><b>Publishing </b><span class="text-danger">*</span></label>
                                <select required name="contritibutor_publishing" id="Previewcontritibutor_publishing" class="custom-select">
                                    <option value="">select publishing</option>
                                    <option value="Copyright control (self-published)">Copyright control (self-published)</option>
                                    <option value="Public domain (no publisher)">Public domain (no publisher)</option>
                                    <option value="Published (managed by a publisher)">Published (managed by a publisher)</option>
                                </select>
                                <span class="text-danger">
                                    @error('contritibutor_publishing')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @if (!@empty($stores))   
                                        @foreach ($stores as $kk => $value)
                                        <div class="col-3">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-8 col-form-label">
                                                    <span> <img style="height: 40px" src="{{asset('storage/store/'.@$value->cover_image)}}" alt="No Image"></span>
                                                    {{@ $value->label_name }}</label>
                                                <div class="col-sm-4">
                                                <input type="checkbox" class="form-control-plaintext" id="staticEmail" value="{{ $value->id }}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section> <!-- SECTION 4 -->
                    <h4></h4>
                    <section>
                        <svg  style="height: 80px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6"
                                stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6"
                                stroke-linecap="round" stroke-miterlimit="10"
                                points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                        </svg>
                        <p class="success" style="font-size: 11px">You have fill up the form sucessfully. Submit it for approval</p>
                        <div class="text-right">
                            <a id="PreviewData" href="#" class="btn btn-secondary" data-toggle="modal" data-target="#ModalForpreview" 
                            style="border-radius:0px; background:#E67E22; border:1px solid #E67E22; font-size:14px" onclick="PreviewAlldata()">Preview</a>
                        </div>
                    </section>
                </div>
            {{-- </form> --}}
        </div>
    </div>

    <!-- Modal Create artist -->
    <div class="modal fade" id="addartist" tabindex="-1" role="dialog" aria-labelledby="addartistTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addartistTitle">Create Artist</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div>
                    {{-- <form id="submitform"> --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label> <b>Artist Name</b></label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" placeholder="full name" name="name"
                                        value="{{ old('name') }}" v-model="name">
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ 'Artist name field is required' }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label> <b>Email</b></label><span class="text-danger">*</span>
                                    <input type="email" class="form-control" v-model="email" placeholder="abc@mail.com" name="email"
                                        value="{{ old('email') }}">
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
                                    <label> <b> Attach the banner image here </b></label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="image"
                                        value="{{ old('banner_image') }}" ref="ImageRef" v-on:change="UploadDocuments()">
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
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> <b>Biography</b></label><span class="text-danger">*</span>
                            <textarea name="biography" v-model="biography" class="form-control" cols="40" rows="10"></textarea>


                            @error('biography')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> <b> Indicate this artist's IDs if they already have a profile page on these music
                                services.</b></label><span class="text-danger">*</span>
                            <div class="row">
                                <div class="col-md-1">
                                    <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                        data-placement="top" title=""
                                        style="background-image: url(&quot;{{ asset('spy.png') }}&quot;); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                        data-original-title="Spotify artist ID"></label>
                                </div>
                                <div class="col-md-11">
                                    <input class="form-control ui-input has-error" type="text"
                                        placeholder="Enter Spotify artist ID"  v-model="spotify_id" id="Modalspotify_id" name="spotify_id"
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
                                        placeholder="Enter Apple Music artist ID"  v-model="apple_id" id="Modalapple_id" name="apple_id"
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
                        <div class="text-center">
                            <button class="btn btn-primary" id="submitBtn" v-on:click="SubmitArtist()"  type="submit">
                                <span class="d-none spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                <span class="">Submit</span>
                            </button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Preview -->
    <div class="modal fade" id="ModalForpreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="col-md-4 mb-2">
                        <label class="form-label"><b>Add user</b></label>
                        <select required name="userId" class="custom-select" id="PVuserId" disabled>
                            <option value="">select user</option>
                            @if (!@empty($users))
                            @foreach ($users as $k=> $user)
                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                            <label class="form-label"><b>Cover image</b></label>
                        <div>
                            <img id="PVImage" alt="your image" style="height:100px;" src="" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"><b>Language </b>
                        </label>
                        <select name="language" class="custom-select" disabled id="PVlanguage">
                            <option value="">select language</option>
                            @foreach (config('country.languages') as $k => $lan)
                                <option value="{{ $lan }}">{{ $lan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"><b>Title</b><span> (Release title)</span></label>
                        <input type="text" name="release_title" id="PVrelease_title" readonly value="" class="form-control"
                            placeholder="Enter Name of release">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"> <b>Title version</b> </label>
                        <input type="text" name="title_version" class="form-control"
                            placeholder="Enter title version" readonly id="PVtitle_version" value="{{old('title_version')}}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label mr-4"><b>Artist</b></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input" type="radio" id="PVinlineRadio1" name="is_various_artist"  value="1">
                                <label class="form-check-label" for="PVinlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input" type="radio" id="PVinlineRadio2" name="is_various_artist" value="0">
                                <label class="form-check-label" for="PVinlineRadio2" >No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"><b>Artist(s)</b></label>
                        <select disabled name="asset_artist_id" id="PVasset_artist_id" class="custom-select">
                            @foreach ($artists as $ass_artist)
                                <option value="{{ $ass_artist->id }}">{{ $ass_artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"> <b>Artist already on Spotify?</b></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input  class="form-check-input" type="radio" id="PVinlineRaSpotify" name="has_spotify_asset" value="1">
                                <label class="form-check-label" for="PVinlineRaSpotify">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="PVinlineSpotify" name="has_spotify_asset" value="0">
                                <label class="form-check-label" for="PVinlineSpotify">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label></label>
                        <div id="enterSP" class="">
                            <input type="text" readonly class="form-control" name="spotify_id_ass"
                                placeholder="Enter spotify ID" id="PVspotify_id_ass">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"> <b> Artist already on Apple Music?</b></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input" type="radio" id="AppleinlineRadio1"  name="has_applemusic_asset" value="1">
                                <label class="form-check-label" for="AppleinlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input required class="form-check-input" type="radio" id="AppleinlineRadio2" name="has_applemusic_asset" value="0">
                                <label class="form-check-label" for="AppleinlineRadio2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label></label>
                        <div id="enterAP" class="">
                            <input type="text" readonly class="form-control" name="apple_id_ass"
                                placeholder="Enter apple ID" id="PVapple_id_ass">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"> <b>Genre 1</b></label>
                        <select disabled name="genre_one" id="PVgenre_one" class="custom-select">
                            <option value="">select genre1</option>
                            @foreach (config('country.genres') as $k => $g_one)
                                <option value="{{ $g_one }}">{{ $g_one }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label"> <b>Genre 2</b></label>
                        <select name="genre_two" id="PVgenre_two" class="custom-select" disabled>
                            <option value="">select genre2</option>
                            @foreach (config('country.genres') as $k => $g_two)
                                <option value="{{ $g_two }}">{{ $g_two }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">(P) Copyright </label>
                        <input disabled type="text" id="PVp_copy" name="p_copy" class="custom-select"
                        placeholder="2008A" value="">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">(C) Copyright </label>
                        <input disabled type="text" id="PVc_copy" name="c_copy" class="custom-select"
                            placeholder="2008M" value="">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Previously released? </label>
                        <div class="row">
                            <div class="col-4 ml-3">
                                <input  type="radio" id="PVpreviously_releaseYES" name="previously_release" class="form-check-input" value="1" >Yes
                            </div>
                            <div class="col-6">
                                <input  type="radio" id="PVpreviously_releaseNO" class="form-check-input" name="previously_release" value="0" >No
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label class="form-label">Previously released date(Optional)</label>
                            <input disabled type="date" name="release_date" class="form-control" id="PVrelease_date" value="">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Label name</label>
                        <select disabled name="label_id" class="custom-select" id="PVlabel_id">
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}" >{{ $label->official_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label class="form-label">Catelog release ID <label>
                            <input disabled type="text" name="internal_release_id" class="form-control"
                            id="PVinternal_release_id" value="">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label class="form-label">Do you already have a UPC/EAN/JAN? </label>
                            <input disabled type="number" name="upc_ean_jan" class="form-control"
                            placeholder="xxxxxxxxx" id="PVupc_ean_jan" value="" >
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
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
                        <label class="form-label">Catelog track ID </label>
                        <input readonly required type="text" name="internal_track_id" class="form-control" value="{{$allDetails->track_details->internal_track_id}}">
                    </div>
                    <div class="col-md-12" class="mb-4">
                        <label class="form-label"><b>Lyrics (Optional)</b></label>
                        <div class="form-row">
                            <textarea disabled name="lyrics" id="" class="form-control"
                                placeholder="Any order note about delivery or special offer" style="height: 108px">{{$allDetails->track_details->lyrics}}</textarea>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Contributor name</label>
                        <select disabled name="contritibutor_track_artist_name"
                            class="custom-select" id="PVcontritibutor_track_artist_name">
                            <option value="">select contributor</option>
                            @foreach ($artists as $ass_artist)
                                <option value="{{ $ass_artist->id }}" >{{ $ass_artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Role </label>
                        <select disabled required name="contritibutor_role" id="PVcontritibutor_role" class="custom-select">
                            <option value="">select role</option>
                            <option value="Adaptor" >Adaptor</option>
                            <option value="Arranger" >Arranger</option>
                            <option value="Composer" >Composer</option>
                            <option value="Composer&Lyricist" >Composer&Lyricist</option>
                            <option value="Income Participant" >Income Participant</option>
                            <option value="Lyricist">Lyricist</option>
                            <option value="Sub-Author">Sub-Author</option>
                            <option value="Translator">Translator</option>
                            <option value="Writer">Writer</option>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Share </label>
                        <input disabled required type="number" id="PVcontritibutor_share" name="contritibutor_share" class="form-control" value="{{@$allDetails->track_artisat_details->share}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Publishing </label>
                        <select disabled required name="contritibutor_publishing" id="PVcontritibutor_publishing" class="custom-select">
                            <option value="">select publishing</option>
                            <option value="Copyright control (self-published)">Copyright control (self-published)</option>
                            <option value="Public domain (no publisher)" >Public domain (no publisher)</option>
                            <option value="Published (managed by a publisher)" >Published (managed by a publisher)</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label"> <b>Select Store</b></label>
                        <select multiple class="form-control h-auto PVstore" name="store" id="exampleFormControlSelect2 ">
                            @foreach ($stores as $kk => $value)
                                <option value="{{ $value->id }}">{{ $value->label_name }}</option>
                            @endforeach
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
</div>
@endsection

@section('script')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    Notiflix.Notify.Init({});
     var app = new Vue({
         el: '#app',
         data: {
            userId:'',
            cover_image:'',
            language:'',
            release_title:'',
            title_version:'',
            is_various_artist:'',
            asset_artist_id:'',
            has_spotify_asset:'',
            spotify_id_ass:'',
            has_applemusic_asset:'',
            apple_id_ass:'',
            genre_one:'',
            genre_two:'',
            p_copy:'',
            c_copy:'',
            previously_release:'',
            release_date:'',
            label_id:'',
            internal_release_id:'',
            upc_ean_jan:'',

            tracks:[{
                audio:"",
                language_t623:'',
                track_title:'',
                track_title_version:'',
                contritibutor_track_artist_id:[],
                has_isrc:'',
                isrc_code:'',
                explicit_lyrics:'',
                original_public:"",
                genre_one_track:'',
                genre_two_track:'',
                p_copy_t:"",
                c_copy_t:'',
                track_label_id:'',
                internal_track_id:'',
                lyrics:''
            }],



            name:'',
            email:'',
            image:'',
            biography:'',
            spotify_id:'',
            apple_id:'',
            AllArtistList:[],
        },
        methods: {
            AddNewTrack(){
                this.tracks.push({audio:"",language_t623:'',track_title:'',track_title_version:'',contritibutor_track_artist_id:[],has_isrc:'',isrc_code:'',explicit_lyrics:'',original_public:"",genre_one_track:'',genre_two_track:'',p_copy_t:"",c_copy_t:'',track_label_id:'',internal_track_id:'',lyrics:''});
                
                console.log(this.tracks);
            },

            // artist modal
            SubmitArtist(){
                if(this.name && this.email && this.biography && this.spotify_id && this.apple_id)
                {
                    var formData = new FormData();
                    formData.append('name', this.name);
                    formData.append('email', this.email);
                    formData.append('biography', this.biography);
                    formData.append('image', this.image);
                    formData.append('spotify_id', this.spotify_id);
                    formData.append('apple_id', this.apple_id);
                    axios.post('/admin/artists',formData,
                { headers: { 'Content-Type': 'multipart/form-data' }}
                )
                .then((Response)=>{
                    GetArtistList();
                    this.name ='';
                    this.email = '';
                    this.biography = '';
                    this.$refs.ImageRef.value = null;
                    this.spotify_id ='';
                    this.apple_id ='';
                    Notiflix.Notify.Success('Added Successfully');
                },()=>{
                    Notiflix.Notify.Failure("Somethings went wrong, Please contact with authorized person.");
                });
                }else{
                    Notiflix.Notify.Failure("Please fill the all mandatory fields");
                }
            },
            UploadDocuments(){
                this.image = this.$refs.ImageRef.files[0];
                let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedTypes.includes(this.image.type)) {
                    Notiflix.Notify.Failure('Invalid file type. Only JPG, JPEG and PNG are allowed.');
                    this.$refs.ImageRef.value = null;
                    return;
                }else{
                    Notiflix.Notify.Success('File OK');
                }
            },
        },
    });
</script>

    <script>
        function AddNewTrack(){
            app.AddNewTrack();
        }
        function GetArtistList(){
            $.ajax({
                type: 'GET', 
                url: '/admin/artists-list',
                success: function (res) {
                    var selOpts = "";
                    for (i=0;i<res.length;i++)
                    {
                        var id = res[i]['id'];
                        var val = res[i]['name'];
                        selOpts += "<option value='"+id+"'>"+val+"</option>";
                    }
                    $('#ArtistOption').find('option').remove().end();
                    $('#ArtistOption').append('<option selected>Select Location</option>');
                    $('#ArtistOption').append(selOpts);
                    // $('.userList').find('.data-table').remove();
                    // $("#data").append(data);
                },
                error: function() { 
                    console.log(data);
                }
            });
        }
        function PreviewAlldata(){
            var userId = $('#userIdPreview').val();
            $('#PVuserId').val(userId);

            var language = $('#previewlanguage').val();
            $('#PVlanguage').val(language);

            var release_title = $('#Previewrelease_title').val();
            $('#PVrelease_title').val(release_title);

            var title_version = $('#Previewtitle_version').val();
            $('#PVtitle_version').val(title_version);

            var asset_artist_id = $('#Previewasset_artist_id').val();
            $('#PVasset_artist_id').val(asset_artist_id);
            
            var spotify_id_ass = $('#spotify_id_ass').val();
            $('#PVspotify_id_ass').val(spotify_id_ass);

            var apple_id_ass = $('#apple_id_ass').val();
            $('#PVapple_id_ass').val(apple_id_ass);

            var genre_one = $('#Previewgenre_one').val();
            $('#PVgenre_one').val(genre_one);
            
            var genre_two = $('#Previewgenre_two').val();
            $('#PVgenre_two').val(genre_two);
            
            var p_copy = $('#Previewp_copy').val();
            $('#PVp_copy').val(p_copy);

            var c_copy = $('#Previewc_copy').val();
            $('#PVc_copy').val(c_copy);

            var release_date = $('#releasedrelease_date').val();
            $('#PVrelease_date').val(release_date);

            var label_id = $('#Previewlabel_id').val();
            $('#PVlabel_id').val(label_id);

            var internal_release_id = $('#internal_release_id').val();
            $('#PVinternal_release_id').val(internal_release_id);
            
            var upc_ean_jan = $('#Previewupc_ean_jan').val();
            $('#PVupc_ean_jan').val(upc_ean_jan);


            // /////////////////////////

            var contritibutor_track_artist_nameII = $('#Previewcontritibutor_track_artist_name').val();
            $('#PVcontritibutor_track_artist_name').val(contritibutor_track_artist_nameII);

            var contritibutor_role = $('#Previewcontritibutor_role').val();
            $('#PVcontritibutor_role').val(contritibutor_role);

            var contritibutor_share = $('#Previewcontritibutor_share').val();
            $('#PVcontritibutor_share').val(contritibutor_share);

            var contritibutor_publishing = $('#Previewcontritibutor_publishing').val();
            $('#PVcontritibutor_publishing').val(contritibutor_publishing);

            var store = $('.previewstore').val();
            $('.PVstore').val(store);



        }
        $(document).ready(function(){
            $('#AddArtistBtn').hide();
            $('.WithOutImageHidden').hide();
            // $(".inputGroupFile02").click();
            // $('.WithOutImageHidden').show();
            GetArtistList();
        });
        $(window).load(function() {
            const month = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
            const d = new Date();
            let name = month[d.getMonth()];
            var data = name+Math.floor(Math.random()*1000000)+1;
            $('#internal_release_id').val(data);
            $('.internal_track_id').val(data);

            $("#Previewupc_ean_jan").keypress( function(e) {
            var current_val = $(this).val();
            if(current_val.length == 6 || current_val.length == 7 || current_val.length == 10 || current_val.length == 13)
            {
                $('#ShowUPCValidation').hide();
            }else{
                $('#ShowUPCValidation').show();
                $('.steps ul').removeClass('step-2');
                }
            })
        });
        function UploadImage(){
            $("#inputGroupFile02").click();
            $('.WithOutImageHidden').show();
        }
        function UploadAudio(){
            $("#inputGroupFi").click();
        }
        function GetTrackArtistDetails(data){
            $.ajax({
                url : "/admin/artists-list/"+data,
                data : {"_token": "{{ csrf_token() }}",},
                type : 'GET',
                dataType : 'json',
                success : function(result){
                    if(result.spotify_id){
                        $("#alreadyonSpotify").attr('checked', 'checked');
                        document.getElementById('handleClickTrack').classList.remove('d-none');
                        $('#contritibutor_track_spotify_id').val(result.spotify_id);
                    }else{
                        $("#alreadyonSpotify").removeAttr('checked');
                        document.getElementById('handleClickTrack').classList.add('d-none');
                        $('#contritibutor_track_spotify_id').val();
                    }
                    if(result.apple_id){
                        $("#alreadyonApple").attr('checked', 'checked');
                        document.getElementById('handleClickATrack').classList.remove('d-none');
                        $('#contritibutor_track_apple_id').val(result.apple_id);
                    }else{
                        $("#alreadyonApple").removeAttr('checked');
                        document.getElementById('handleClickATrack').classList.add('d-none');
                        $('#contritibutor_track_apple_id').val();
                    }
                }
            });
        }
        function GetArtistDetails(data){
            $.ajax({
                url : "/admin/artists-list/"+data,
                data : {"_token": "{{ csrf_token() }}",},
                type : 'GET',
                dataType : 'json',
                success : function(result){
                    if(result.spotify_id){
                        $(".has_spotify_asset").attr('checked', 'checked');
                        document.getElementById('enterSP').classList.remove('d-none');
                        $('#spotify_id_ass').val(result.spotify_id);
                        $('#PVinlineRaSpotify').attr('checked', 'checked');
                    }else{
                        $(".has_spotify_asset").removeAttr('checked');
                        document.getElementById('enterSP').classList.add('d-none');
                        $('#spotify_id_ass').val();
                        $('#PVinlineRaSpotify').attr('checked', 'checked');
                    }
                    if(result.apple_id){
                        $(".has_applemusic_asset").attr('checked', 'checked');
                        document.getElementById('enterAP').classList.remove('d-none');
                        $('#apple_id_ass').val(result.apple_id);
                        $('#AppleinlineRadio1').attr('checked', 'checked');
                    }else{
                        $(".has_applemusic_asset").removeAttr('checked');
                        document.getElementById('enterAP').classList.add('d-none');
                        $('#apple_id_ass').val();
                        $('#AppleinlineRadio1').attr('checked', 'checked');
                    }
                }
            });
        }
        function Addartistbutton(data){
            if(data == 1){
                $('#AddArtistBtn').show();
                $('.ArtistDisableEnable').removeAttr("disabled");
                $('#PVinlineRadio1').attr('checked', 'checked');
            }else if(data == 0){
                $('#AddArtistBtn').hide();
                $('.ArtistDisableEnable').attr("disabled", 'disabled');
                $('#PVinlineRadio2').attr('checked', 'checked');
            }
        }
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
                    return true;

                    // if(validation() == true){
                    //     return true;
                    // }
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
                document.getElementById('enterSP').classList.remove('d-none');
                $('#PVinlineRaSpotify').attr('checked', 'checked');
            } else {
                document.getElementById('enterSP').classList.add('d-none');
                $('#PVinlineSpotify').attr('checked', 'checked');
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
        function handleClickATrack(result) {
            if (result.value == 1) {
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
                $('#AppleinlineRadio1').attr('checked', 'checked');
                document.getElementById('enterAP').classList.remove('d-none');
            } else {
                $('#AppleinlineRadio2').attr('checked', 'checked');
                document.getElementById('enterAP').classList.add('d-none');
            }
        }
        function handleClickRD(result) {
            if (result.value == 1) {
                $('#PVpreviously_releaseYES').attr('checked', 'checked');
                document.getElementById('prelesr').classList.remove('d-none');
            } else {
                $('#PVpreviously_releaseNO').attr('checked', 'checked');
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
