@extends('user.main')
@section('title', env('APP_NAME').' | Label-index'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Labels</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="input-group mb-3">
                <div class="input-group-prepend border">
                  <span class="input-group-text" style="background:white; border:0px solid white">Filter</span>
                </div>
                <input type="text" id="myInput" onblur="this.setAttribute('readonly', 'readonly');" 
                onfocus="this.removeAttribute('readonly');" readonly class="form-control form-control-sm" name="search" placeholder="&#xF002; Search by text" style="font-family:Arial, FontAwesome; background:white; border:1px sold white">
                <div class="input-group-append border">
                  <span class="input-group-text px-4" style="background:#8464CB; border:0px solid white"><a class="text-white" href="{{ route('labels.create') }}"><i class="ti-plus"></i> Add Label</a></span>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p  style="text-align: left">Showing all labels</p>
        </div>
        @if (!@empty($labels)) 
        @foreach ($labels as $label)
        <div class="col-md-4" id="myTable">
            <div class="card">
                <div class="text">
                    @if (!empty($label->image) && File::exists(public_path('storage/LabelImage/' . $label->image)))
                        <img style="height: 82px; width: 82px;" src="{{ asset('storage/LabelImage/'.$label->image) }}" alt="No image">
                        @else
                        <img style="height: 82px; width: 82px;" src="{{asset('noimg.png') }}" alt="">
                        @endif
                    <h3>{{ @$label->official_name}}</h3>
                    <p>{{ @$label->email}}</p>
                </div>
                <div class="d-flex justify-content-start">
                    {{-- <a href="{{ route('labels.edit', encrypt($label->id)) }}"><i
                        class="ti-pencil btn btn-sm btn-primary mr-3"></i></a> --}}
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
                </div>
            </div>
        </div>
        @endforeach
        @endif
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

        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
