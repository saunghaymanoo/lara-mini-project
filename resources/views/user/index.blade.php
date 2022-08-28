@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">User List</li>
  </ol>
</nav>
<div class="">
  @if(session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
  @endif
  @if(request('keyword'))
  <p>Search by <span>{{request('keyword')}}</span> <a href="{{route('item.index')}}"><i class="bi bi-backspace"></i></a></p>
  @endif

  <table class="table table-striped table-hover">
    <thead>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Photo</th>
      <th>Control</th>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td class="w-25">{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role}}</td>
        <td>
          @if($user->photo)
          <img src="{{ asset('storage/'.$user->photo) }}" alt="" style="width:70px;height:70px;" class="rounded-full">
          @else
          <img src="{{ asset('storage/user.png') }}" alt="" style="width:50px;height:50px;" class="rounded-full">
          @endif
        </td>
        <td>
          <a href="{{route('user.show',$user->id)}}" class="btn btn-sm btn-outline-info">
            <i class="bi bi-info-circle"></i>
          </a>
          <form action="{{route('user.destroy',$user->id)}}" method='post' class='d-inline-block'>
            @csrf 
            @method('delete')
            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
          </form>
          <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-outline-warning">
            <i class="bi bi-pencil"></i>
          </a>
        </td>
      </tr>
      @endforeach
      @if(empty($user))
        <tr><td colspan="8" class="text-center">There is no users</td></tr>
      @endif
    </tbody>
  </table>
  <div class="">{{$users->onEachSide(1)->links()}}</div>
</div>
@endsection