@extends('admin.layout.main')
@section('title', env('APP_NAME').' |  Support Ticket Message'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Message's </h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card mb-1 shadow rounded" style="height: 400px; overflow:auto">
        <div class="row">
            <div class="col-12 mb-3 d-flex justify-content-between">
                <h6 class="mb-0"><b>Ticket Details</b></h6>
                <a href="{{route('support.create')}}" class="btn btn-link">Back</a>
            </div>
            <div class="col-4 mb-2">
                <input class="custom-select custom-select-sm" value="{{@$supportic->userDetails->name}}" disabled/>
            </div>
            <div class="col-4 mb-2">
                <input class="custom-select custom-select-sm" value="{{@$supportic->userDetails->email}}" disabled />
            </div>
            <div class="col-4 mb-2">
                <select name="categoryId" class="custom-select custom-select-sm" disabled>
                    @if (!@empty($category))
                        @foreach ($category as $index=>$item)
                            <option value="{{$item->id}}" {{$supportic->categoryId == $item->id ? 'selected' : ''}}>{{@$item->category_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-8">
                <textarea style="height:200px;" rows="3" readonly type="text" class="form-control h-auto" name="description">{{@$supportic->description}}</textarea>
                <span class="text-danger">
                    @error('description')
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
            </div>
            <div class="col-4 text-center mb-2">
                <div>
                    <img style="height:80px" src="/storage/support_ticket/{{@$supportic->attachments}}" alt="Noinage">
                </div>
            </div>
        </div>
        <div class="row bg-light m-2">
            @if (!@empty($message))
                @foreach ($message as $item)

                    <div class="col-8 m-1 p-1 text-left {{@$item->admin == 1 ? 'bg-info rounded':'bg-secondary rounded'}}">
                        <div class="text-white d-flex justify-content-between pl-1">
                            <span>
                                {{date('d-m-Y', strtotime($item->created_at))}}
                            </span>
                            <span class="pr-2 pt-1">
                                @if ($item->admin == 1)
                                    <span class="text-white">Admin</span>
                                @elseif($item->user == 1)
                                    <span class="text-white">user</span>
                                @endif
                            </span>
                        </div>
                        <h6 class="mb-0 text-white p-1">{{@$item->messages}}
                            {{-- {{$item}} --}}
                        </h6>
                        <div class="text-right text-white pr-2 pb-1">
                            {{date('H:i', strtotime($item->created_at))}}
                        </div>
                    </div>
                    {{-- {{$item}} --}}
                @endforeach
            @endif
        </div>
    </div>
    @if (@$supportic->status == 1)
        <div class="card shadow rounded">
            <form action="{{route('support.AdminSendMessage')}}" method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-10">
                        <input type="hidden" name="supportticketid" value="{{$supportic->id}}">
                        <input type="text" placeholder="Type your message......." name="message" class="form-control bg-light">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-light btn-sm" ><img src="{{asset('/admin-asset/images/send.png')}}" alt="send" style="height: 32px"></button>
                    </div>
                </div>
            </form>
        </div>
    @else
    <div class="text-center mt-4">
        <span class="text-danger">Support ticket has been closed</span>
    </div>
    @endif
</div>
@endsection
@section('script')
<script>
    
</script>
@endsection