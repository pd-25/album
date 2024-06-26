@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | Category-edit')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Edit user </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-title">
                    <h4>Edit User</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('users.update', encrypt($artist->id)) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="full name" name="name"
                                            value="{{ $artist->name }}">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label><span class="text-info">(This field is not changable)</span>
                                        <span class="form-control">{{ $artist->email }}</span>
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Change Password</label><span class="text-info">(if you don't want to change,
                                            don't keep it blank)</span>
                                        <input type="password" class="form-control" placeholder="password" name="password">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="form-control" name="profile_image">
                                        @error('profile_image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Zipcode</label><span class="text-danger">*</span>
                                        <input type="number" class="form-control" placeholder="zipcode" name="zipcode"
                                            value="{{ $artist->zipcode }}">
                                        @error('zipcode')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Banner Image</label>
                                        <input type="file" class="form-control" name="banner_image"
                                            value="{{ old('banner_image') }}">
                                        @error('banner_image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Current Profile Image</label>
                                        @if (!empty($artist->profile_image) && File::exists(public_path('storage/ProfileImage/' . $artist->profile_image)))
                                            <img style="height: 82px; width: 82px;"
                                                src="{{ asset('storage/ProfileImage/' . $artist->profile_image) }}"
                                                alt="">
                                        @else
                                            <img style="height: 82px; width: 82px;" src="{{ asset('noimg.png') }}"
                                                alt="">
                                        @endif
                                    </div>

                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Current Banner Image</label>
                                        @if (!empty($artist->banner_image) && File::exists(public_path('storage/BannerImage/' . $artist->banner_image)))
                                            <img style="height: 82px; width: 82px;"
                                                src="{{ asset('storage/BannerImage/' . $artist->banner_image) }}"
                                                alt="">
                                        @else
                                            <img style="height: 82px; width: 82px;" src="{{ asset('noimg.png') }}"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="form-group">

                                    </div>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
