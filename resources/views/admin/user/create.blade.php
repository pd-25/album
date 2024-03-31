@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | user-create')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Create user </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-title">
                        <h4>Create user</h4>
                        @if (Session::has('msg'))
                            <p class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" placeholder="full name" name="name"
                                            value="{{ old('name') }}" required>


                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ 'Artist name field is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control" placeholder="abc@mail.com" name="email"
                                            value="{{ old('email') }}" required>


                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">

                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <label>Password</label><span class="text-danger">*</span>
                                <input type="password" class="form-control" placeholder="" name="password" required>
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

        

    @endsection
