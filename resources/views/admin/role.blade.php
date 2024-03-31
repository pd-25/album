@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Other key Roles'  )
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 bg-white">
        <div class="ml-4">
            <h3 style="font-size: 400">Other Key Artist Roles</h3>
            @if (Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-right">
                    <a role="button" class="btn btn-link text-info" data-toggle="modal" data-target="#addRoles" v-on:click="AddOtherKeyArtist()"><i class="ti-plus"></i> Add Roles</a>
                </div>
                <div class="col-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTableNews">
                                @if (!@empty($roles))
                                    @foreach ($roles as $index=>$item)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{$item->roles}}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('roles.destroy', encrypt(2)) }}"
                                                    class="action-icon">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input name="DeleteId" type="hidden" value="{{@$item->id}}">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger  delete-icon show_confirm"
                                                        data-toggle="tooltip" title='Delete'>
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
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

 <!-- Modal Create artist -->
 <div class="modal fade" id="addRoles" tabindex="-1" role="dialog" aria-labelledby="addartistTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="addartistTitle">Create Role</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('roles.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-12">
                        <label> <b>Roles</b></label><span class="text-danger">*</span>
                        <input type="text" class="form-control" placeholder="Roles name" name="roles">
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" id="submitBtn" type="submit">Create Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
   
</script>
@endsection