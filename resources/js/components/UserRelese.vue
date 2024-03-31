<template>
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        <div class="d-flex align-items-center">
            <a href="/asset"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="ml-4 ">
            <h3 style="font-size: 400">Create release</h3>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <ul id="progressbar" class="text-center">
                                <li class="active" id="account"><strong>MAIN INFO</strong></li>
                                <li id="personal"><strong>TRACK</strong></li>
                                <li id="payment"><strong>PUBLISHING & STORE</strong></li>
                                <li id="confirm"><strong>REVIEW</strong></li>
                            </ul>
                            <fieldset>
                                <div class="card mb-4">
                                    <div class="row mb-2">
                                        <div class="col-12 border-bottom mb-2">
                                            <h5 class=""> COVER IMAGE </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="">
                                                <div v-if="!PreviewImage">
                                                    <img src="/admin-asset/images/photo.png" alt="No image" style="height:150px" v-on:click="UploadImage('clickimageforupload')">
                                                    <input  type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
                                                </div>
                                                <div class="text-center" v-if="PreviewImage">
                                                    <img :src="PreviewImage" alt="your image" style="height:200px;" />
                                                    <span class="ml-2 text-warning"> <i class="ti-pencil font-weight-bold" v-on:click="UploadImage('clickimageforupload')"></i> 
                                                        <input  type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
                                                    </span>
                                                </div>
                                                <span class="text-danger">
                                                    <strong>{{ message.cover_image }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-row" style="font-size: 11px;font-family: emoji;">
                                                <p class="mb-2 font-weight-bold">Please follow these rules so your release isn't rejected by the stores & services:</p>
                                                <ul>
                                                    <li class="line">File format: PNG, GIF, BMP, TIF, JPG or JPEG</li>
                                                    <li class="line"> Color space: RGB</li>
                                                    <li class="line">Minimum dimensions: 1400x1400 pixels, but recommend 3000x3000 pixels.</li>
                                                    <li class="line">Square image: width and height must be the same.</li>
                                                    <li class="line">Images may not contain more than 50 megapixels or be larger than 10 Mb.</li>
                                                    <li class="line">Your image cannot be stretched, upscaled, or appear to be low-resolution.
                                                    </li>
                                                    <li class="line">The information on your cover art must match your album title and artist
                                                        name.</li>
                                                    <li class="line">Website addresses, social media links and contact information are not
                                                        permitted on album artwork.</li>
                                                    <li class="line"> Your cover art may not include sexually explicit imagery.</li>
                                                    <li class="line">Your cover art cannot be misleading by figuring another artist's name more
                                                        prominently than yours.</li>
                                                    <li class="line">You may not use a third-party logo or trademark without the express written
                                                        permission from the trademark holder.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-md-12 border-bottom mb-2">
                                            <h5 class="">LANGUAGE</h5>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <span class="mb-0">In what language will you be writing your titles, artist name(s) and release description? <span class="text-danger">*</span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="This question does NOT concern the language of your songs/lyrics. The services just want to know what is the language of the information you'll be writing below.">
                                            <i class="ti-help-alt"></i></a></span>
                                            <select v-model="language" class="" id="SingleSelect">
                                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.language }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-md-12 border-bottom mb-2">
                                            <h5 class="">TITLE</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label"> Release title <span class="text-danger">*</span></label>
                                            <input v-model="release_title" type="text"  id="Previewrelease_title" class="form-control control-form" placeholder="Enter Name of release">
                                            <span class="text-danger">
                                                <strong>{{ message.release_title }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label"> Title version <a type="button" class="text-info ml-2" data-toggle="tooltip" title="This is typically left blank, unless it's a new version of a previously-released album.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <input type="text" v-model="title_version" class="form-control control-form"
                                                placeholder="Enter title version" id="Previewtitle_version">
                                            <span class="text-danger">
                                                <strong>{{ message.title_version }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-md-12 border-bottom mb-2">
                                            <h5 class="">Artist</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label mr-4">Artist  
                                            <span class="control-label ml-2">Is this a compilation of various artists? </span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="&quot;Compilation&quot; does NOT mean tracks from different albums by the SAME artist; it means a release with tracks by DIFFERENT artists."><i class="ti-help-alt"></i></a> </label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input  v-model="is_various_artist" class="form-check-input " type="radio" id="PreviewinlineRadio1" value="1" >
                                                    <label class="form-check-label" for="PreviewinlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input  v-model="is_various_artist"  class="form-check-input Called_tooltips" type="radio" id="PreviewinlineRadio2" value="0">
                                                    <label class="form-check-label" for="PreviewinlineRadio2" >No</label>
                                                </div>
                                                <span class="text-danger">
                                                    <strong>{{ message.is_various_artist }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 align-items-center d-flex justify-content-between" v-if="is_various_artist == 0">
                                            <label class="control-label text-dark"><b>Artist(s) – Indicate ONLY ONE per field </b> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do NOT indicate more than 1 artist in this field, even if it is a featured artist. Add other artists below and the service/store will add them to the artist field when it's appropriate."><i class="ti-help-alt"></i></a></label>
                                            <a type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addartist"><i class="ti-plus" ></i> Create new artists</a>
                                        </div>
                                        <div class="col-md-12 mb-2" v-if="is_various_artist == 0">
                                            <select id="MainArtistId" v-model="asset_artist_id" class="">
                                                <!-- <option :value="null" selected>Choose Artist</option> -->
                                                <!-- <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{ item.name }}</option> -->
                                            </select>
                                        </div>
                                        <div class="col-md-12" v-if="is_various_artist == 1">
                                            <input type="text" disabled  class="form-control control-form" placeholder="Various Artists">
                                            <div>You will indicate artists later when entering track info</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4" v-if="is_various_artist == 0">
                                    <div class="row">
                                        <div class="col-md-12 border-bottom mb-2">
                                            <h5 class="">Other key artists</h5>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label class="control-label">Select Other key artist (You Can select multiple other key artist) </label>
                                            <a role="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addOtherkeyartist"><i class="ti-plus"></i> Create new other key artists</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <select v-model="other_key_artist_list" class="" id="MultipleOtherKeyArtist" multiple >
                                                <!-- <option v-for='(item, index) in OtherkeyArtist' :key="index" :value='item.id'>{{ item.other_key_artist_name }}</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-md-12 border-bottom mb-2">
                                            <h5 class="">Info</h5>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">Primary Genre<span class="text-danger"> *</span></label>
                                            <select v-model="genre_one" class="" id="Selectgenre_one">
                                                <option :value="null">Select Primary Genre </option>
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.genre_one }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">Secondary Genre</label>
                                            <select v-model="genre_two" id="Selectgenre_two" class="">
                                                <option :value="null">Select Secondary  Genre </option>
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">(P) Copyright <span class="text-danger"> *</span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Product Copyright Holder: the name of the person or entity that owns the exclusive rights to the complete product, including both sound recording and artwork, preceded by the year the rights were obtained. For example: 2008 Acme Inc."><i class="ti-help-alt"></i></a></label>
                                            <input  v-model="p_copy"  type="text" id="Previewp_copy" class="form-control control-form" placeholder="2008 M" >
                                            <span class="text-danger">
                                                <strong>{{ message.p_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label"> (C) Copyright <span class="text-danger"> *</span>
                                                <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Sound Recording Copyright Holder: the name of the person or entity that owns the exclusive rights to the sound recording, preceded by the year the rights were obtained. For example: 2008 Acme Inc."><i class="ti-help-alt"></i></a></label>
                                            <input v-model="c_copy"  type="text" id="Previewc_copy" class="form-control control-form"
                                                placeholder="2008 A" >
                                            <span class="text-danger">
                                                <strong>{{ message.c_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Previously released?<span class="text-danger"> *</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label></label>
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="previously_release" class="form-check-input" type="radio"  id="releasedinlineRadio1" v-on:click="ShowReleseDateText= true" value="1">
                                                        <label class="form-check-label" for="releasedinlineRadio1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input v-model="previously_release" class="form-check-input" type="radio"  id="releasedinlineRadio2" v-on:click="ShowReleseDateText= false;" value="0">
                                                        <label class="form-check-label" for="releasedinlineRadio2">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" v-if="previously_release==1">
                                                    <span class="control-label">Previous release date  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Official release date from BEFORE this distribution"><i class="ti-help-alt"></i></a></span>
                                                    <div  id="prelesr">
                                                        <input v-model="release_date" type="date" id="releasedrelease_date" class="form-control control-form" >
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger">
                                                <strong>{{ message.previously_release }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">Label name <span class="text-danger"> *</span></label>
                                            <select v-model="label_id" class="custom-select form-control" id="Labelnameid">
                                                <option :value="null">Select Label</option>
                                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.label_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Catelog release ID<span class="text-danger"> *</span></label>
                                            <input v-model="internal_release_id"  readonly  type="text" id="internal_release_id" class="form-control"
                                                >
                                            <span class="text-danger">
                                                <strong>{{ message.internal_release_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Do you already have a UPC/EAN/JAN?  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="A UPC/EAN/JAN is a unique code that every release must have. If you don't already have one, we will generate one for you (free)."><i class="ti-help-alt"></i></a></label>
                                            <div class="">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Called_tooltips" type="radio" v-model="upcShowHide" id="inlineRadio2" value="1">
                                                    <label class="form-check-label" for="inlineRadio2">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" v-model="upcShowHide" id="inlineRadio3" value="0">
                                                    <label class="form-check-label" for="inlineRadio3">No</label>
                                                </div>
                                                <div class="mt-1" v-if="upcShowHide==0">OK, we'll generate one for you when we send your release.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="upcShowHide==1">
                                            <label class="control-label">UPC/EAN/JAN <a type="button" class="text-info ml-2" data-toggle="tooltip" title="A UPC/EAN/JAN is a unique code that every release must have. If you don't already have one, we will generate one for you (free)."><i class="ti-help-alt"></i></a></label>
                                            <input v-model="upc_ean_jan" type="number" class="form-control control-form"  placeholder="xxxxxxxxx" id="Previewupc_ean_jan" v-on:keyup="keyUPCEANJAN($event)">
                                            <span class="text-danger" id="ShowUPCValidation" v-if="ShowUPCValidation"> UPC number should be 7-8 or 11-14 character </span>
                                            <span class="text-danger">
                                                <strong>{{ message.upc_ean_jan }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <!-- :disabled="ShowFirstValidation" -->
                                        <!-- <button type="button" v-on:click="ValidateForm();" class="btn btn-danger mr-2 buttonStyle">Validate</button> -->
                                        <button  type="button" name="next" class="next btn btn-info buttonStyle" v-on:click="ValidateForm();">Next Step</button>
                                    </div>
                                </div>
                            </fieldset>
<!-- Step Form 2nd part  -->
                            <fieldset>
                                <div class="row card" v-for="(track, index) in tracks" :key="index">
                                    <div class="col-12 p-0 d-flex align-items-center justify-content-between border-bottom">
                                        <a class="btn btn-link d-flex align-items-center" data-toggle="collapse" :href="'#collapseExample'+index" role="button" aria-expanded="false" :aria-controls="'collapseExample'+ index">
                                            <div><i class="ti-arrow-circle-down mr-3"></i></div>
                                            <h5> Track {{index+1}}</h5>
                                        </a>
                                        <div class="">
                                            <a href="#" class="text-danger" v-on:click="removeE(index)"> <b> <i class="ti-close font-weight-bold"></i></b></a>
                                        </div>
                                    </div>
                                    <div class="collapse row px-3" :id="'collapseExample'+index">
                                        <div class="col-md-12">
                                            <label class="control-label">Audio file </label>
                                            <div class="justify-content-between d-flex">
                                                <img src="/admin-asset/images/upload.png" id="clickimageforupload" v-on:click="UploadAudio()" style="height:50px">
                                                <input  type="file" v-on:change="previewFile()" accept="audio/*" ref="audioRef"  class="custom-file-label" id="inputGroupFi" name="audio[]" style="display: none" multiple>
                                                <div>
                                                    <audio controls :src="PreviewAudio[index]"></audio>
                                                    <div id="resultImage"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Language of Lyrics <span class="text-danger">*</span><span class="ml-3" style="font-size: 10px;">Select Instrumental if track has no lyrics</span></label>
                                            <select  v-model="track.language_t" name="language_t" :id="'SelectTrackLanguage'+index" class="custom-select form-control">
                                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Track title <span class="text-danger"> * </span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do not include additional information like &quot;Remix&quot; or &quot;Uncut&quot;. Use Title Version below.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <input  v-model="track.track_title_version" type="text"  class="form-control control-form" placeholder="Enter the track title">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Title version</label>
                                            <input type="text" v-model="track.title_version" class="form-control control-form" placeholder="Enter the title version">
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label class="control-label">Artist (Indicate ONLY ONE in this field) <span class="text-danger"> *</span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do NOT indicate more than 1 artist in this field, even if it is a featured artist. Add other artists below and the service/store will add them to the artist field when it's appropriate.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <a type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addartist"><i class="ti-plus" ></i> Create new artists</a>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select v-model="track.track_artist_id" :id="'ArtistSelectOption'+index"  class="form-control" >
                                                <option v-for='(item, indx) in AllArtist' :key="indx" :value='item.id'>{{item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="mb-0">Other key artists</h5>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label class="control-label">Other key artist (You Can select multiple other key artist) </label>
                                            <a role="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addOtherkeyartist"><i class="ti-plus"></i> Create new other key artists</a>
                                        </div>
                                        <div class="col-12">
                                            <select v-model="track.other_key_artist_list_track" class="form-control" style="height: 100px !important;" multiple>
                                                <option v-for='(item, index) in otherkeyartist' :key="index" :value='item.id'>{{ item.other_key_artist_name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Do you have ISRC code? <span class="text-danger">*</span> 
                                                <a type="button" class="text-info ml-2" data-toggle="tooltip" title="An ISRC is a unique code that every track must have. If you don't already have one, we will generate one for you (free). Note: an ISRC is unique to each song; you should never create a new ISRC for a song that already has an ISRC.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.has_isrc"  class="form-check-input" :id="index+432" type="radio" value="1">
                                                    <label class="form-check-label" :for="index+432">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.has_isrc"  class="form-check-input"  :id="index+12" type="radio" value="0">
                                                    <label class="form-check-label" :for="index+12">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="track.has_isrc == 1">
                                            <div id="handleClickISRC" >
                                                <label class="control-label"> ISRC</label>
                                                <input v-model="track.isrc_code" type="text"  class="form-control control-form"  maxlength="12" pattern="\d{12}" placeholder="ISRC">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Explicit lyrics? <span class="text-danger">*</span>
                                                <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Click 'yes' if your song contains one or more of the following:
                                                anything unsuitable for children
                                                strong language
                                                references to violence or abuse
                                                sexual content
                                                anything that might be regarded as racist, homophobic, discriminatory, or misogynistic
                                                anything that encourages or celebrates criminal behavior
                                            </ul>">
                                            <i class="ti-help-alt"></i></a>
                                            </label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.explicit_lyrics"  class="form-check-input" type="radio" :id="index+865" value="1">
                                                    <label class="form-check-label" :for="index+865">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.explicit_lyrics"  class="form-check-input" type="radio" :id="index+2342" value="0">
                                                    <label class="form-check-label" :for="index+2342">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">The track is: <span class="text-danger">*</span> </label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.original_public"  class="form-check-input" type="radio"  v-on:click="trackIsfirst = true; trackIssecond = false;" value="1" :id="index+track">
                                                    <label class="form-check-label" :for="index+track">An original song (publishing info will be )</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input v-model="track.original_public"  class="form-check-input" type="radio"  v-on:click="trackIssecond = true; trackIsfirst = false;" value="0" :id="index+track">
                                                    <label class="form-check-label" :for="index+track">A public domain song (publishing info will be )</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="trackIssecond" v-if="track.original_public == 0"
                                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                                <p>
                                                    Public​ ​domain​ ​compositions​ ​are​ ​ones​ ​in​ ​which​ ​the
                                                    intellectual​ ​property​ ​rights​ ​have​ ​expired​ ​or​ ​been​ ​forfeited.
                                                    This​ ​generally​ ​applies​ ​to​ ​songs​ ​written​ ​before​ ​1923.
                                                </p>
                                            </div>
                                            <div id="trackIsfirst" v-if="track.original_public == 1"
                                                style=" font-size: 10px; margin-bottom: 20px; background-color: #fcf8e3;">
                                                <p>
                                                    An​ ​original​ ​composition​ ​is​ ​a​ ​track​ ​to​ ​which​ ​you’ve​ ​contributed
                                                    lyrics​ ​and/or​ ​music,​ ​but​ ​which​ ​does​ ​NOT​ ​borrow​ ​elements
                                                    from​ ​previously​ ​created​ ​works.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="control-label" data-toggle="collapse" :data-target="'#collapseAdvance'+index" aria-expanded="false" :aria-controls="'collapseAdvance'+index"><i class="ti-arrow-circle-down mr-1"></i> Advance info (optional)</h5>
                                        </div>
                                        <div class="col-12 collapse" :id="'collapseAdvance'+index">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Primary Genre <span class="text-danger"> *</span>
                                                        <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Genres are limited to those that iTunes accepts.">
                                                        <i class="ti-help-alt"></i></a>
                                                    </label>
                                                    <select v-model="track.genre_one_track"  id="" class="custom-select form-control">
                                                        <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Secondary Genre</label>
                                                    <select v-model="track.genre_two_track"  id=""
                                                        class="custom-select form-control">
                                                        <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">(P) Copyright <span class="text-danger">*</span>
                                                    <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Publishing Copyright Holder: Insert the 4-digit year and name of the individual or entity that holds the rights to the publishing. Ex: 1985 Jon Smith Records.">
                                                        <i class="ti-help-alt"></i></a>
                                                </label>
                                                    <input v-model="track.p_copy_t"  type="text"  class="form-control control-form"
                                                        placeholder="2008 M" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">(C) Copyright <span class="text-danger">*</span>
                                                    <a type="button" class="text-info ml-2" data-toggle="tooltip" title="When should your track start when people preview it? The number must be given in seconds. Example: 93.">
                                                        <i class="ti-help-alt"></i></a>
                                                </label>
                                                    <input v-model="track.c_copy_t"  type="text" class="form-control control-form"
                                                        placeholder="2008 A" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Label name <span class="text-danger">*</span></label>
                                                    <select v-model="track.track_label_id" disabled  name="track_label_id" id="" class="custom-select form-control">
                                                        <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Catelog track ID<span class="text-danger">*</span>
                                                        <a type="button" class="text-info ml-2" data-toggle="tooltip" title="2 characters minimum, with only letters & numbers. Best to leave blank unless you really use these.">
                                                        <i class="ti-help-alt"></i></a>
                                                    </label>
                                                        <input  v-model="track.internal_track_id"  readonly type="text" id="internal_track_id"  name="internal_track_id" class="form-control control-form internal_track_id" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <h5 class="control-label" data-toggle="collapse" :data-target="'#collapseLyrics'+index" aria-expanded="false" :aria-controls="'collapseLyrics'+index"><i class="ti-arrow-circle-down mr-1"></i> Lyrics (Optional)</h5>
                                            </div>
                                            <div class="collapse" :id="'collapseLyrics'+index">
                                                <textarea class="form-control control-form"
                                                placeholder="Any order note about delivery or special offer" style="height: 108px" v-model="track.lyrics"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-12 text-right">
                                        <a class="btn btn-lg btn-block btn-primary text-white rounded-0"  v-on:click="AddNewTrackDetails()"> <i class="ti-plus"></i> Upload a new track</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <!-- :disabled="ShowThirdValidation" -->
                                        <!-- <button type="button" name="previous" class="btn btn-danger buttonStyle" v-on:click="ValidateFormSEC()"> Validate</button> -->
                                        <button type="button" name="previous" class="previous btn btn-secondary buttonStyle" v-on:click="ValidateFormSEC()"> Previous</button>
                                        <button type="button" name="previous" class="next btn btn-info buttonStyle"  v-on:click="ValidateFormSEC()"> Next Step</button>
                                    </div>
                                </div>
                            </fieldset>
<!-- Step Form  3rd part  -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card" v-for="(pub, ind) in Publishing" :key="ind">
                                            <div class="row">
                                                <div class="col-12 text-right">
                                                    <a href="#" class="text-danger" v-on:click="removePublishing(index)"> <b> <i class="ti-close font-weight-bold"></i></b></a>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Contributor name<span class="text-danger">*</span></label>
                                                    <select name="contritibutor_track_artist_name" v-model="pub.contritibutor_track_artist_name"
                                                        class="custom-select form-control" :id="'contritibutor_track_artist_nameId'+ind">
                                                        <option v-for='(item, index) in artists' :key="index" :value='item.id'>{{item.name }}</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <strong>{{ message.contritibutor_track_artist_name }}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Role <span class="text-danger">*</span></label>
                                                    <select  v-model="pub.contritibutor_role" name="contritibutor_role" :id="'contritibutor_role'+ind" class="custom-select form-control">
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
                                                <div class="col-md-4">
                                                    <label class="control-label">Share <span class="text-danger">*</span></label>
                                                    <input  type="number" id="Previewcontritibutor_share" v-model="pub.contritibutor_share" name="contritibutor_share" class="form-control control-form" placeholder="001">
                                                    <span class="text-danger">
                                                        <strong>{{ message.contritibutor_share }}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Publishing<span class="text-danger"> *</span></label>
                                                    <select v-model="pub.contritibutor_publishing"  name="contritibutor_publishing" :id="'contritibutor_publishing'+ind" class="custom-select form-control">
                                                        <option value="">select publishing</option>
                                                        <option value="Copyright control (self-published)">Copyright control (self-published)</option>
                                                        <option value="Public domain (no publisher)">Public domain (no publisher)</option>
                                                        <option value="Published (managed by a publisher)">Published (managed by a publisher)</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <strong>{{ message.contritibutor_publishing }}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <label class="control-label">Publisher Name <span class="text-danger">*</span></label>
                                                    <input  type="text" id="Previewcontritibutor_share" v-model="pub.publisher_name" name="contritibutor_share" class="form-control control-form" placeholder="Publisher name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button type="button" class="btn btn-lg btn-block rounded-0 btn-primary" v-on:click="AddPublishing()"> <i class="ti-plus"></i>Add more contributor</button>   
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="row card">
                                            <div class="col-12 p-0 border-bottom">
                                                <button type="button" class="control-label btn btn-link" data-toggle="collapse" data-target="#collapseStore" aria-expanded="false" aria-controls="collapseStore"> <i class="ti-arrow-circle-down mr-1" ></i> Select Stores</button>
                                            </div>
                                            <div class="row p-2 collapse" id="collapseStore">
                                                <div class="col-12 mb-3">
                                                    <div class="ml-2 form-check form-check-inline">
                                                        <input type="checkbox" id="inlineCheckbox1" class="form-check-input" v-model="AllChecked" v-on:click="CheckedAllStore()">
                                                        <label class="form-check-label font-weight-bold" for="inlineCheckbox1">All</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-3" v-for="(stor , kk) in stores" :key="kk">
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-8 col-form-label">
                                                                    <span> 
                                                                        <img v-if="stor.cover_image != null" style="height: 40px" :src="'/storage/store/'+stor.cover_image" alt="No Image">
                                                                        <img v-else style="height: 40px;" src="/noimg.png" alt="">
                                                                    </span>
                                                                    {{stor.label_name }}
                                                                </label>
                                                                <div class="col-sm-4">
                                                                <input type="checkbox" class="form-control-plaintext" id="staticEmail" v-model="CheckStore" :value="stor.id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <!-- <button type="button" name="next" class="btn btn-danger buttonStyle" v-on:click="ValidateFormIII()"> Validate </button> -->
                                        <button type="button" name="previous" class="previous btn btn-secondary buttonStyle" v-on:click="ValidateFormIII()"> Previous </button>
                                        <button type="button" name="previous" class="next btn btn-info buttonStyle" v-on:click="ValidateFormIII()"> Next Step</button>
                                    </div>
                                </div>
                                <!-- <button :disabled="ShowSecondValidation" type="button" name="next" class="btn btn-success" v-on:click="SubmitReleseDetails()"> Confirm</button> -->
                            </fieldset>
<!-- Step Form  4th part  -->
                            <fieldset>
                                <div class="card">
                                    <div class="row ">
                                        <div class="col-4">
                                            <div class="d-flex justify-content-between">
                                                    <div class="text-center" v-if="PreviewImage">
                                                        <img :src="PreviewImage" alt="your image" style="height: 150px;" />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-8">
                                            <div>
                                                <h6 class="headingsongs">{{ release_title }}</h6>
                                            </div>
                                            <div>
                                                <h6 v-for='(item, index) in artists' :key="index">
                                                    <span v-if="item.id == asset_artist_id">by {{ item.name }}</span>
                                                </h6>
                                            </div>
                                            <div>
                                                <span>Genre(s): {{genre_one}}</span> <br/>
                                                <small>(P) {{ p_copy}}</small> <br/>
                                                <small>(C) {{ c_copy }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row" v-for="(track, index) in tracks" :key="index">
                                        <div class="card col-4 justify-content-center">
                                            <a class="btn btn-link " data-toggle="collapse" :href="'#collapseExample'+index" role="button" aria-expanded="false" :aria-controls="'collapseExample'+ index">
                                                <h5> Track {{index+1}}</h5>
                                            </a>
                                        </div>
                                        <div class="col-8 card">
                                            <div>
                                                <h6 class="headingsongs mb-0">{{ track.track_title_version}}</h6> <br/>
                                                <h6 v-for='(item, index) in artists' :key="index">
                                                       <span v-if="item.id == track.track_artist_id">by {{ item.name }}</span>
                                                </h6>
                                                <span>Genre(s): {{track.genre_one_track}}</span> <br/>
                                                <small>(P) {{ track.p_copy_t}}</small> <br/>
                                                <small>Explicit lyrics: <span v-if="track.explicit_lyrics == 1">YES</span> <span v-else>NO</span> </small><br/>
                                                <!-- <small>Writer(s): {{ track.p_copy_t}}</small> <br/> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <!-- v-on:click="ValidateFormIII()" -->
                                        <!-- :disabled="ShowSecondValidation" -->
                                        <button type="button" name="previous" class="previous btn btn-secondary buttonStyle"> Previous </button>
                                        <button  type="button" name="next" class="btn btn-success buttonStyle" v-on:click="SubmitReleseDetails()"> Confirm</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Create artist -->
    <div class="modal fade" data-backdrop="static" id="addartist" tabindex="-1" role="dialog" aria-labelledby="addartistTitle" aria-hidden="true">
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
                                    <label> <b>Email</b></label>
                                    <input type="email" class="form-control" v-model="Modalemail" placeholder="abc@mail.com" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label> <b> Attach the banner image here </b></label>
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
                                        maxlength="22" >
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
                                        title="" >
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

<!-- Modal other key Create artist -->
<div class="modal fade" data-backdrop="static" id="addOtherkeyartist" tabindex="-1" role="dialog" aria-labelledby="addartistTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addartistTitle">Create Other Key Artist</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body row">
                <div class="col-6 mb-2">
                    <label class="control-label">Other key artist name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control control-form" v-model="other_key_artist_Name">
                </div>
                <div class="col-6">
                    <label class="control-label">Role <span class="text-danger">*</span></label>
                    <select v-model="OtherKeyArtistRole" class="form-select form-control" id="OtherKeyRole">
                        <option v-for='(item, index) in roles' :key="index" :value='item.id'>{{ item.roles }}</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="control-label">Artist already on Spotify? </label>
                    <div class="row d-flex align-items-center">
                        <div class="col-6">
                            <div class="form-check form-check-inline">
                                <input v-model="otherkey_spotify_id"  class="form-check-input has_spotify_asset" type="radio" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input  v-model="otherkey_spotify_id"  class="form-check-input" type="radio" id="inlineRadio2rr" v-on:click="spotify_id_name=null" value="0">
                                <label class="form-check-label" for="inlineRadio2rr">No</label>
                            </div>
                        </div>
                        <div class="col-md-6" v-if="otherkey_spotify_id == 1">
                            <input v-model="spotify_id_name" type="text" class="form-control control-form"  placeholder="Enter spotify ID" id="spotify_id_ass">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="control-label">Artist already on Apple Music?></label>
                    <div class="row d-flex align-items-center">
                        <div class="col-6">
                            <div class="form-check form-check-inline">
                                <input v-model="otherkey_applemusic_id"  class="form-check-input has_applemusic_asset" type="radio" id="inlineRadio1" name="has_applemusic_asset" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input v-model="otherkey_applemusic_id"  class="form-check-input" type="radio" id="inlineRadio2"  v-on:click="apple_id_name=null" name="has_applemusic_asset" value="0">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>
                        <div class="col-md-6" v-if="otherkey_applemusic_id == 1">
                            <input v-model="apple_id_name" type="text" class="form-control control-form" name="apple_id_ass" placeholder="Enter apple ID" id="apple_id_ass">
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-primary mr-3" v-on:click="SubmitOtherKeyArtist()">Add Other Key Artist</button>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger ">Cancel</button>
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
    props:['otherkeyartist','roles','artists','labels','stores', 'alllanguage', 'genre1'],
    data() {
        return {
            ShowFirstValidation:true,
            ShowSecondValidation:true,
            ShowThirdValidation:true,

            AllChecked:false,
            AllArtist:[],
            AddClass:'',
            PreviewImage:'',
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
                genre_one:'',
                p_copy:'',
                c_copy:'',
                previously_release:'',
                label_id:'',
                internal_release_id:'',
                upc_ean_jan:'',
            },

            cover_image:'',
            language:'English',
            release_title:'',
            title_version:'',
            is_various_artist:0,
            asset_artist_id:"",
            genre_one:'',
            genre_two:'',
            p_copy:'',
            c_copy:'',
            previously_release:0,
            release_date:'',
            label_id:'',
            internal_release_id:'',
            upcShowHide:0,
            upc_ean_jan:'',

            PreviewAudio:[],
            audio:[],

            tracks:[],
            Publishing:[],
            CheckStore:[],

            Modalimage:'',
            ModalPreview:'',
            Modalname:'',
            Modalemail:'',
            Modalbiography:'',
            Modalspotify_id:'',
            Modalapple_id:'',

            // OtherKeyDetails:[],

            other_key_artist_list:"",
            // OtherKeyArtistName:'',
            other_key_artist_Name:"",
            OtherKeyArtistRole:'',
            otherkey_spotify_id:'',
            spotify_id_name:'',
            otherkey_applemusic_id:'',
            apple_id_name:'',
            OtherkeyArtist:[],
            setartistid:'',
        }
    },
    watch: {
        previously_release(){
            if(this.previously_release ==1){
                this.upcShowHide = 1
            }else{
                this.upcShowHide = 0
            }
            
        }
    },
    mounted() {
        this.GetCatelogreleaseID();
        this.GetALLArtistList();
        this.GetOtherKeyArtistList();

        new SlimSelect({
            select: '#Selectgenre_one'
        });
        new SlimSelect({
            select: '#Selectgenre_two'
        });
        new SlimSelect({
            select: '#SingleSelect'
        });
        
        new SlimSelect({
            select: '#MultipleOtherKeyArtist',
            events: {
                search: (search, currentData) => {
                    return new Promise((resolve, reject) => {
                        if (search.length < 2) {
                        return reject('Search must be at least 2 characters')
                        }
                        axios.get('/get-other-key-artist')
                        .then((response) => {
                            const options = response.data
                            .filter((person) => {
                                return person.other_key_artist_name.toLowerCase().includes(search.toLowerCase())
                            })
                            .map((person) => {
                                return {
                                text: person.other_key_artist_name,
                                value: person.id
                                }
                            })
                            resolve(options)
                        })
                    })
                }
                // end

            }
        });

        new SlimSelect({
            select: '#MainArtistId',
            events: {
                // addable: function (value) {
                //     var formData = new FormData();
                //     formData.append('name', value);
                //     axios.post('/add-user-Artists',formData)
                //     .then((Response)=>{
                //     });
                //     return value;
                // },
                search: (search, currentData) => {
                    return new Promise((resolve, reject) => {
                        if (search.length < 2) {
                        return reject('Search must be at least 2 characters')
                        }
                        axios.get('/artists-list')
                        .then((response) => {
                            const options = response.data
                            .filter((person) => {
                                return person.name.toLowerCase().includes(search.toLowerCase())
                            })
                            .map((person) => {
                                return {
                                text: person.name,
                                value: person.id
                                }
                            })
                            resolve(options)
                        })
                    })
                }
                // end

            }
        });

        new SlimSelect({
            select: '#OtherKeyRole'
        });
        new SlimSelect({
            select: '#Labelnameid'
        });
    },
    methods: {
        SubmitOtherKeyArtist(){
            if(this.other_key_artist_Name && this.OtherKeyArtistRole){
                var formData = new FormData();
                formData.append('other_key_artist_Name', this.other_key_artist_Name);
                formData.append('OtherKeyArtistRole', this.OtherKeyArtistRole);
                formData.append('otherkey_spotify_id', this.otherkey_spotify_id);
                formData.append('spotify_id_name', this.spotify_id_name);
                formData.append('otherkey_applemusic_id', this.otherkey_applemusic_id);
                formData.append('apple_id_name', this.apple_id_name);
                axios.post('/store-other-key-artist',formData)
                    .then((res)=>{
                        this.other_key_artist_Name=''
                        this.OtherKeyArtistRole=''
                        this.otherkey_spotify_id=''
                        this.spotify_id_name=''
                        this.otherkey_applemusic_id=''
                        this.apple_id_name=''
                        Notify.success('Added Successfully')
                        this.GetOtherKeyArtistList();
                    },()=>{
                        Notify.failure("Error “Please fill out all  fields.”");
                    })
            }else{
                Notify.failure('Please fill the all mendetroy fields');
            }
        },
        SubmitReleseDetails(){
            Confirm.show('Review Confirmation','Do you want to submit for Review ?','Yes','No',
            () => {
                if(this.cover_image  &&  this.language  && this.release_title &&  this.is_various_artist !=null &&  this.genre_one && this.p_copy && this.c_copy && this.label_id && this.previously_release != null)
                {
                    var formData = new FormData();
                    formData.append('cover_image', this.cover_image);
                    formData.append('language', this.language);
                    formData.append('release_title', this.release_title);
                    formData.append('title_version', this.title_version);
                    formData.append('is_various_artist', this.is_various_artist);
                    formData.append('asset_artist_id', this.asset_artist_id);
                    formData.append('genre_one', this.genre_one);
                    formData.append('genre_two', this.genre_two);
                    formData.append('p_copy', this.p_copy);
                    formData.append('c_copy', this.c_copy);
                    formData.append('previously_release', this.previously_release);
                    formData.append('release_date', this.release_date);
                    formData.append('label_id', this.label_id);
                    formData.append('internal_release_id', this.internal_release_id);
                    formData.append('upc_ean_jan', this.upc_ean_jan);
                    formData.append('other_key_artist_list', this.other_key_artist_list);

                    this.audio.forEach((file,index) =>{
                        formData.append('audio['+index+']', file);
                    });
                    formData.append('tracks', JSON.stringify(this.tracks));
                    formData.append('Publishing', JSON.stringify(this.Publishing));
                    axios.post('/asset',formData,{
                    headers: { 'Content-Type': 'multipart/form-data'}, } )
                    .then((res)=>{
                    this.ClearData();
                    window.location.href = '/asset'
                    Report.success('Review','You have fill up the form sucessfully. Submit it for approval','Okay');
                    },()=>{
                        Notify.failure("Error “Please fill out all  fields.”");
                    })
                }else{
                    Notify.failure('Please fill the all mendetroy fields');
                }
            },
            () => {
            })
        },
        AddNewTrackDetails(){
            if (this.tracks.length < 6){
                this.tracks.push({language_t:this.language, track_title_version:this.release_title,title_version:this.title_version, track_artist_id:this.asset_artist_id, has_isrc:'', isrc_code:'',explicit_lyrics:'',original_public:"",genre_one_track:this.genre_one,genre_two_track:this.genre_two,p_copy_t:this.p_copy,c_copy_t:this.c_copy,track_label_id:this.label_id,internal_track_id:'',lyrics:'', other_key_artist_list_track :JSON.stringify()});
    
                this.tracks.forEach((value, index) => {
                    value.internal_track_id = this.internal_release_id;
                    value.has_isrc = this.previously_release;
                });
            }else{
                Notify.failure("You can add only 6 tracks");
            }
            setTimeout(
                function() {
                    $('[data-toggle="tooltip"]').tooltip()
                }, 3000);
        },
        removeE(index){
            this.tracks.splice(index, 1)
        },
        AddPublishing(){
            this.Publishing.push({contritibutor_track_artist_name:this.asset_artist_id, contritibutor_role:'',
            contritibutor_share:'', contritibutor_publishing:'', publisher_name:''});
        },
        removePublishing(index){
            this.Publishing.splice(index, 1)
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
            if(current_val.length == 7 || current_val.length == 8 || current_val.length == 11 || current_val.length == 12 ||current_val.length == 13 ||current_val.length == 14)
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
        ValidateForm(){
            if(this.cover_image  &&  this.language  && this.release_title &&  this.is_various_artist !=null &&  this.genre_one && this.p_copy && this.c_copy && this.label_id && this.previously_release != null)
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
                this.cover_image ==""  ? this.message.cover_image = "Image field is " :  this.message.cover_image = "";
                this.language ==""  ? this.message.language = "Language field is " : this.message.language = "";
                this.release_title =="" ? this.message.release_title = "Release title field is " : this.message.release_title ="";
                this.is_various_artist == null? this.message.is_various_artist = "Artist field is " : this.message.is_various_artist =  "";
                this.genre_one ==""?this.message.genre_one = "Genre one field is " : this.message.genre_one =  "";
                this.p_copy ==""?this.message.p_copy = "P copy field is " : this.message.p_copy =  "";
                this.previously_release =="" ? this.message.previously_release = "Previously release field is " : this.message.previously_release =  "";
                this.label_id ==""?this.message.label_id = "Label Id field is " : this.message.label_id =  "";
                Notify.failure('Please fill the all mendetroy fields');
            }
        },
        ValidateFormIII(){
            this.Publishing.forEach((value, index) => {
                if(value.contritibutor_track_artist_name && value.contritibutor_role && value.contritibutor_share && value.contritibutor_publishing){
                    this.ShowThirdValidation = false;
                    Notify.success('Validate');
                }else{
                    this.ShowThirdValidation = true;
                    Notify.failure('Please fill the all mendetroy fields');
                }
            });
        },
        ValidateFormSEC(){
            this.tracks.forEach((value, index) => {
                if(value.language_t && value.track_title_version &&value.track_artist_id && value.has_isrc != null && value.explicit_lyrics!= null && value.original_public!= null && value.genre_one_track && value.p_copy_t && value.c_copy_t && value.track_label_id){
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
            if(this.Modalname)
            {
                var formData = new FormData();
                formData.append('name', this.Modalname);
                formData.append('email', this.Modalemail);
                formData.append('biography', this.Modalbiography);
                formData.append('image', this.Modalimage);
                formData.append('spotify_id', this.Modalspotify_id);
                formData.append('apple_id', this.Modalapple_id);
                axios.post('/userArtists',formData,
            { headers: { 'Content-Type': 'multipart/form-data' }}
            )
            .then((Response)=>{
                this.Modalname ='';
                this.Modalemail = '';
                this.Modalbiography = '';
                // this.$refs.ModaleRef.value = null;
                this.Modalspotify_id ='';
                this.Modalapple_id ='';
                Notify.success('Added Successfully');
                this.GetALLArtistList();
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
        GetALLArtistList(){
            axios.get('/artists-list')
            .then((Response)=>{
                this.AllArtist = Response.data;
                // console.log(this.AllArtist);
            },()=>{
                Notify.failure("Please contact with authorized person.");
            });
        },
        GetOtherKeyArtistList(){
            axios.get('/get-other-key-artist')
            .then((Response)=>{
                this.OtherkeyArtist = Response.data;
            },()=>{
                Notify.failure("Please contact with authorized person.");
            });
        },
    }
}
</script>