@extends('admin.layout.main')
@section('title', env('APP_NAME').' |  Support Ticket'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Support ticket</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card rounded shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h6 class="mb-0"><b>#Support Ticket</b></h6>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                              <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (!@empty($supporticket))
                                @foreach ( @json_decode($supporticket) as $item)
                                <tr>
                                    <td>
                                        <div class="messages">
                                            <div class="badge">
                                            <div class="message-count">{{@$item->messageCount}}</div>
                                            </div>
                                        <div>
                                    </td>
                                    <td>{{@$item->username}}</td>
                                    <td>{{@$item->subject}}</td>
                                    <td>
                                        <select name="status" class="custom-select" style="width: 100px" onchange="StatusUpdate(@json($item->id), value)">
                                            <option value="1" {{@$item->status == 1 ? 'selected': ''}}> Active</option>
                                            <option value="0" {{@$item->status == 0 ? 'selected': ''}}> Closed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{route('support.adminmessageshow', @$item->id)}}"><i class="ti-comment-alt btn btn-sm btn-light"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
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
        Notiflix.Notify.Init({});
        function StatusUpdate(id, value){
            $.ajax({
                type: "POST",
                url: "/admin/support-ticekt/status",
                data: {
                    'id': id,
                    'status': value,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response)
                    if (response == 'success') {
                        Notiflix.Notify.Success('Status changed successfully');
                    }else {
                        Notiflix.Notify.Failure("Something went wrong");
                    }
                }
            });
        }
    </script>
@endsection