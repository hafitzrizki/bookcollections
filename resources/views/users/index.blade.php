@extends("layouts.global")

@section("title") Users list @endsection

@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<div class="row">
    <div class="col-md-5" style="padding-bottom:8px;">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create user</a>
    </div>
    <div class="col-md-7">
        <form action="{{route('users.index')}}">            
            <div class="row">
                <div class="col-md-6" style="padding-bottom:8px;">
                    <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text" placeholder="Filter berdasarkan email" />
                </div>
                <div class="col-md-4" style="padding-bottom:8px;">
                    <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} value="ACTIVE" name="status" type="radio" class="form-control" id="active">
                    <label for="active">Active</label>

                    <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} value="INACTIVE" name="status" type="radio" class="form-control" id="inactive">
                    <label for="inactive">Inactive</label>
                </div>
                <div class="col-md-2" style="padding-bottom:8px;">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->avatar)
                    <img src="{{asset('storage/'.$user->avatar)}}" width="70px" />
                    @else
                    N/A
                    @endif

                </td>
                <td>
                    @if($user->status == "ACTIVE")
                    <span class="badge badge-success">
                        {{$user->status}}
                    </span>
                    @else
                    <span class="badge badge-danger">
                        {{$user->status}}
                    </span>
                    @endif
                </td>
                <td>
                    <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                    <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>
                    <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="{{route('users.destroy', [$user->id])}}" method="POST">

                        @csrf

                        <input type="hidden" name="_method" value="DELETE">

                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    {{$users->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection