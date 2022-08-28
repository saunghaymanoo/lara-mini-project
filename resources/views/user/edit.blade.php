@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
  </ol>
</nav>
<div class="row">
  <div class="col-9">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Edit User</h2>
          <a href="{{route('user.index')}}" class="btn btn-primary btn-md rounded rounded-full"><i class="fa fa-list"></i></a>
        </div>
        <hr>
        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="">
            <div class="form-group mb-4">
              <label for="">User Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$user->name)}}">
              @error('name')
              <div class="text-sm text-danger">{{$message}}</div>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="">User Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$user->email)}}">
              @error('email')
              <div class="text-sm text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group mb-4">
              <label for="">Role</label>
              <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                @php
                $role = "role";
                @endphp
                <option value="admin" {{ old($role,$user->role)==='admin' ? 'selected':'' }}>
                  Admin
                </option>
                <option value="editor" {{ old($role,$user->role)==='editor' ? 'selected':'' }}>
                  Editor
                </option>
                <option value="author" {{ old($role,$user->role)==='author' ? 'selected':'' }}>
                  Author
                </option>

              </select>
              @error('role')
              <div class="text-sm text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group mb-4">
              <span class="">
                @if($user->photo)
                <img src="{{asset('storage/'.$user->photo)}}" style="width:50px;height:50px;" class="mb-2 rounded-full" alt="">
                <input type="hidden" name="oldphoto" value="{{old('photo',$user->photo)}}">
                @endif
              </span>
              <label for="">Photo</label>
              <input type="file" name="photo" class="p-1 form-control @error('photo') is-invalid @enderror">
              @error('photo')
              <div class="text-sm text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="">
              <button class="btn btn-primary">Edit</button>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection