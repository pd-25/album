@extends('user.main')
@section('title', env('APP_NAME').'Frontstage | Distribute Details'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        <div class="d-flex align-items-center">
            <a href="{{route('distribute.index', request('id'))}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="ml-4">
            <h3 style="font-size: 400">Distribute your release  
            @php
                $asset_id = request('id');
             @endphp
            </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <form action="{{route('distribute.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="card mb-4 rounded-0">
            <div class="row">
                <input type="hidden" name="asset_id" value="{{$asset_id}}" id="">
                <div class="col-12 mb-2 p-2 border-bottom">
                    <label class="control-label">
                        Release start date <a type="button" class="text-info ml-2" data-toggle="tooltip" title="The date you want this release to go live.">
                            <i class="ti-help-alt"></i></a>
                    </label>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" onclick="checkrelseDate(value)" type="radio" checked value="0" name="release_start" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            As soon as possible
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check mb-2">
                        <input class="form-check-input" onclick="checkrelseDate(value)" type="radio" value="1" name="release_start" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            On a specific date
                        </label>
                    </div>
                    <div>
                        <input type="date" disabled id="release_start_dateid" class="form-control control-form" name="release_start_date">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 rounded-0">
            <div class="row px-2">
                <div class="col-12 mb-2 p-2 border-bottom">
                    <label class="control-label"> Music Distribution</label>
                </div>
                <div class="col-12 mb-2 p-2 border-bottom">
                    <label class="form-label">Select the stores and services you would like to distribute your music to.</label>
                </div>
                <div class="col-12 mb-2 p-2 border-bottom">
                    <div class="ml-2 form-check form-check-inline">
                        <input type="checkbox" id="checkAll" class="form-check-input">
                        <label class="form-check-label font-weight-bold" for="checkAll">Select all</label>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="row">
                        @if (!@empty($stores))
                            @foreach ($stores as $item)
                                <div class="col-3">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-8 col-form-label">
                                            <span> 
                                                @if ($item->cover_image != null)
                                                    <img style="height: 40px" src="/storage/store/{{$item->cover_image}}" alt="No Image">
                                                @else
                                                    <img v-else style="height: 40px;" src="/noimg.png" alt="No Images">
                                                @endif
                                            </span>
                                            {{$item->label_name }}
                                        </label>
                                        <div class="col-sm-4">
                                        <input type="checkbox" class="form-control-plaintext storecheckbox" id="" name="music_distribution[]" value="{{$item->id}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 rounded-0">
            <div class="row">
                <div class="col-12 mb-4 p-2 border-bottom">
                    <label for="" class="control-label">Select Monetization Service & Policy</label>
                </div>
                <div class="col-6 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="monetization_facebook" value="1" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        <img src="/admin-asset/images/facebook.png" alt="No images" class="mx-3 img_fluid" style="height: 23px">Facebook Rights Manager
                        </label>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <label class="control-label">Select a policy</label>
                    <select name="facebook_policy" class="form-control control-form" id="">
                        <option value="1">Claim Ad Earnings</option>
                        <option value="2">Monitor</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="monetization_youTube" value="1" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        <img src="/admin-asset/images/youtube.png" alt="No images" class="mx-3 img_fluid" style="height: 23px">YouTube Content ID  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="YouTube policy requires YouTube Music be automatically added if distributing to YouTube Content ID.">
                            <i class="ti-help-alt"></i></a>
                        </label>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label class="control-label">Select a policy</label>
                    <select name="youTube_policy" class="form-control control-form" id="">
                        <option value="1">Monetize in all countries</option>
                        <option value="2">Track in all countries</option>
                    </select>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary py-2 px-4 rounded-0">Send</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).ready(function() {  

        });
        function checkrelseDate(val){
            if(val == 1){
                $('#release_start_dateid').removeAttr("disabled", "disabled");
            }else{
                $('#release_start_dateid').attr("disabled", "disabled");
            }
        }

        $("#checkAll").click(function(){
            $('.storecheckbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection