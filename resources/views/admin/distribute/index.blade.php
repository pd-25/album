@extends('user.main')
@section('title', env('APP_NAME').'Frontstage | Distribute Details'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 d-flex bg-white">
        <div class="d-flex align-items-center">
            <a href="{{route('admin.index')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="ml-4 ">
            <h3 style="font-size: 400">Distribution</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="container">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12 d-flex">
                    <img src="/storage/{{@$Getartist->cover_image}}" class="img_flud" style="height:150px" alt="No images">
                    <div class="ml-4 align-items-center">
                        <h6 class="mb-2 border-bottom p-2">{{@$Getartist->release_title}}</h6>
                        <span>by {{@$Getartist->artist_name->name}}</span> <br>
                        <span>Added on {{date('d M Y', strtotime($Getartist->created_at))}}</span>
                    </div>
                </div>
                @if (@empty($Distribution))
                    <div class="col-12 text-right">
                        <a href="{{route('distribute.Admincreate', $Getartist->id)}}" class="btn btn-primary py-2 px-4 rounded-0 text-white">Distribute Now</a>
                    </div>
                @endif
            </div>
        </div>
        @if (!@empty($Distribution))
            <div class="card mb-4">
                <div class="row">
                    <div class="col-12">
                    </div>
                    <div class="col-12 mb-2 p-2 border-bottom">
                        <label class="control-label">
                            Release start date <a type="button" class="text-info ml-2" data-toggle="tooltip" title="The date you want this release to go live.">
                                <i class="ti-help-alt"></i></a>
                        </label>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" disabled onclick="checkrelseDate(value)" type="radio"  value="0" name="release_start" {{@$Distribution->release_start == 0 ? 'checked':''}} id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                As soon as possible
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check mb-2">
                            <input class="form-check-input" disabled onclick="checkrelseDate(value)" type="radio" value="1" name="release_start" {{@$Distribution->release_start == 1 ? 'checked':''}} id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                On a specific date
                            </label>
                        </div>
                    <div>
                        <input type="date" disabled id="release_start_dateid" class="form-control control-form" name="release_start_date" value="{{ $Distribution->release_start_date ==null? '': date('Y-m-d', strtotime(@$Distribution->release_start_date)) }}">
                    </div>
                </div>
            </div>
            <div class="card mb-4 rounded-0">
                <div class="row px-2">
                    <div class="col-12 mb-2 p-2 border-bottom">
                        <label class="control-label"> Music Distribution</label>
                    </div>
                    <div class="col-md-12 mb-2">
                        <table class="table table-sm">
                            <thead>
                                <th>SN</th>
                                <th>Service</th>
                                <th>Date added</th>
                                <th>Delivered on</th>
                            </thead>
                            <tbody>
                                @if (!@empty($finalStoreDetails))
                                    @foreach ($finalStoreDetails as $index=>$value)
                                        <tr>
                                            <td>#{{$index+1}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="mx-3">
                                                        @if (@$value['cover_image'] != null)
                                                            <img style="height: 40px" src="/storage/store/{{@$value['cover_image']}}" alt="No Image">
                                                        @else
                                                            <img style="height: 40px;" src="/noimg.png" alt="No Images">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        {{@$value['label_name'] }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($value['created_at'])
                                                    {{date('d M Y', strtotime(@$value['created_at']))}}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{route('distribute.AdminDelivered')}}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <select name="delivered_on" class="form-control">
                                                                <option value="0" {{$value['delivered_on'] == 0? 'selected': ''}}>Processing</option>
                                                                <option value="1" {{$value['delivered_on'] == 1? 'selected': ''}}>Delivered</option>
                                                                <option value="2" {{$value['delivered_on'] == 2? 'selected': ''}}>Approved</option>
                                                                <option value="3" {{$value['delivered_on'] == 3? 'selected': ''}}>Rejected</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$value['id']}}">
                                                        <div class="col-2">
                                                            <button class="btn btn-sm btn-success" type="submit"><i class="ti-save"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card mb-4 rounded-0">
                        <div class="row">
                            <div class="col-12 mb-4 p-2 border-bottom">
                                <label for="" class="control-label">Select Monetization Service & Policy</label>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" disabled type="checkbox" name="monetization_facebook" {{@$Distribution->monetization_facebook == 1 ? 'checked':''}} value="1" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <img src="/admin-asset/images/facebook.png" alt="No images" class="mx-3 img_fluid" style="height: 23px">Facebook Rights Manager
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="control-label">Select a policy</label>
                                <select name="facebook_policy" disabled class="form-control control-form" id="">
                                    <option value="1" {{@$Distribution->facebook_policy == 1 ? 'selected':''}} >Claim Ad Earnings</option>
                                    <option value="2" {{@$Distribution->facebook_policy == 2 ? 'selected':''}}>Monitor</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="monetization_youTube" disabled {{@$Distribution->monetization_youTube == 1 ? 'checked':''}} value="1" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <img src="/admin-asset/images/youtube.png" alt="No images" class="mx-3 img_fluid" style="height: 23px">YouTube Content ID  <a type="button" class="text-info ml-2" data-toggle="tooltip" title="YouTube policy requires YouTube Music be automatically added if distributing to YouTube Content ID.">
                                        <i class="ti-help-alt"></i></a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="control-label">Select a policy</label>
                                <select name="youTube_policy" disabled class="form-control control-form" id="">
                                    <option value="1" {{@$Distribution->youTube_policy == 1 ? 'selected':''}}>Monetize in all countries</option>
                                    <option value="2" {{@$Distribution->youTube_policy == 2 ? 'selected':''}}>Track in all countries</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection