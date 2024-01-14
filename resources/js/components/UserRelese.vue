<template>
    <div class="container">
        <div class="card rounded">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar" class="text-center">
                                    <li class="active" id="account"><strong>MAIN INFO</strong></li>
                                    <li id="personal"><strong>TRACK</strong></li>
                                    <li id="payment"><strong>PUBLISHING & STORE</strong></li>
                                    <!-- <li id="confirm"><strong>REVIEW</strong></li> -->
                                </ul>
                                <!-- fieldsets -->
                                <fieldset>
                                    <div class="row mb-2">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Cover image <span class="text-danger">*</span></b></label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <img src="/admin-asset/images/photo.png" alt="No image" style="height:50px" v-on:click="UploadImage('clickimageforupload')">
                                                    <input required type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
                                                </div>
                                                <div class="text-center" v-if="PreviewImage">
                                                    <img :src="PreviewImage" alt="your image" style="height: 150px;" />
                                                </div>
                                                <span class="text-danger">
                                                    <strong>{{ message.cover_image }}</strong>
                                                </span>
                                            </div>
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
                                            <span class="mb-0">In what language will you be writing your titles, artist name(s) and release description?</span></label>
                                            <select required name="language" v-model="language" class="custom-select" id="previewlanguage">
                                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.language }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Title <span class="text-danger">*</span></b> 
                                            <span> (Release title)</span></label>
                                            <input required v-model="release_title" type="text" name="release_title" id="Previewrelease_title" class="form-control" placeholder="Enter Name of release">
                                            <span class="text-danger">
                                                <strong>{{ message.release_title }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> <b>Title version</b></label>
                                            <input type="text" v-model="title_version" class="form-control"
                                                placeholder="Enter title version" id="Previewtitle_version">
                                            <span class="text-danger">
                                                <strong>{{ message.title_version }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label mr-4"><b>Artist  <span class="text-danger">*</span></b>
                                            <br> <span>Is this a compilation of various artists? </span>
                                            </label>
                                            <div class="form-check form-check-inline">
                                                <input required v-model="is_various_artist" class="form-check-input" type="radio" id="PreviewinlineRadio1" name="is_various_artist"  value="1" >
                                                <label class="form-check-label" for="PreviewinlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input required v-model="is_various_artist"  class="form-check-input" type="radio" id="PreviewinlineRadio2" name="is_various_artist"  value="0">
                                                <label class="form-check-label" for="PreviewinlineRadio2" >No</label>
                                            </div>
                                            <span class="text-danger">
                                                <strong>{{ message.is_various_artist }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label"><b>Artist(s) – indicate ONLY ONE per field</b></label>
                                            <select id="Previewasset_artist_id" v-model="asset_artist_id" required name="asset_artist_id" class="custom-select ArtistDisableEnable"
                                                v-on:change="GetArtistDetails()">
                                                <option v-for='(item, index) in artists' :key="index" :value='item.id'>{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> <b>Artist already on Spotify?</b> </label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="has_spotify_asset" required class="form-check-input has_spotify_asset" type="radio" id="inlineRadio1" v-on:click="ShowspotifyText= true" name="has_spotify_asset" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input  v-model="has_spotify_asset" required class="form-check-input" type="radio" id="inlineRadio2" v-on:click="ShowspotifyText= false; spotify_id_ass=null" name="has_spotify_asset" value="0">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label></label>
                                            <div id="enterSP" v-if="ShowspotifyText">
                                                <input v-model="spotify_id_ass" type="text" class="form-control" name="spotify_id_ass"
                                                    placeholder="Enter spotify ID" id="spotify_id_ass">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> <b> Artist already on Apple Music?</b> </label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="has_applemusic_asset" required class="form-check-input has_applemusic_asset" type="radio" id="inlineRadio1"  v-on:click="ShowAppleText = true"  name="has_applemusic_asset" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="has_applemusic_asset" required class="form-check-input" type="radio" id="inlineRadio2"  v-on:click="ShowAppleText = false; apple_id_ass=null" name="has_applemusic_asset" value="0">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label></label>
                                            <div id="enterAP" v-if="ShowAppleText">
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
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.genre_one }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> <b>Genre 2 </b></label>
                                            <select v-model="genre_two" name="genre_two" id="Previewgenre_two" class="custom-select">
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> <b>(P) Copyright</b><span class="text-danger"> *</span></label>
                                            <input  v-model="p_copy" required type="text" id="Previewp_copy" name="p_copy" class="form-control" placeholder="2008 M" >
                                            <span class="text-danger">
                                                <strong>{{ message.p_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                             <label class="form-label"> <b>(C) Copyright </b><span class="text-danger"> *</span></label>
                                            <input v-model="c_copy" required type="text" id="Previewc_copy" name="c_copy" class="form-control"
                                                placeholder="2008 A" >
                                            <span class="text-danger">
                                                <strong>{{ message.c_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Previously released? </b><span class="text-danger">*</span></label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio1" v-on:click="ShowReleseDateText= true" name="previously_release" value="1">
                                                    <label class="form-check-label" for="releasedinlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio2" v-on:click="ShowReleseDateText= false; " name="previously_release" value="0">
                                                    <label class="form-check-label" for="releasedinlineRadio2">No</label>
                                                </div>
                                            </div>
                                            <span class="text-danger">
                                                <strong>{{ message.previously_release }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label></label>
                                            <div v-if="ShowReleseDateText" id="prelesr">
                                                <input v-model="release_date" type="date" id="releasedrelease_date" name="release_date" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Label name </b><span class="text-danger">*</span></label>
                                            <select v-model="label_id" required name="label_id" class="custom-select">
                                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.label_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"><b>Catelog release ID </b><span class="text-danger">*</span></label>
                                            <input v-model="internal_release_id"  readonly required type="text" id="internal_release_id" name="internal_release_id" class="form-control"
                                                >
                                            <span class="text-danger">
                                                <strong>{{ message.internal_release_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"><b>Do you already have a UPC/EAN/JAN? </b> </label>
                                            <input v-model="upc_ean_jan" type="number" name="upc_ean_jan" class="form-control" placeholder="xxxxxxxxx" id="Previewupc_ean_jan" v-on:keyup="keyUPCEANJAN($event)">
                                            <span class="text-danger" id="ShowUPCValidation" v-if="ShowUPCValidation"> UPC number should be 7-8 or 11-14 character </span>
                                            <span class="text-danger">
                                                <strong>{{ message.upc_ean_jan }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="button" v-on:click="ValidateForm();" class="btn btn-danger mr-2">Validate</button>
                                    <button :disabled="ShowFirstValidation" type="button" name="next" class="next btn btn-info" v-on:click="ValidateForm();">Next Step</button>
                                </fieldset>
                                <fieldset>
                                    <div class="row" style="background: #f7fdff; padding: 10px; border-radius: 3px;" v-for="(track, index) in tracks" :key="index">
                                        <div class="col-6">
                                            <h6>Track Information</h6>
                                        </div>
                                        <div class="col-6 text-right"  v-if="index>0">
                                            <a href="#" class="text-danger" v-on:click="removeE(index)"> <b>Remove</b></a>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label"><b>Audio file <span class="text-danger">*</span></b></label>
                                            <div class="justify-content-between d-flex">
                                                <img src="/admin-asset/images/upload.png" id="clickimageforupload" v-on:click="UploadAudio()" style="height:50px">
                                                <input required type="file" v-on:change="previewFile()" accept="audio/*" ref="audioRef"  class="custom-file-label" id="inputGroupFi" name="audio[]" style="display: none" multiple>
                                                <div>
                                                    <audio controls :src="PreviewAudio[index]"></audio>
                                                    <div id="resultImage"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label"><b>Language of lyrics <span class="text-danger">*</span></b></label>
                                            <select required v-model="track.language_t" name="language_t" id="" class="custom-select">
                                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Track title <span class="text-danger">*</span></b></label>
                                            <input required v-model="track.track_title_version" type="text"  class="form-control" placeholder="Enter the track title">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Title version </b></label>
                                            <input type="text" v-model="track.title_version" class="form-control" placeholder="Enter the title version">
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label"><b>Artist</b> <span class="text-danger">*</span></label>
                                            <select multiple  v-model="track.track_artist_id"  id="ArtistOption" required   class="custom-select">
                                                <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 text-center m-auto">
                                            <label for=""></label>
                                            <button type="button" class="btn btn-primary btn-sm mt-4" data-toggle="modal" data-target="#addartist">Add Artist</button>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Do you have ISRC code? </b> <span class="text-danger">*</span> </label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.has_isrc" required class="form-check-input" :id="index+432" type="radio" value="1">
                                                    <label class="form-check-label" :for="index+432">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.has_isrc" required class="form-check-input"  :id="index+12" type="radio" value="0">
                                                    <label class="form-check-label" :for="index+12">No (Ok, we will generate for you)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div id="handleClickISRC" >
                                                <label for=""> <b>ISRC</b></label>
                                                <input v-model="track.isrc_code" type="text"  class="form-control"  maxlength="12" pattern="\d{12}" placeholder="ISRC">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label"><b>Explicit lyrics? </b><span class="text-danger">*</span></label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.explicit_lyrics" required class="form-check-input" type="radio" :id="index+865" value="1">
                                                    <label class="form-check-label" :for="index+865">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.explicit_lyrics" required class="form-check-input" type="radio" :id="index+2342" value="0">
                                                    <label class="form-check-label" :for="index+2342">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>The track is: </b><span class="text-danger">*</span> </label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.original_public" required class="form-check-input" type="radio"  v-on:click="trackIsfirst = true; trackIssecond = false;" value="1" :id="index+track">
                                                    <label class="form-check-label" :for="index+track">An original song (publishing info will be required)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.original_public" required class="form-check-input" type="radio"  v-on:click="trackIssecond = true; trackIsfirst = false;" value="0" :id="index+track">
                                                    <label class="form-check-label" :for="index+track">A public domain song (publishing info will be required)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div id="trackIssecond" v-if="trackIssecond"
                                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                                <p>
                                                    Public​ ​domain​ ​compositions​ ​are​ ​ones​ ​in​ ​which​ ​the
                                                    intellectual​ ​property​ ​rights​ ​have​ ​expired​ ​or​ ​been​ ​forfeited.
                                                    This​ ​generally​ ​applies​ ​to​ ​songs​ ​written​ ​before​ ​1923.
                                                </p>
                                            </div>
                                            <div id="trackIsfirst"  v-if="trackIsfirst"
                                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                                <p>
                                                    An​ ​original​ ​composition​ ​is​ ​a​ ​track​ ​to​ ​which​ ​you’ve​ ​contributed
                                                    lyrics​ ​and/or​ ​music,​ ​but​ ​which​ ​does​ ​NOT​ ​borrow​ ​elements
                                                    from​ ​previously​ ​created​ ​works.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="form-label"> <b> Advance info</b></h6>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Genre 1 </b><span class="text-danger">*</span></label>
                                            <select v-model="track.genre_one_track" required  id=""
                                                class="custom-select">
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Genre 2 </b></label>
                                            <select v-model="track.genre_two_track"  id=""
                                                class="custom-select">
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>(P) Copyright </b><span class="text-danger">*</span></label>
                                            <input v-model="track.p_copy_t" required type="text"  class="form-control"
                                                placeholder="2008 M" >
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>(C) Copyright </b><span class="text-danger">*</span></label>
                                            <input v-model="track.c_copy_t" required type="text" class="form-control"
                                                placeholder="2008 A" >
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Label name </b><span class="text-danger">*</span></label>
                                            <select v-model="track.track_label_id" required name="track_label_id" class="custom-select">
                                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Catelog track ID </b><span class="text-danger">*</span></label>
                                             <input  v-model="track.internal_track_id" required readonly type="text" id="internal_track_id"  name="internal_track_id" class="form-control internal_track_id" value="">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label"><b>Lyrics (Optional)</b></label>
                                            <div class="form-row">
                                                <textarea id="" class="form-control"
                                                    placeholder="Any order note about delivery or special offer" style="height: 108px" v-model="track.lyrics"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-success" v-on:click="AddNewTrack()">Add track</button>
                                        </div>
                                    </div>
                                    <button type="button" name="previous" class="btn btn-danger" v-on:click="ValidateFormSEC()"> Validate</button>
                                    <button type="button" name="previous" class="previous btn btn-secondary mx-2" v-on:click="ValidateFormSEC()"> Previous</button>
                                    <button type="button" name="previous" class="next btn btn-info" :disabled="ShowThirdValidation" v-on:click="ValidateFormSEC()"> Next Step</button>
                                </fieldset>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Add more contributor</h6>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label"><b>Contributor name </b><span class="text-danger">*</span></label>
                                            <select required name="contritibutor_track_artist_name" v-model="contritibutor_track_artist_name"
                                                class="custom-select" id="Previewcontritibutor_track_artist_name">
                                                <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{item.name }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.contritibutor_track_artist_name }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label"><b>Role </b><span class="text-danger">*</span></label>
                                            <select required v-model="contritibutor_role" name="contritibutor_role" id="Previewcontritibutor_role" class="custom-select">
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
                                                <strong>{{ message.contritibutor_role }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label"><b>Share </b><span class="text-danger">*</span></label>
                                            <input required type="number" id="Previewcontritibutor_share" v-model="contritibutor_share" name="contritibutor_share" class="form-control" placeholder="001">
                                            <span class="text-danger">
                                                <strong>{{ message.contritibutor_share }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"><b>Publishing </b><span class="text-danger">*</span></label>
                                            <select v-model="contritibutor_publishing" required name="contritibutor_publishing" id="Previewcontritibutor_publishing" class="custom-select">
                                                <option value="">select publishing</option>
                                                <option value="Copyright control (self-published)">Copyright control (self-published)</option>
                                                <option value="Public domain (no publisher)">Public domain (no publisher)</option>
                                                <option value="Published (managed by a publisher)">Published (managed by a publisher)</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.contritibutor_publishing }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-12">
                                            <h6><b>Select Store</b></h6>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" class="form-check-input" v-model="AllChecked" v-on:click="CheckedAllStore()">
                                                    <label class="form-check-label" for="inlineCheckbox1">All</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-3" v-for="(stor , kk) in stores" :key="kk">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-8 col-form-label">
                                                            <span> <img style="height: 40px" :src="'/storage/store/'+stor.cover_image" alt="No Image"></span>
                                                            {{stor.label_name }}</label>
                                                        <div class="col-sm-4">
                                                        <input type="checkbox" class="form-control-plaintext" id="staticEmail" v-model="CheckStore" :value="stor.id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#ModalForpreview" >Preview</button>
                                        </div>
                                    </div>
                                    
                                    <button type="button" name="next" class="btn btn-danger" v-on:click="ValidateFormIII()"> Validate </button>
                                    <button type="button" name="previous" class="previous btn btn-secondary mx-2" v-on:click="ValidateFormIII()"> Previous </button>
                                    <button :disabled="ShowSecondValidation" type="button" name="next" class="btn btn-success" v-on:click="SubmitReleseDetails()"> Confirm</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label> <b>Artist Name</b></label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" placeholder="full name" name="name" v-model="Modalname">
                                </div>
                                <div class="col-md-6">
                                    <label> <b>Email</b></label><span class="text-danger">*</span>
                                    <input type="email" class="form-control" v-model="Modalemail" placeholder="abc@mail.com" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label> <b> Attach the banner image here </b></label><span class="text-danger">*</span>
                                    <input type="file" class="form-control" name="image"
                                        ref="ModalImageRef" v-on:change="UploadDocuments()">
                                    <span>File format: JPG or PNG</span><br>
                                    <span>Recommended minimum width or height: 1400 pixels</span>
                                </div>
                                <div class="col-md-6" v-if="ModalPreview">
                                    <img id="blah" :src="ModalPreview" alt="your image"
                                        style="height: 110px; width: 150px;" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> <b>Biography</b></label>
                            <textarea name="biography" v-model="Modalbiography" class="form-control" cols="40" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label> <b> Indicate this artist's IDs if they already have a profile page on these music
                                services.</b></label>
                            <div class="row">
                                <div class="col-md-1">
                                    <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                        data-placement="top" title=""
                                        style="background-image: url('/spy.png'); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                        data-original-title="Spotify artist ID"></label>
                                </div>
                                <div class="col-md-11">
                                    <input class="form-control ui-input has-error" type="text"
                                        placeholder="Enter Spotify artist ID"  v-model="Modalspotify_id" id="Modalspotify_id" name="spotify_id"
                                        data-bind="value: spotifyId.editable, attr: { maxlength: 22 }"
                                        title="Invalid Spotify Id, it must start with a number from 0 to 7, followed by 21 characters, which must be either a number or letter from Latin alphabet."
                                        maxlength="22" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <label class="inline vertical-center img-list" data-bind="tooltip: ''"
                                        data-placement="top" title=""
                                        style="background-image: url('/aple.png'); width: 30px; height: 30px; margin-top: 10px; background-size: cover; background-position: center center;"
                                        data-original-title="Apple Music artist ID"></label>
                                </div>
                                <div class="col-md-11">
                                    <input class="form-control ui-input" type="number"
                                        placeholder="Enter Apple Music artist ID"  v-model="Modalapple_id" id="Modalapple_id" name="apple_id"
                                        data-bind="value: appleId.editable, attr: { maxlength: 10 }" maxlength="10"
                                        title="" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" id="submitBtn" v-on:click="SubmitArtist()"  type="submit">
                                <span class="d-none spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                <span class="">Submit</span>
                            </button>
                        </div>
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
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Cover image <span class="text-danger">*</span></b></label>
                            <div class="d-flex justify-content-between">
                                <!-- <div>
                                    <img src="/admin-asset/images/photo.png" alt="No image" style="height:50px" v-on:click="UploadImage('clickimageforupload')">
                                    <input required type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
                                </div> -->
                                <div class="text-center" v-if="PreviewImage">
                                    <img :src="PreviewImage" alt="your image" style="height: 150px;" />
                                </div>
                            </div>
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
                            <span class="mb-0">In what language will you be writing your titles, artist name(s) and release description?</span></label>
                            <select disabled required name="language" v-model="language" class="custom-select" id="previewlanguage">
                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Title <span class="text-danger">*</span></b> 
                            <span> (Release title)</span></label>
                            <input disabled required v-model="release_title" type="text" name="release_title" id="Previewrelease_title" class="form-control" placeholder="Enter Name of release">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"> <b>Title version</b></label>
                            <input disabled type="text" v-model="title_version"  class="form-control"
                                placeholder="Enter title version" id="Previewtitle_version">
                        </div>
                        <div class="col-md-8 mb-2">
                            <label class="form-label mr-4"><b>Artist <span class="text-danger">*</span></b>
                            <br> <span>Is this a compilation of various artists? </span>
                            </label>
                            <div class="form-check form-check-inline">
                                <input disabled required v-model="is_various_artist" class="form-check-input" type="radio" id="PreviewinlineRadio1" name="is_various_artist"  value="1">
                                <label class="form-check-label" for="PreviewinlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input disabled required v-model="is_various_artist"  class="form-check-input" type="radio" id="PreviewinlineRadio2" name="is_various_artist" value="0">
                                <label class="form-check-label" for="PreviewinlineRadio2" >No</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><b>Artist(s) – indicate ONLY ONE per field </b></label>
                            <select disabled id="Previewasset_artist_id" v-model="asset_artist_id" required name="asset_artist_id" class="custom-select ArtistDisableEnable"
                                v-on:change="GetArtistDetails()">
                                <option v-for='(item, index) in artists' :key="index" :value='item.id'>{{ item.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"> <b>Artist already on Spotify?</b> </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="has_spotify_asset" required class="form-check-input has_spotify_asset" type="radio" id="inlineRadio1" v-on:click="ShowspotifyText= true" name="has_spotify_asset" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="has_spotify_asset" required class="form-check-input" type="radio" id="inlineRadio2" v-on:click="ShowspotifyText= false;" name="has_spotify_asset" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label></label>
                            <div id="enterSP" v-if="ShowspotifyText">
                                <input disabled v-model="spotify_id_ass" type="text" class="form-control" name="spotify_id_ass"
                                    placeholder="Enter spotify ID" id="spotify_id_ass">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"> <b> Artist already on Apple Music?</b>  </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="has_applemusic_asset" required class="form-check-input has_applemusic_asset" type="radio" id="inlineRadio1"  v-on:click="ShowAppleText = true"  name="has_applemusic_asset" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="has_applemusic_asset" required class="form-check-input" type="radio" id="inlineRadio2"  v-on:click="ShowAppleText = false;" name="has_applemusic_asset" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label></label>
                            <div id="enterAP" v-if="ShowAppleText">
                                <input disabled v-model="apple_id_ass" type="text" class="form-control" name="apple_id_ass"
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
                            <select disabled v-model="genre_one" required name="genre_one" class="custom-select" id="Previewgenre_one">
                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"> <b>Genre 2 </b></label>
                            <select disabled v-model="genre_two" name="genre_two" id="Previewgenre_two" class="custom-select">
                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"> <b>(P) Copyright</b><span class="text-danger"> *</span></label>
                            <input disabled v-model="p_copy" required type="text" id="Previewp_copy" name="p_copy" class="form-control" placeholder="2008 M" >
                        </div>
                        <div class="col-md-6 mb-2">
                                <label class="form-label"> <b>(C) Copyright </b><span class="text-danger"> *</span></label>
                            <input disabled v-model="c_copy" required type="text" id="Previewc_copy" name="c_copy" class="form-control"
                                placeholder="2008 A" >
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Previously released? </b><span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio1" v-on:click="ShowReleseDateText= true" name="previously_release" value="1">
                                    <label class="form-check-label" for="releasedinlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="previously_release" required class="form-check-input" type="radio"  id="releasedinlineRadio2" v-on:click="ShowReleseDateText= false;" name="previously_release" value="0">
                                    <label class="form-check-label" for="releasedinlineRadio2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label></label>
                            <div v-if="ShowReleseDateText" id="prelesr">
                                <input disabled v-model="release_date" type="date" id="releasedrelease_date" name="release_date" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Label name </b><span class="text-danger">*</span></label>
                            <select disabled v-model="label_id" required name="label_id" class="custom-select">
                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><b>Catelog release ID </b><span class="text-danger">*</span></label>
                            <input disabled v-model="internal_release_id"  readonly required type="text" id="internal_release_id" name="internal_release_id" class="form-control"
                                >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><b>Do you already have a UPC/EAN/JAN? </b> </label>
                            <input disabled v-model="upc_ean_jan" type="number" name="upc_ean_jan" class="form-control" placeholder="xxxxxxxxx" id="Previewupc_ean_jan" v-on:keyup="keyUPCEANJAN($event)">
                            <span class="text-danger" id="ShowUPCValidation" v-if="ShowUPCValidation"> UPC number should be 7-8 or 11-14 character </span>
                        </div>
                    </div>
                    <div class="row" style="background: #f7fdff; padding: 10px; border-radius: 3px;" v-for="(track, index) in tracks" :key="index">
                        <div class="col-6">
                            <h6>Track Information</h6>
                        </div>
                        <!-- <div class="col-6 text-right"  v-if="index>0">
                            <a href="#" class="text-danger" v-on:click="removeE(index)"> <b>Remove</b></a>
                        </div> -->
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><b>Audio file <span class="text-danger">*</span></b></label>
                            <div class="justify-content-between d-flex">
                                <!-- <img src="/admin-asset/images/upload.png" id="clickimageforupload" v-on:click="UploadAudio()" style="height:50px">
                                <input required type="file" v-on:change="previewFile()" accept="audio/*" ref="audioRef"  class="custom-file-label" name="audio" id="inputGroupFi" style="display: none"> -->
                                <div>
                                    <audio controls :src="PreviewAudio[index]"></audio>
                                    <div id="resultImage"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><b>Language of lyrics <span class="text-danger">*</span></b></label>
                            <select disabled required v-model="track.language_t" name="language_t" id="" class="custom-select">
                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Track title <span class="text-danger">*</span></b></label>
                            <input disabled required v-model="track.track_title_version" type="text" name="track_title_version" class="form-control" placeholder="Enter the track title">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Title version </b></label>
                            <input disabled type="text" v-model="track.title_version" name="title_version" class="form-control" placeholder="Enter the title version">
                        </div>
                        <div class="col-md-8 mb-2">
                            <label class="form-label"><b>Artist</b> <span class="text-danger">*</span></label>
                            <select multiple disabled  v-model="track.track_artist_id"  id="ArtistOption" required name="track_artist_id"  class="custom-select">
                                <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{item.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Do you have ISRC code? </b> <span class="text-danger">*</span> </label>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.has_isrc" required class="form-check-input" type="radio" id="ISRCcode" v-on:click="handleClickISRC=true" value="1">
                                    <label class="form-check-label" for="ISRCcode">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.has_isrc" required class="form-check-input" type="radio" id="ISRCcodePP" v-on:click="handleClickISRC =false; " value="0">
                                    <label class="form-check-label" for="ISRCcodePP">No (Ok, we will generate for you)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div id="handleClickISRC" >
                                <label for=""> <b>ISRC</b></label>
                                <input disabled v-model="track.isrc_code" type="text" name="isrc_code" class="form-control"  maxlength="12" pattern="\d{12}" placeholder="ISRC">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><b>Explicit lyrics? </b><span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.explicit_lyrics" required class="form-check-input" type="radio" id="explicit_lyrics" value="1">
                                    <label class="form-check-label" for="explicit_lyrics">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.explicit_lyrics" required class="form-check-input" type="radio" id="explicit_lyricsPP" value="0">
                                    <label class="form-check-label" for="explicit_lyricsPP">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>The track is: </b><span class="text-danger">*</span> </label>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.original_public" required class="form-check-input" type="radio" id="original_public" v-on:click="trackIsfirst = true; trackIssecond = false;" value="1">
                                    <label class="form-check-label" for="original_public">An original song (publishing info will be required)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input disabled v-model="track.original_public" required class="form-check-input" type="radio" id="original_publicPP" v-on:click="trackIssecond = true; trackIsfirst = false;" value="0">
                                    <label class="form-check-label" for="original_publicPP">A public domain song (publishing info will be required)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div id="trackIssecond" v-if="trackIssecond"
                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                <p>
                                    Public​ ​domain​ ​compositions​ ​are​ ​ones​ ​in​ ​which​ ​the
                                    intellectual​ ​property​ ​rights​ ​have​ ​expired​ ​or​ ​been​ ​forfeited.
                                    This​ ​generally​ ​applies​ ​to​ ​songs​ ​written​ ​before​ ​1923.
                                </p>
                            </div>
                            <div id="trackIsfirst"  v-if="trackIsfirst"
                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                <p>
                                    An​ ​original​ ​composition​ ​is​ ​a​ ​track​ ​to​ ​which​ ​you’ve​ ​contributed
                                    lyrics​ ​and/or​ ​music,​ ​but​ ​which​ ​does​ ​NOT​ ​borrow​ ​elements
                                    from​ ​previously​ ​created​ ​works.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6 class="form-label"> <b> Advance info</b></h6>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Genre 1 </b><span class="text-danger">*</span></label>
                            <select disabled v-model="track.genre_one_track" required name="genre_one_track" id=""
                                class="custom-select">
                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Genre 2 </b></label>
                            <select disabled v-model="track.genre_two_track" name="genre_two_track" id=""
                                class="custom-select">
                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>(P) Copyright </b><span class="text-danger">*</span></label>
                            <input disabled v-model="track.p_copy_t" required type="text" name="p_copy_t" class="form-control"
                                placeholder="2008 M" >
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>(C) Copyright </b><span class="text-danger">*</span></label>
                            <input disabled v-model="track.c_copy_t" required type="text" name="c_copy_t" class="form-control"
                                placeholder="2008 A" >
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Label name </b><span class="text-danger">*</span></label>
                            <select disabled v-model="track.track_label_id" required name="track_label_id" class="custom-select">
                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Catelog track ID </b><span class="text-danger">*</span></label>
                                <input disabled v-model="track.internal_track_id" required readonly type="text" id="internal_track_id"  name="internal_track_id" class="form-control internal_track_id" value="">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><b>Lyrics (Optional)</b></label>
                            <div class="form-row">
                                <textarea disabled name="lyrics" id="" class="form-control"
                                    placeholder="Any order note about delivery or special offer" style="height: 108px" v-model="track.lyrics"></textarea>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <h6>Add more contributor</h6>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label"><b>Contributor name </b><span class="text-danger">*</span></label>
                            <select disabled required name="contritibutor_track_artist_name" v-model="contritibutor_track_artist_name"
                                class="custom-select" id="Previewcontritibutor_track_artist_name">
                                <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{item.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label"><b>Role </b><span class="text-danger">*</span></label>
                            <select disabled required v-model="contritibutor_role" name="contritibutor_role" id="Previewcontritibutor_role" class="custom-select">
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
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label"><b>Share </b><span class="text-danger">*</span></label>
                            <input disabled required type="number" id="Previewcontritibutor_share" v-model="contritibutor_share" name="contritibutor_share" class="form-control" placeholder="001">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><b>Publishing </b><span class="text-danger">*</span></label>
                            <select disabled v-model="contritibutor_publishing" required name="contritibutor_publishing" id="Previewcontritibutor_publishing" class="custom-select">
                                <option value="">select publishing</option>
                                <option value="Copyright control (self-published)">Copyright control (self-published)</option>
                                <option value="Public domain (no publisher)">Public domain (no publisher)</option>
                                <option value="Published (managed by a publisher)">Published (managed by a publisher)</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-3" v-for="(stor , kk) in stores" :key="kk">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-8 col-form-label">
                                            <span> <img style="height: 40px" :src="'/storage/store/'+stor.cover_image" alt="No Image"></span>
                                            {{stor.label_name }}</label>
                                        <div class="col-sm-4">
                                        <input disabled type="checkbox" class="form-control-plaintext" id="staticEmail" v-model="CheckStore" :value="stor.id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Notify} from 'notiflix/build/notiflix-notify-aio';
import { Confirm } from 'notiflix/build/notiflix-confirm-aio';
import { Report } from 'notiflix/build/notiflix-report-aio';
export default {
    props:['artists','labels','stores', 'alllanguage', 'genre1'],
    data() {
        return {
            ShowFirstValidation:true,
            ShowSecondValidation:true,
            ShowThirdValidation:true,

            AllChecked:false,
            AllArtist:[],
            AddClass:'',
            PreviewImage:'',
            ShowspotifyText:false,
            ShowAppleText:false,
            ShowReleseDateText:false,
            handleClickISRC:false,
            trackIssecond:false,
            trackIsfirst:false,
            ShowUPCValidation:true,
            message:{
                cover_image:'',
                language:'',
                release_title:'',
                is_various_artist:'',
                asset_artist_id:'',
                has_spotify_asset:'',
                spotify_id_ass:'',
                has_applemusic_asset:'',
                apple_id_ass:'',
                genre_one:'',
                p_copy:'',
                c_copy:'',
                previously_release:'',
                label_id:'',
                internal_release_id:'',
                upc_ean_jan:'',
            },

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
            PreviewAudio:[],
            audio:[],
            tracks:[{
                // audio:"",
                language_t:'',
                track_title_version:'',
                title_version:'',
                track_artist_id:[],
                has_isrc:'',
                isrc_code:'',
                explicit_lyrics:'',
                original_public:"",
                genre_one_track:'',
                genre_two_track:'',
                p_copy_t:"",
                c_copy_t:'',
                track_label_id:'',
                internal_track_id: "",
                lyrics:'',
            }],

            contritibutor_track_artist_name:"",
            contritibutor_role:'',
            contritibutor_share:'',
            contritibutor_publishing:'',
            CheckStore:[],

            Modalimage:'',
            ModalPreview:'',
            Modalname:'',
            Modalemail:'',
            Modalbiography:'',
            Modalspotify_id:'',
            Modalapple_id:'',
        }
    },
    created(){
        this.GetALLArtistList();
    },
    mounted() {
        this.GetCatelogreleaseID();
    },
    methods: {
        SubmitReleseDetails(){
            Confirm.show('Review Confirmation','Do you want to submit for Review ?','Yes','No',
            () => {
                if(this.cover_image  &&  this.language  && this.release_title &&  this.is_various_artist &&  this.genre_one && this.p_copy && this.c_copy && this.previously_release && this.label_id && this.contritibutor_track_artist_name  &&  this.contritibutor_role  &&  this.contritibutor_share  && this.contritibutor_publishing  &&
                 
                this.tracks[0].language_t && this.tracks[0].track_title_version &&this.tracks[0].track_artist_id.length > 0 && this.tracks[0].has_isrc && this.tracks[0].explicit_lyrics && this.tracks[0].original_public && this.tracks[0].genre_one_track && this.tracks[0].p_copy_t && this.tracks[0].c_copy_t && this.tracks[0].track_label_id)
                {
                    var formData = new FormData();
                    formData.append('cover_image', this.cover_image);
                    formData.append('language', this.language);
                    formData.append('release_title', this.release_title);
                    formData.append('title_version', this.title_version);
                    formData.append('is_various_artist', this.is_various_artist);
                    formData.append('asset_artist_id', this.asset_artist_id);
                    formData.append('has_spotify_asset', this.has_spotify_asset);
                    formData.append('spotify_id_ass', this.spotify_id_ass);
                    formData.append('has_applemusic_asset', this.has_applemusic_asset);
                    formData.append('apple_id_ass', this.apple_id_ass);
                    formData.append('genre_one', this.genre_one);
                    formData.append('genre_two', this.genre_two);
                    formData.append('p_copy', this.p_copy);
                    formData.append('c_copy', this.c_copy);
                    formData.append('previously_release', this.previously_release);
                    formData.append('release_date', this.release_date);
                    formData.append('label_id', this.label_id);
                    formData.append('internal_release_id', this.internal_release_id);
                    formData.append('upc_ean_jan', this.upc_ean_jan);
                    this.audio.forEach((file,index) =>{
                        formData.append('audio['+index+']', file);
                    });
                    formData.append('tracks', JSON.stringify(this.tracks));
                    formData.append('contritibutor_track_artist_name', this.contritibutor_track_artist_name);
                    formData.append('contritibutor_role', this.contritibutor_role);
                    formData.append('contritibutor_share', this.contritibutor_share);
                    formData.append('contritibutor_publishing', this.contritibutor_publishing);
                    formData.append('CheckStore', JSON.stringify(this.CheckStore));
                    axios.post('/asset',formData,{
                    headers: { 'Content-Type': 'multipart/form-data'}, } )
                    .then((res)=>{
                    this.ClearData();
                    window.location.href = '/asset'
                    Report.success('Review','You have fill up the form sucessfully. Submit it for approval','Okay');
                    },()=>{
                        Notify.failure("Error “Please fill out all required fields.”");
                    })
                }else{
                    Notify.failure('Please fill the all mendetroy fields');
                }
            },
            () => {
            })
        },
        CheckedAllStore(){
            if(this.AllChecked != true)
            {
                this.stores.forEach((value, index) => {
                    this.CheckStore.push(value.id)
                });
            }else{
                this.CheckStore = []
            }
        },
        AddNewTrack(){
            this.tracks.push({language_t:'',track_title_version:'',title_version:'',track_artist_id:[],has_isrc:'',isrc_code:'',explicit_lyrics:'',original_public:"",genre_one_track:'',genre_two_track:'',p_copy_t:"",c_copy_t:'',track_label_id:'',internal_track_id:'',lyrics:''});

            this.tracks.forEach((value, index) => {
                value.internal_track_id = this.internal_release_id;
            });
        },
        removeE(index){
            this.tracks.splice(index, 1)
        },
        UploadAudio(){
            $('#inputGroupFi').click();
        },
        previewFile(){
            for (var i = 0; i < this.$refs.audioRef.length; i++ ){
                let file = this.$refs.audioRef[i].files[0];
                if(file.type == 'audio/wav'){
                    this.audio.push(file)
                    this.PreviewAudio.push(URL.createObjectURL(file))
                }else{
                    this.$refs.audioRef[i].value = null;
                    Notify.failure('Invalid file type. Only Wav are allowed.');
                }
            }
        },
        keyUPCEANJAN(e){
            var current_val = JSON.stringify(this.upc_ean_jan);
            if(current_val.length == 7 || current_val.length == 8 || current_val.length == 11 || current_val.length == 14)
            {
                this.ShowUPCValidation = false;
            }else{
                this.ShowUPCValidation = true;
            }
        },
        GetCatelogreleaseID(){
            const month = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
            const d = new Date();
            let name = month[d.getMonth()];
            var data = name+Math.floor(Math.random()*1000000)+1;
            this.internal_release_id = data;
            // console.log(this.track.internal_track_id)
            // this.track.internal_track_id = data;
            this.tracks.forEach((value, index) => {
                value.internal_track_id = data;
            });
        },
        UploadImage(id){
            $("#"+id).click();
        },
        onFileChange(){
            this.cover_image = this.$refs.ImageRef.files[0];
            let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(this.cover_image.type) && (this.cover_image.size > 50000 || this.cover_image.size < 10000000)) {
                Notify.failure('Invalid file type. Only JPG, JPEG and PNG are allowed.');
                this.$refs.ImageRef.value = null;
                return;
            }else{
                this.PreviewImage = URL.createObjectURL(this.cover_image);
                Notify.success('File OK');
            }
        },
        GetArtistDetails(){
            axios.get('/artists-list/'+this.asset_artist_id)
            .then((Response)=>{
                if(Response.data.spotify_id != null){
                    this.has_spotify_asset = 1;
                    this.ShowspotifyText = true;
                    this.spotify_id_ass = Response.data.spotify_id;
                }else{
                    this.has_spotify_asset = 0;
                    this.ShowspotifyText = false;

                }
                if(Response.data.apple_id != null){
                    this.has_applemusic_asset = 1;
                    this.ShowAppleText = true;
                    this.apple_id_ass = Response.data.apple_id;
                }else{
                    this.has_applemusic_asset = 0;
                    this.ShowAppleText = false;
                }
            },()=>{
                    Notiflix.Notify.Failure("Please contact with authorized person.");
            });
        },
        GetALLArtistList(){
            axios.get('/artists-list')
            .then((Response)=>{
                this.AllArtist = Response.data;
            },()=>{
                    Notiflix.Notify.Failure("Please contact with authorized person.");
            });
        },
        ValidateForm(){
            if(this.cover_image  &&  this.language  && this.release_title &&  this.is_various_artist &&  this.genre_one && this.p_copy && this.c_copy && this.previously_release && this.label_id && this.ShowUPCValidation == false )
            {
                this.ShowFirstValidation = false;
                this.message.cover_image = "";
                this.message.language = "";
                this.message.release_title ="";
                this.message.is_various_artist =  "";
                this.message.genre_one =  "";
                this.message.p_copy =  "";
                this.message.c_copy =  "";
                this.message.previously_release =  "";
                this.message.label_id =  "";
                Notify.success('Validate');
            }else{
                this.ShowFirstValidation = true;
                this.cover_image ==""  ? this.message.cover_image = "Image field is required" :  this.message.cover_image = "";
                this.language ==""  ? this.message.language = "Language field is required" : this.message.language = "";
                this.release_title =="" ? this.message.release_title = "Release title field is required" : this.message.release_title ="";
                this.is_various_artist ==""? this.message.is_various_artist = "Artist field is required" : this.message.is_various_artist =  "";
                this.genre_one ==""?this.message.genre_one = "Genre one field is required" : this.message.genre_one =  "";
                this.p_copy ==""?this.message.p_copy = "P copy field is required" : this.message.p_copy =  "";
                this.c_copy ==""?this.message.c_copy = "C copy field is required" : this.message.c_copy =  "";
                this.previously_release =="" ? this.message.previously_release = "Previously release field is required" : this.message.previously_release =  "";
                this.label_id ==""?this.message.label_id = "Label Id field is required" : this.message.label_id =  "";
                Notify.failure('Please fill the all mendetroy fields');
            }
        },
        ValidateFormIII(){
            if(this.contritibutor_track_artist_name  &&  this.contritibutor_role  &&  this.contritibutor_share  && this.contritibutor_publishing)
            {
                this.ShowSecondValidation = false;
                this.message.contritibutor_track_artist_name = "";
                this.message.contritibutor_role = "";
                this.message.contritibutor_share = "";
                this.message.contritibutor_publishing ="";
                Notify.success('Validate');
            }else{
                this.ShowSecondValidation = true;

                this.contritibutor_track_artist_name =="" ? this.message.contritibutor_track_artist_name = "Contritibutor track artist name field is required" : this.message.contritibutor_track_artist_name = "";
                this.contritibutor_role ==""  ? this.message.contritibutor_role = "Contritibutor role field is required" :  this.message.contritibutor_role = "";
                this.contritibutor_share ==""  ? this.message.contritibutor_share = "Contritibutor share field is required" : this.message.contritibutor_share = "";
                this.contritibutor_publishing =="" ? this.message.contritibutor_publishing = "Contritibutor publishing field is required" : this.message.contritibutor_publishing ="";
                Notify.failure('Please fill the all mendetroy fields');
            }
        },
        ValidateFormSEC(){
            this.tracks.forEach((value, index) => {
                if(value.language_t && value.track_title_version &&value.track_artist_id.length > 0 && value.has_isrc && value.explicit_lyrics && value.original_public && value.genre_one_track && value.p_copy_t && value.c_copy_t && value.track_label_id){
                    this.ShowThirdValidation = false;
                    Notify.success('Validate');
                }else{
                    this.ShowThirdValidation = true;
                    Notify.failure('Please fill the all mendetroy fields');
                }
            });
        },
        // modal 
        UploadDocuments(){
            this.Modalimage = this.$refs.ModalImageRef.files[0];
            let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(this.Modalimage.type)) {
                Notify.failure('Invalid file type. Only JPG, JPEG and PNG are allowed.');
                this.$refs.ModalImageRef.value = null;
                return;
            }else{
                this.ModalPreview = URL.createObjectURL(this.Modalimage)
                Notify.success('File OK');
            }
        },
        SubmitArtist(){
            if(this.Modalname && this.Modalemail && this.Modalbiography && this.Modalspotify_id && this.Modalapple_id)
            {
                var formData = new FormData();
                formData.append('name', this.Modalname);
                formData.append('email', this.Modalemail);
                formData.append('biography', this.Modalbiography);
                formData.append('image', this.Modalimage);
                formData.append('spotify_id', this.Modalspotify_id);
                formData.append('apple_id', this.Modalapple_id);
                axios.post('/admin/artists',formData,
            { headers: { 'Content-Type': 'multipart/form-data' }}
            )
            .then((Response)=>{
                this.GetALLArtistList();
                Notify.success('Added Successfully');
                this.Modalname ='';
                this.Modalemail = '';
                this.Modalbiography = '';
                this.$refs.ModaleRef.value = null;
                this.Modalspotify_id ='';
                this.Modalapple_id ='';
            },()=>{
                Notify.failure("Somethings went wrong, Please contact with authorized person.");
            });
            }else{
                Notify.failure("Please fill the all mandatory fields");
            }
        },
        ClearData(){
            this.cover_image='';
            this.language='';
            this.release_title='';
            this.title_version='';
            this.is_various_artist='';
            this.asset_artist_id='';
            this.has_spotify_asset='';
            this.spotify_id_ass='';
            this.has_applemusic_asset='';
            this.apple_id_ass='';
            this.genre_one='';
            this.genre_two='';
            this.p_copy='';
            this.c_copy='';
            this.previously_release='';
            this.release_date='';
            this.label_id='';
            this.internal_release_id='';
            this.upc_ean_jan='';
            this.PreviewAudio=[];
            this.audio=[];
            this.tracks=[{
                // audio:"",
                language_t:'',
                track_title_version:'',
                title_version:'',
                track_artist_id:[],
                has_isrc:'',
                isrc_code:'',
                explicit_lyrics:'',
                original_public:"",
                genre_one_track:'',
                genre_two_track:'',
                p_copy_t:"",
                c_copy_t:'',
                track_label_id:'',
                internal_track_id: "",
                lyrics:'',
            }];
            this.contritibutor_track_artist_name="";
            this.contritibutor_role='';
            this.contritibutor_share='';
            this.contritibutor_publishing='';
            this.CheckStore=[];
        },
    },
}
</script>
<style>
    * {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

/*Background color*/
#grad1 {
    background-color: #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA);
}

/*form styles*/
#msform {
    /* text-align: center; */
    position: relative;
    margin-top: 20px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;

    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
}

#msform input, #msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px;
}

#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0;
}

/*Blue Buttons*/
#msform .action-button {
    width: 100px;
    background: #1a69ca;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
    border-radius: 4px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
}

/*Dropdown List Exp Date*/
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 33%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f05a";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f001";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f093";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f002";
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #02CF8B;
}

/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}

.radio {
    display:inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor:pointer;
    margin: 8px 2px; 
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}
</style>