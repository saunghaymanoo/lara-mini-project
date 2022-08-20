@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Category</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
      <h2>Category List</h2>
      <a href="{{route('category.create')}}" class="text-primary pr-2"><i class="fa fa-2x fa-plus-circle"></i></a>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>User Name</th>
          <th>Control</th>
          <th>Created AT</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $c)
        <tr>
          <td>{{$c->id}}</td>
          <td>{{$c->title}}</td>
          <td>{{$c->user->name}}</td>
          <td>
            <form action="{{route('category.destroy',$c->id)}}" method="post" class="d-inline-block">
              @csrf
              @method('delete')
            <button class="btn btn-outline-danger btn-sm">
              Del
            </button>
            </form>

            <a href="{{route('category.edit',$c->id)}}" class="btn btn-outline-warning btn-sm">
              Edit
            </a>
          </td>
          <td>
            <p><i class="fa fa-calendar-alt"></i>{{$c->created_at->format('d m Y')}}</p>
            <p><i class="fa fa-clock fa-fw"></i>{{$c->created_at->format('g:m A')}}</p>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection