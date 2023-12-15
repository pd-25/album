@extends('user.main')
@section('title', env('APP_NAME').' | Label-index'  )
@section('content')
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
                    <a href="{{ route('labels.create') }}" class="btn btn-sm btn-success">Add Label</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Label name</th>
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
                                       
                                        <a href="{{ route('labels.edit', encrypt($label->id)) }}"><i
                                                class="ti-pencil btn btn-sm btn-primary"></i></a>
                                        <form method="POST"
                                            action="{{ route('labels.destroy', encrypt($label->id)) }}"
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
    <script>
        function changeStatus(slug, id) {
            $.ajax({
                type: "POST",
                url: "#",
                data: {
                    'service_slug': slug,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        $("#status-btn"+ id).load(window.location.href + " #status-btn"+ id);
                        swal('Status updated');
                    }else {
                        swal('Some Error occur, relode the page');
                    }
                }
            });
        }
    </script>
@endsection
