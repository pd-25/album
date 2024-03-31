@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Label-index'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">All Label </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
    <div class="row justify-content-center">

        <div class="col-lg-10">
            <div class="card">
                <div class="card-title pr">
                    <h4>All Labels</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
                <div class="card-title text-right">
                    <a href="{{ route('label.create') }}" class="btn btn-sm btn-success">Add Label</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Label name</th>
                                    {{-- <th>Username</th>
                                    <th>Email</th> --}}
                                    <th> Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($labels as $label)
                             
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            {{ $label->official_name }}
                                            
                                        </td>
                                       
                                        <td>
                                            @if (!empty($label->image) && File::exists(public_path('storage/LabelImage/' . $label->image)))
                                            <img style="height: 82px; width: 82px;" src="{{ asset('storage/LabelImage/'.$label->image) }}" alt="">
                                                
                                            @else
                                            <img style="height: 82px; width: 82px;" src="{{asset('noimg.png') }}" alt="">
                                                
                                            @endif
                                            
                                            
                                        </td>
                                        
                                        
                                        <td>
                                           
                                            <a href="{{ route('label.edit', encrypt($label->id)) }}"><i
                                                    class="ti-pencil btn btn-sm btn-primary"></i></a>
                                            <form method="POST"
                                                action="{{ route('label.destroy', encrypt($label->id)) }}"
                                                class="action-icon">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger  delete-icon show_confirm"
                                                    data-toggle="tooltip" title='Delete'>
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
   
@endsection
