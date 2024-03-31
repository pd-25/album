@extends('user.main')
@section('title', env('APP_NAME').' | News Details'  )
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mb-4">
                    <h6 class="mb-0"><b>#Support Ticket</b></h6>
                </div>
                <div class="col-6 text-right mb-4">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Ticket</a>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                              <th scope="col">#</th>
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
                                    <td>{{@$item->subject}}</td>
                                    <td>
                                        @if (@$item->status == 1)
                                            <span class="text-success">Active </span>
                                        @else
                                            <span class="text-danger">Closed </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('support.showmessage', $item->id)}}"><i class="ti-comment-alt btn btn-sm btn-light"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Create Ticket</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('support.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="subject" value="{{old('subject')}}">
                        <span class="text-danger">
                            @error('subject')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="categoryId" class="custom-select">
                            <option value="" selected>Select category</option>
                            @if (!@empty($category))
                                @foreach ($category as $index=>$item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="text-danger">
                            @error('categoryId')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea type="text" rows="3" class="form-control h-auto" name="description">{{old('description')}}</textarea>
                        <span class="text-danger">
                            @error('description')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Attachments</label>
                        <input type="file" class="form-control" name="attachments">
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success mr-2">Create Ticket</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
    ClassicEditor
        .create( document.querySelector( '#editorSupport' ) )
        .catch( error => {
            console.error( error );
        } )
    </script>
@endsection