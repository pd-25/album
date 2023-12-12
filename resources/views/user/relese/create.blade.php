@extends('user.main')
@section('title', env('APP_NAME') . ' | release-create')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="">
                <form action="">
                    <div id="wizard">
                        <!-- SECTION 1 -->
                        <h4></h4>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <h6><b>Cover image</b></h6>
                                        <input type="file" class="form-control" name="cover_image" placeholder="Name"
                                            id="imgInp">
                                        <img id="blah" src="#" alt="your image"
                                            style="height: 110px; width: 150px;" />
                                    </div>
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
                                            description? * </h6>

                                        <select name="language" id="" class="form-control js-example-basic-single">
                                            <option value="">select language</option>
                                            @foreach (config('country.languages') as $k => $lan)
                                                <option value="{{ $lan }}">{{ $lan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Title</b></h6>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-row">
                                        <h6>Release title * </h6>

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-row">
                                        <h6> Title version * </h6>

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-row">

                                        <input type="text" name="release_title" class="form-control"
                                            placeholder="name of your release">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-row">

                                        <input type="text" name="title_version" class="form-control"
                                            placeholder="title version">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Artist</b></h6>
                                    </div>

                                    <div class="form-row">
                                        <div>
                                            <h6>Is this a compilation of various artists? </h6>
                                        </div>

                                        <div class="ml-5">
                                            <input type="radio" name="is_various_artist" id="">Yes
                                            <input type="radio" class="ml-2 p-2" name="is_various_artist"
                                                id="">No
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <h6><b>Artist(s) – indicate ONLY ONE per field * </b></h6>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <select name="asset_artist_id" class="form-control js-example-basic-single"
                                            id="">
                                            <option value="">select artist</option>
                                            @foreach ($artists as $ass_artist)
                                                <option value="{{ $ass_artist->id }}">{{ $ass_artist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Spotify? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClick(this);" name="has_spotify_asset"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClick(this);" class="ml-2 p-2"
                                            name="has_spotify_asset" value="0">No
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="enterSP" class="d-none">
                                        <input type="text" class="form-control" name="spotify_id_ass"
                                            placeholder="enter spotify ID">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Apple Music? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClickA(this);" name="has_applemusic_asset"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClickA(this);" class="ml-2 p-2"
                                            name="has_applemusic_asset" value="0">No
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="enterAP" class="d-none">
                                        <input type="text" class="form-control" name="apple_id_ass"
                                            placeholder="enter apple ID">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Info</b></h6>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <h6>Genre 1 *</h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Genre 2 *</h6>
                                </div>

                                <div class="col-md-6">
                                    <select name="genre_one" id="" class="form-control">
                                        <option value="">select genre1</option>
                                        @foreach (config('country.genres') as $k => $g_one)
                                            <option value="{{$g_one }}">{{$g_one }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select name="genre_two" id="" class="form-control">
                                        <option value="">select genre2</option>
                                        @foreach (config('country.genres') as $k => $g_two)
                                            <option value="{{$g_two }}">{{$g_two }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h6>(P) Copyright *</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>(C) Copyright *</h6>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="p_copy" class="form-control" placeholder="2008 AMC inc">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="c_copy" class="form-control" placeholder="2008 AMC inc">
                                </div>

                                <div class="col-md-6">
                                    <h6>Previously released?</h6>
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClickRD(this);" name="has_artist"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClickRD(this);" class="ml-2 p-2"
                                            name="has_artist" value="0">No
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-none" id="prelesr">
                                        <input type="date" name="" class="form-control" id="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6>Label name *</h6>
                                    <input type="text" name="" class="form-control" id="">
                                </div>

                                <div class="col-md-6">
                                    <h6>Internal release ID *</h6>
                                    <input type="text" name="" class="form-control" id="">
                                </div>

                                <div class="col-md-6">
                                    <h6>Do you already have a UPC/EAN/JAN? </h6>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" name="" class="form-control" placeholder="xxxxxxxxx"
                                        id="">
                                </div>


                            </div>
                        </section> <!-- SECTION 2 -->
                        <h4></h4>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Audio file</b></h6>
                                        <input type="file" class="form-control" name="image">

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Language of lyrics</b></h6>
                                        <select name="language" class="form-control" id="">
                                            <option value="">ete</option>
                                            <option value="">ete</option>
                                            <option value="">ete</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <h6><b>Track title</b></h6>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <h6><b>Title version</b></h6>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" name="titleTrack" class="form-control" id="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" name="titleversion" class="form-control" id="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Artist</b></h6>
                                        <select name="language" class="form-control" id="">
                                            <option value="">ete</option>
                                            <option value="">ete</option>
                                            <option value="">ete</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h6>Artist already on Spotify? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClickTrack(this);" name="has_artist"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClickTrack(this);" class="ml-2 p-2"
                                            name="has_artist" value="0">No
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickTrack" class="d-none">
                                        <input type="text" class="form-control" placeholder="enter spotify ID">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Artist already on Apple Music? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClickATrack(this);" name="has_artist"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClickATrack(this);" class="ml-2 p-2"
                                            name="has_artist" value="0">No
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickATrack" class="d-none">
                                        <input type="text" class="form-control" placeholder="enter apple ID">
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-12">
                                    <h6>Do you have ISRC code? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" onclick="handleClickISRC(this);" name="has_artist"
                                            value="1">Yes
                                        <input type="radio" onclick="handleClickISRC(this);" class="ml-2 p-2"
                                            name="has_artist" value="0">No
                                        <span id="noIsrc" class="">(Ok, we will generate for you)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="handleClickISRC" class="d-none">
                                        <input type="text" class="form-control" placeholder="ISRC">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Explicit lyrics? * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="radio" name="has_artist" value="1">Yes
                                        <input type="radio" class="ml-2 p-2" name="has_artist" value="0">No
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h6>Teh track is: * </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <input type="radio" onclick="trackIs(this);" name="has_artist"
                                            value="1">An original song (publishing info will be required)
                                    </div>
                                    <div>
                                        <input type="radio" onclick="trackIs(this);" class=" p-2" name="has_artist"
                                            value="0">A public domain song (publishing info will be required)
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
                                    <h6>Genre 1 *</h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Genre 2 *</h6>
                                </div>

                                <div class="col-md-6">
                                    <select name="" id="" class="form-control">
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select name="" id="" class="form-control">
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <h6>(P) Copyright *</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>(C) Copyright *</h6>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="2008 AMC inc">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="2008 AMC inc">
                                </div>

                                <div class="col-md-6">
                                    <h6>Label name *</h6>
                                </div>

                                <div class="col-md-6">
                                    <h6>Internal track ID*</h6>
                                </div>

                                <div class="col-md-6">
                                    <select name="" id="" class="form-control">
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                        <option value="">sdds</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-row">
                                        <h6><b>Lyrics (Optional)</b></h6>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="form-row" style="margin-bottom: 18px">
                                <textarea name="" id="" class="form-control"
                                    placeholder="Any order note about delivery or special offer" style="height: 108px"></textarea>
                            </div>


                        </section> <!-- SECTION 3 -->
                        <h4></h4>
                        <section>
                            <h6>Add more contributor *</h6>
                            <div class="row">

                                <div class="col-md-6">
                                    <h6>Contributor name *</h6>
                                    <select name="user_id" class="form-control">
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <h6>Role *</h6>
                                    <select name="role" class="form-control">
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <h6>Share *</h6>
                                    <input type="text" name="role" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <h6>Publishing *</h6>
                                    <select name="user_id" class="form-control">
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                        <option value="">ds</option>
                                    </select>
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
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(function() {
            $("#wizard").steps({
                headerTag: "h4",
                bodyTag: "section",
                transitionEffect: "fade",
                enableAllSteps: true,
                transitionEffectSpeed: 500,
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (newIndex === 1) {
                        alert('d');
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
                        $('.steps ul').addClass('step-4');
                        $('.actions ul').addClass('step-last');
                    } else {
                        $('.steps ul').removeClass('step-4');
                        $('.actions ul').removeClass('step-last');
                    }
                    return true;
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
    </script>

@endsection
