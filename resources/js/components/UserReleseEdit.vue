<template>
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        <div class="d-flex align-items-center">
            <a href="/asset"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="ml-4 ">
            <h3 style="font-size: 400">Edit release</h3>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        {{ alldetails }}
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar" class="text-center">
                                <li class="active" id="account"><strong>MAIN INFO</strong></li>
                                <li id="personal"><strong>TRACK</strong></li>
                                <li id="payment"><strong>PUBLISHING & STORE</strong></li>
                                <li id="confirm"><strong>REVIEW</strong></li>
                            </ul>
<!-- fieldsets  1st part-->
                            <fieldset>
                                <div class="card mb-4">
                                    <div class="row mb-2">
                                        <div class="col-12 border-bottom mb-2">
                                            <h5 class=""> COVER IMAGE {{showstatus}} {{disableAllfield}}</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="">
                                                <div v-if="!PreviewImage">
                                                    <img src="/admin-asset/images/photo.png" alt="No image" style="height:150px" v-on:click="UploadImage('clickimageforupload')">
                                                    <input  :disabled='disableAllfield' type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
                                                </div>
                                                <div class="text-center" v-if="PreviewImage">
                                                    <img :src="PreviewImage" alt="your image" style="height:200px;" />
                                                    <span class="ml-2 text-warning"> <i class="ti-pencil font-weight-bold" v-on:click="UploadImage('clickimageforupload')"></i> 
                                                        <input  :disabled='disableAllfield' type="file" class="custom-file-input"  accept="image/*" ref="ImageRef" id="clickimageforupload" style="display: none" v-on:change="onFileChange()">
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
                                            <select :disabled='disableAllfield' v-model="language" class="" id="SingleSelect">
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
                                            <input :disabled='disableAllfield' v-model="release_title" type="text"  id="Previewrelease_title" class="form-control control-form" placeholder="Enter Name of release">
                                            <span class="text-danger">
                                                <strong>{{ message.release_title }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label"> Title version <a type="button" class="text-info ml-2" data-toggle="tooltip" title="This is typically left blank, unless it's a new version of a previously-released album.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <input :disabled='disableAllfield' type="text" v-model="title_version" class="form-control control-form"
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
                                                    <input :disabled='disableAllfield'  v-model="is_various_artist" class="form-check-input " type="radio" id="PreviewinlineRadio1" value="1" >
                                                    <label class="form-check-label" for="PreviewinlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield'  v-model="is_various_artist"  class="form-check-input Called_tooltips" type="radio" id="PreviewinlineRadio2" value="0">
                                                    <label class="form-check-label" for="PreviewinlineRadio2" >No</label>
                                                </div>
                                                <span class="text-danger">
                                                    <strong>{{ message.is_various_artist }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 align-items-center d-flex justify-content-between" v-if="is_various_artist == 0">
                                            <label class="control-label text-dark"><b>Artist(s) – Indicate ONLY ONE per field </b> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do NOT indicate more than 1 artist in this field, even if it is a featured artist. Add other artists below and the service/store will add them to the artist field when it's appropriate."><i class="ti-help-alt"></i></a></label>
                                            <!-- <a type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addartist"><i class="ti-plus" ></i> Create new artists</a> -->
                                        </div>
                                        <div class="col-md-12 mb-2" v-if="is_various_artist == 0">
                                            <select :disabled='disableAllfield' id="MainArtistId" v-model="asset_artist_id" class="">
                                                <option v-for='(item, index) in AllArtist' :key="index" :value='item.id'>{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12" v-if="is_various_artist == 1">
                                            <input :disabled='disableAllfield' type="text" class="form-control control-form" placeholder="Various Artists">
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
                                            <!-- <a role="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addOtherkeyartist"><i class="ti-plus"></i> Create new other key artists</a> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <!--  -->
                                            <select :disabled='disableAllfield' id="MultipleOtherKeyArtist" v-model="other_key_artist_list" class="form-control"  multiple>
                                                <option v-for='(item, index) in otherkeyartist' :key="index" :value='item.id'>{{ item.other_key_artist_name }}</option>
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
                                            <select :disabled='disableAllfield' v-model="genre_one" class="" id="Selectgenre_one">
                                                <option :value="null">Select Primary Genre </option>
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.genre_one }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">Secondary Genre</label>
                                            <select :disabled='disableAllfield' v-model="genre_two" id="Selectgenre_two" class="">
                                                <option :value="null">Select Secondary  Genre </option>
                                                <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">(P) Copyright <span class="text-danger"> *</span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Product Copyright Holder: the name of the person or entity that owns the exclusive rights to the complete product, including both sound recording and artwork, preceded by the year the rights were obtained. For example: 2008 Acme Inc."><i class="ti-help-alt"></i></a></label>
                                            <input :disabled='disableAllfield' v-model="p_copy"  type="text" id="Previewp_copy" class="form-control control-form" placeholder="2008 M" >
                                            <span class="text-danger">
                                                <strong>{{ message.p_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label"> (C) Copyright <span class="text-danger"> *</span>
                                                <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Sound Recording Copyright Holder: the name of the person or entity that owns the exclusive rights to the sound recording, preceded by the year the rights were obtained. For example: 2008 Acme Inc."><i class="ti-help-alt"></i></a></label>
                                            <input :disabled='disableAllfield' v-model="c_copy"  type="text" id="Previewc_copy" class="form-control control-form"
                                                placeholder="2008 A" >
                                            <span class="text-danger">
                                                <strong>{{ message.c_copy }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Previously released?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label></label>
                                                    <div class="form-check form-check-inline">
                                                        <input :disabled='disableAllfield' v-model="previously_release" class="form-check-input" type="radio"  id="releasedinlineRadio1" v-on:click="ShowReleseDateText= true" value="1">
                                                        <label class="form-check-label" for="releasedinlineRadio1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input :disabled='disableAllfield' v-model="previously_release" class="form-check-input" type="radio"  id="releasedinlineRadio2" v-on:click="ShowReleseDateText= false;" value="0">
                                                        <label class="form-check-label" for="releasedinlineRadio2">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" v-if="previously_release==1">
                                                    <span class="control-label">Previous release date  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Official release date from BEFORE this distribution"><i class="ti-help-alt"></i></a></span>
                                                    <div  id="prelesr">
                                                        <input :disabled='disableAllfield' v-model="release_date" type="date" id="releasedrelease_date" class="form-control control-form" >
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger">
                                                <strong>{{ message.previously_release }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="control-label">Label name <span class="text-danger"> *</span></label>
                                            <select :disabled='disableAllfield' v-model="label_id" class="custom-select form-control" id="Labelnameid">
                                                <option :value="null">Select Label</option>
                                                <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                            </select>
                                            <span class="text-danger">
                                                <strong>{{ message.label_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Catelog release ID<span class="text-danger"> *</span></label>
                                            <input :disabled='disableAllfield' v-model="internal_release_id"  readonly  type="text" id="internal_release_id" class="form-control"
                                                >
                                            <span class="text-danger">
                                                <strong>{{ message.internal_release_id }}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Do you already have a UPC/EAN/JAN?  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="A UPC/EAN/JAN is a unique code that every release must have. If you don't already have one, we will generate one for you (free)."><i class="ti-help-alt"></i></a></label>
                                            <div class="">
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' class="form-check-input Called_tooltips" type="radio" v-model="upcShowHide" id="inlineRadio2" value="1" :checked="upc_ean_jan != null ">
                                                    <label class="form-check-label" for="inlineRadio2">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' class="form-check-input" type="radio" v-model="upcShowHide" :checked="upc_ean_jan == null " id="inlineRadio3" value="0">
                                                    <label class="form-check-label" for="inlineRadio3">No</label>
                                                </div>
                                                <div class="mt-1" v-if="upcShowHide==0">OK, we'll generate one for you when we send your release.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="upcShowHide==1 || upc_ean_jan != null">
                                            <label class="control-label">UPC/EAN/JAN <a type="button" class="text-info ml-2" data-toggle="tooltip" title="A UPC/EAN/JAN is a unique code that every release must have. If you don't already have one, we will generate one for you (free)."><i class="ti-help-alt"></i></a></label>
                                            <input :disabled='disableAllfield' v-model="upc_ean_jan" type="number" class="form-control control-form"  placeholder="xxxxxxxxx" id="Previewupc_ean_jan" v-on:keyup="keyUPCEANJAN($event)">
                                            <span class="text-danger" id="ShowUPCValidation" v-if="ShowUPCValidation"> UPC number should be 7-8 or 11-14 character </span>
                                            <span class="text-danger">
                                                <strong>{{ message.upc_ean_jan }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button  type="button" name="next" class="next btn btn-info buttonStyle" >Next Step</button>
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
                                            <a href="#" class="text-danger" v-if="disableAllfield != true"  v-on:click="removeE(index)"> <b> <i class="ti-close font-weight-bold"></i></b></a>
                                        </div>
                                    </div>
                                    <div class="collapse row px-3" :id="'collapseExample'+index">
                                        <div class="col-md-12">
                                            <label class="control-label">Audio file </label>
                                            <div class="justify-content-between d-flex">
                                                <img src="/admin-asset/images/upload.png" id="clickimageforupload" v-on:click="UploadAudio()" style="height:50px">
                                                <input :disabled='disableAllfield' type="file" v-on:change="previewFile()" accept="audio/*" ref="audioRef"  class="custom-file-label" id="inputGroupFi" name="audio[]" style="display: none" multiple>
                                                <div>
                                                    <audio controls :src="PreviewAudio[index]"></audio>
                                                    <div id="resultImage"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label">Language of Lyrics <span class="text-danger">*</span><span class="ml-3" style="font-size: 10px;">Select Instrumental if track has no lyrics</span></label>
                                            <select :disabled='disableAllfield' v-model="track.language_t" name="language_t" :id="'SelectTrackLanguage'+index" class="custom-select form-control">
                                                <option v-for='(item, index) in alllanguage' :key="index" :value='item'>{{item}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Track title <span class="text-danger"> * </span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do not include additional information like &quot;Remix&quot; or &quot;Uncut&quot;. Use Title Version below.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <input :disabled='disableAllfield'  v-model="track.track_title_version" type="text"  class="form-control control-form" placeholder="Enter the track title">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Title version</label>
                                            <input :disabled='disableAllfield' type="text" v-model="track.title_version" class="form-control control-form" placeholder="Enter the title version">
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <label class="control-label">Artist (Indicate ONLY ONE in this field) <span class="text-danger"> *</span> <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Do NOT indicate more than 1 artist in this field, even if it is a featured artist. Add other artists below and the service/store will add them to the artist field when it's appropriate.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <a type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addartist"><i class="ti-plus" ></i> Create new artists</a>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select :disabled='disableAllfield' v-model="track.track_artist_id" :id="'ArtistSelectOption'+index"  class="form-control" >
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
                                            <select :disabled='disableAllfield' v-model="track.other_key_artist_list_track" class="form-control" id="" multiple style="height: 100px !important;">
                                                <option v-for='(item, index) in otherkeyartist' :key="index" :value='item.id'>{{ item.other_key_artist_name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Do you have ISRC code? <span class="text-danger">*</span> 
                                                <a type="button" class="text-info ml-2" data-toggle="tooltip" title="An ISRC is a unique code that every track must have. If you don't already have one, we will generate one for you (free). Note: an ISRC is unique to each song; you should never create a new ISRC for a song that already has an ISRC.">
                                            <i class="ti-help-alt"></i></a></label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' v-model="track.has_isrc"  class="form-check-input" :id="index+432" type="radio" value="1">
                                                    <label class="form-check-label" :for="index+432">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' v-model="track.has_isrc"  class="form-check-input"  :id="index+12" type="radio" value="0">
                                                    <label class="form-check-label" :for="index+12">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="track.has_isrc == 1">
                                            <div id="handleClickISRC" >
                                                <label class="control-label"> ISRC</label>
                                                <input :disabled='disableAllfield' v-model="track.isrc_code" type="text"  class="form-control control-form"  maxlength="12" pattern="\d{12}" placeholder="ISRC">
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
                                                    <input :disabled='disableAllfield' v-model="track.explicit_lyrics"  class="form-check-input" type="radio" :id="index+865" value="1">
                                                    <label class="form-check-label" :for="index+865">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' v-model="track.explicit_lyrics"  class="form-check-input" type="radio" :id="index+2342" value="0">
                                                    <label class="form-check-label" :for="index+2342">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">The track is: <span class="text-danger">*</span> </label>
                                            <div class="d-flex">
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' v-model="track.original_public"  class="form-check-input" type="radio"  v-on:click="trackIsfirst = true; trackIssecond = false;" value="1" :id="index+track">
                                                    <label class="form-check-label" :for="index+track">An original song (publishing info will be )</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input :disabled='disableAllfield' v-model="track.original_public"  class="form-check-input" type="radio"  v-on:click="trackIssecond = true; trackIsfirst = false;" value="0" :id="index+track">
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
                                                    <select :disabled='disableAllfield' v-model="track.genre_one_track"  id="" class="custom-select form-control">
                                                        <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Secondary Genre</label>
                                                    <select :disabled='disableAllfield' v-model="track.genre_two_track"  id=""
                                                        class="custom-select form-control">
                                                        <option v-for='(item, index) in genre1' :key="index" :value='item'>{{ item }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">(P) Copyright <span class="text-danger">*</span>
                                                    <a type="button" class="text-info ml-2" data-toggle="tooltip" title="Publishing Copyright Holder: Insert the 4-digit year and name of the individual or entity that holds the rights to the publishing. Ex: 1985 Jon Smith Records.">
                                                        <i class="ti-help-alt"></i></a>
                                                </label>
                                                    <input :disabled='disableAllfield' v-model="track.p_copy_t"  type="text"  class="form-control control-form"
                                                        placeholder="2008 M" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">(C) Copyright <span class="text-danger">*</span>
                                                    <a type="button" class="text-info ml-2" data-toggle="tooltip" title="When should your track start when people preview it? The number must be given in seconds. Example: 93.">
                                                        <i class="ti-help-alt"></i></a>
                                                </label>
                                                    <input :disabled='disableAllfield' v-model="track.c_copy_t"  type="text" class="form-control control-form"
                                                        placeholder="2008 A" >
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Label name <span class="text-danger">*</span></label>
                                                    <select :disabled='disableAllfield' v-model="track.track_label_id"  name="track_label_id" id="" class="custom-select form-control">
                                                        <option v-for='(item, index) in labels' :key="index" :value='item.id'>{{ item.official_name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="control-label">Catelog track ID<span class="text-danger">*</span>
                                                        <a type="button" class="text-info ml-2" data-toggle="tooltip" title="2 characters minimum, with only letters & numbers. Best to leave blank unless you really use these.">
                                                        <i class="ti-help-alt"></i></a>
                                                    </label>
                                                        <input :disabled='disableAllfield' v-model="track.internal_track_id"  readonly type="text" id="internal_track_id"  name="internal_track_id" class="form-control control-form internal_track_id" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <h5 class="control-label" data-toggle="collapse" :data-target="'#collapseLyrics'+index" aria-expanded="false" :aria-controls="'collapseLyrics'+index"><i class="ti-arrow-circle-down mr-1"></i> Lyrics (Optional)</h5>
                                            </div>
                                            <div class="collapse" :id="'collapseLyrics'+index">
                                                <textarea :disabled='disableAllfield' class="form-control control-form"
                                                placeholder="Any order note about delivery or special offer" style="height: 108px" v-model="track.lyrics"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2 text-right" v-if="disableAllfield != true">
                                        <button :disabled='disableAllfield' v-if="track.id" type="button" class="btn btn-sm btn-info" v-on:click="UpdateTracks(track)">Update Track</button>
                                        <button :disabled='disableAllfield' v-else type="button" class="btn btn-sm btn-success" v-on:click="AddNewTracks(index)">Add New Track</button>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-12 text-right">
                                        <a v-if="disableAllfield != true" class="btn btn-lg btn-block btn-primary text-white rounded-0"  v-on:click="AddNewTrackDetails()"> <i class="ti-plus"></i> Upload a new track</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <!-- :disabled="ShowThirdValidation" -->
                                        <!-- <button type="button" name="previous" class="btn btn-danger buttonStyle" v-on:click="ValidateFormSEC()"> Validate</button> -->
                                        <button type="button" name="previous" class="previous btn btn-secondary buttonStyle" > Previous</button>
                                        <button type="button" name="previous" class="next btn btn-info buttonStyle"  > Next Step</button>
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
                                                    <a v-if="disableAllfield != true" href="#" class="text-danger" v-on:click="removePublishing(ind)"> <b> <i class="ti-close font-weight-bold"></i></b></a>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Contributor name<span class="text-danger">*</span></label>
                                                    <select :disabled='disableAllfield' name="contritibutor_track_artist_name" v-model="pub.contritibutor_track_artist_name"
                                                        class="custom-select form-control" :id="'contritibutor_track_artist_nameId'+ind">
                                                        <option v-for='(item, index) in artists' :key="index" :value='item.id'>{{item.name }}</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <strong>{{ message.contritibutor_track_artist_name }}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Role <span class="text-danger">*</span></label>
                                                    <select :disabled='disableAllfield' v-model="pub.contritibutor_role" name="contritibutor_role" :id="'contritibutor_role'+ind" class="custom-select form-control">
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
                                                    <input :disabled='disableAllfield' type="number" id="Previewcontritibutor_share" v-model="pub.contritibutor_share" name="contritibutor_share" class="form-control control-form" placeholder="001">
                                                    <span class="text-danger">
                                                        <strong>{{ message.contritibutor_share }}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Publishing<span class="text-danger"> *</span></label>
                                                    <select :disabled='disableAllfield' v-model="pub.contritibutor_publishing"  name="contritibutor_publishing" :id="'contritibutor_publishing'+ind" class="custom-select form-control">
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
                                                    <input :disabled='disableAllfield' type="text" id="Previewcontritibutor_share" v-model="pub.publisher_name" name="contritibutor_share" class="form-control control-form" placeholder="Publisher name">
                                                </div>
                                                <div class="col-12 my-2 text-right" v-if="disableAllfield != true">
                                                    <button v-if="pub.id" type="button" class="btn btn-sm btn-info" v-on:click="UpdatePUBLISHING(pub)">Update Publish</button>
                                                    <button v-else type="button" class="btn btn-sm btn-success" v-on:click="AddNewPUBLISHING(ind)">Add New Publish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mb-2" v-if="disableAllfield != true">
                                        <button type="button" class="btn btn-lg btn-block rounded-0 btn-primary" v-on:click="AddPublishing()"> <i class="ti-plus"></i>Add more contributor</button>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <!-- <button type="button" name="next" class="btn btn-danger buttonStyle" v-on:click="ValidateFormIII()"> Validate </button> -->
                                        <button type="button" name="previous" class="previous btn btn-secondary buttonStyle" > Previous </button>
                                        <button type="button" name="previous" class="next btn btn-info buttonStyle" > Next Step</button>
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
                                        <button  type="button" v-if="showstatus != 1" name="next" class="btn btn-info buttonStyle" v-on:click="SubmitReleseDetails()"> Update</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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
    props:['artists','labels','stores','alllanguage', 'genre1', 'alldetails', 'otherkeyartist','roles'],
    data() {
        return {
            upcShowHide:0,
            OtherkeyArtist:[],
            other_key_artist_list:[],
            Publishing:[],

            ShowConfirmBtn:true,
            HiddenAssetId:'',
            HiddenAssetDetailsId:'',
            HiddenTrackId:[],
            HiddenTrackDetailsId:'',
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
            language:'',
            release_title:'',
            title_version:'',
            is_various_artist:'',
            asset_artist_id:'',
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
            tracks:[],
            CheckStore:[],

            Modalimage:'',
            ModalPreview:'',
            Modalname:'',
            Modalemail:'',
            Modalbiography:'',
            Modalspotify_id:'',
            Modalapple_id:'',

            showstatus:0,
            disableAllfield:false,
        }
    },
    watch: {
        previously_release(){
            if(this.previously_release ==1){
                this.upcShowHide = 1
            }else{
                this.upcShowHide = 0
            }
        },
        showstatus(){
            if(this.showstatus==1){
                this.disableAllfield = true;
            }else if(this.showstatus==2){
                this.disableAllfield = true;
            }
        },
    },
    created(){
        this.GetALLArtistList();
        this.GetOtherKeyArtistList();
    },
    mounted() {
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
        });
        new SlimSelect({
            select: '#MainArtistId'
        });
        new SlimSelect({
            select: '#OtherKeyRole'
        });
        new SlimSelect({
            select: '#Labelnameid'
        });
    },
    computed:{
        alldetails(){
            this.showstatus = this.alldetails.status;
            if(this.alldetails.status == 1){
                this.ShowConfirmBtn = false;
            }else if(this.alldetails.status == 0)
            {
                this.ShowConfirmBtn = true;
            }else if(this.alldetails.status == 2){
                this.ShowConfirmBtn = false;
            }
            this.HiddenAssetId = this.alldetails.id;
            this.HiddenAssetDetailsId = this.alldetails.asset_artisat_details.id;
            this.HiddenTrackDetailsId = this.alldetails.track_artisat_details.id;

            this.PreviewImage = '/storage/'+this.alldetails.cover_image ;
            this.language =this.alldetails.language ;
            this.release_title =this.alldetails.release_title ;
            this.title_version =this.alldetails.title_version ;
            this.is_various_artist =this.alldetails.is_various_artist ;

            this.asset_artist_id =this.alldetails.asset_artisat_details.asset_artist_id ;

            var other_key;
            var test =[];
            other_key  = this.alldetails.other_key_artist_list.split(",");
            other_key.forEach(element => {
                test.push(parseInt(element))
            });
            this.other_key_artist_list = test;
            
            this.genre_one =this.alldetails.genre_one ;
            this.genre_two =this.alldetails.genre_two ;
            this.p_copy =this.alldetails.p_copy ;
            this.c_copy =this.alldetails.c_copy ;
            this.previously_release =this.alldetails.previously_release ;
            if(this.alldetails.release_date){
                this.release_date = this.alldetails.release_date;
            }else{
                this.release_date = "";
            }
            this.label_id =this.alldetails.label_id ;
            this.internal_release_id =this.alldetails.internal_release_id ;
            this.upc_ean_jan =this.alldetails.upc_ean_jan ;
            
            this.alldetails.track_details.filter((valueII) => { 
                return valueII.other_key_artist_list_track = valueII.other_key_artist_list_track.split(" ").filter((valII) => { 
                    return parseInt(valII)
                })
                
            });

            this.alldetails.track_details.forEach((value, index) => {
                return value.other_key_artist_list_track = $.map(value.other_key_artist_list_track, function(val, ind) {
                    return [ parseInt(val)];
                });
               
            });

            this.alldetails.track_details.forEach((value, index) => {
                this.HiddenTrackId.push(value.id);
                this.PreviewAudio.push('/storage/'+value.audio);
            });

            this.tracks = this.alldetails.track_details;
            
            this.Publishing = this.alldetails.track_artisat_details.filter((val) => { 
                return[ 
                    val.contritibutor_track_artist_name = val.track_artist_name,
                    val.contritibutor_role = val.role,
                    val.contritibutor_share = val.share,
                    val.contritibutor_publishing = val.publishing,
                    val.publisher_name = val.publisher_name
                ]
            });
        }
    },
    methods: {
        AddNewPUBLISHING(index){
            Confirm.show('Update Confirmation','Do you want to Add?','Yes','No',
            () => {
                var formData = new FormData();
                formData.append('asset_id', this.alldetails.id);
                formData.append('Publishing', JSON.stringify(this.Publishing[index]));
                axios.post('/asset/add/publishing',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Add New Publishing','Added sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
        },
        UpdatePUBLISHING(Publishing){
            Confirm.show('Update Confirmation','Do you want to Update?','Yes','No',
            () => {
                var formData = new FormData();
                formData.append('asset_id', this.alldetails.id);
                formData.append('Publishing', JSON.stringify(Publishing));
                axios.post('/asset/update/publishing',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Update Publishing','Update sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
        },
        AddNewTracks(index){
            Confirm.show('Add Confirmation','Do you want to add?','Yes','No',
            () => {
                var formData = new FormData();
                this.audio.forEach((file,index) =>{
                    formData.append('audio['+index+']', file);
                });
                formData.append('asset_id', this.alldetails.id);
                formData.append('tracks', JSON.stringify(this.tracks[index]));
                axios.post('/asset/add/track',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Add New Track','Added sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
        },
        UpdateTracks(tracks){
            Confirm.show('Update Confirmation','Do you want to Update?','Yes','No',
            () => {
                var formData = new FormData();
                this.audio.forEach((file,index) =>{
                    formData.append('audio['+index+']', file);
                });
                formData.append('tracks', JSON.stringify(tracks));
                axios.post('/asset/update/track',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Update','Update sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
        },
        SubmitReleseDetails(){
            Confirm.show('Update Confirmation','Do you want to Update?','Yes','No',
            () => {
                if( this.language  && this.release_title &&  this.is_various_artist !=null &&  this.genre_one && this.p_copy && this.c_copy && this.label_id && this.previously_release != null)
                {
                    var formData = new FormData();
                    formData.append('HiddenAssetId', this.HiddenAssetId);
                    formData.append('HiddenAssetDetailsId', this.HiddenAssetDetailsId);
                    formData.append('HiddenTrackId', JSON.stringify(this.HiddenTrackId));
                    formData.append('HiddenTrackDetailsId', this.HiddenTrackDetailsId);

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
                    formData.append('other_key_artist_list', (this.other_key_artist_list));

                    // this.audio.forEach((file,index) =>{
                    //     formData.append('audio['+index+']', file);
                    // });
                    // formData.append('tracks', JSON.stringify(this.tracks));
                    // formData.append('Publishing', JSON.stringify(this.Publishing));

                    axios.post('/asset/update',formData,{
                    headers: { 'Content-Type': 'multipart/form-data'}, } )
                    .then((res)=>{
                    Report.success('Update','Update sucessfully','Okay');
                    window.location.href = '/asset'
                    },()=>{
                        Notify.failure();
                    })
                }else{
                    Notify.failure('Please fill the all mendetroy fields');
                }
            },
            () => {
            })
        },
        UploadAudio(){
            $('#inputGroupFi').click();
        },
        previewFile(){
            for (var i = 0; i < this.$refs.audioRef.length; i++ ){
                let file = this.$refs.audioRef[i].files[0];
                console.log(file.type)
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
        GetALLArtistList(){
            axios.get('/artists-list')
            .then((Response)=>{
                this.AllArtist = Response.data;
            },()=>{
                    Notiflix.Notify.Failure("Please contact with authorized person.");
            });
        },
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
        GetOtherKeyArtistList(){
            axios.get('/get-other-key-artist')
            .then((Response)=>{
                this.OtherkeyArtist = Response.data;
                // console.log(this.OtherkeyArtist)
            },()=>{
                Notify.failure("Please contact with authorized person.");
            });
        },
        AddPublishing(){
            this.Publishing.push({contritibutor_track_artist_name:'', contritibutor_role:'',
            contritibutor_share:'', contritibutor_publishing:'', publisher_name:''});
        },
        removePublishing(index){
            if(this.Publishing[index].id){
                Confirm.show('Delete Confirmation','Do you want to Delete?','Yes','No',
            () => {
                var formData = new FormData();
                formData.append('Publishing', this.Publishing[index].id);
                axios.post('/asset/delete/publishing',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Delete Publishing','Delete sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
            }else{
                this.Publishing.splice(index, 1);
            }
        },
        AddNewTrackDetails(){
            if (this.tracks.length < 6){
                this.tracks.push({language_t:'', track_title_version:'',title_version:'', track_artist_id:'', has_isrc:'', isrc_code:'',explicit_lyrics:'',original_public:"",genre_one_track:'',genre_two_track:'',p_copy_t:'',c_copy_t:'',track_label_id:'',internal_track_id:'',lyrics:'', other_key_artist_list_track:""});
    
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
            if(this.tracks[index].id){
                Confirm.show('Delete Confirmation','Do you want to Delete?','Yes','No',
            () => {
                var formData = new FormData();
                formData.append('trackid', this.tracks[index].id);
                axios.post('/asset/delete/track',formData,{
                headers: { 'Content-Type': 'multipart/form-data'}, } )
                .then((res)=>{
                Report.success('Delete Track','Delete sucessfully','Okay');
                window.location.href = '/asset/'+this.alldetails.id+'/edit'
                },()=>{
                    Notify.failure();
                })
            },
            () => {
            })
            }else{
                this.tracks.splice(index, 1);
            }
        },
    },
}
</script>