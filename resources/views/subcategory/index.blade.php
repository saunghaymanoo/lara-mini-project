@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    @if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
      <h2>SubCategory List</h2>
      <a href="{{route('subcategory.create')}}" class="text-primary pr-2"><i class="fa fa-2x fa-plus-circle"></i></a>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          @if(!Auth::user()->isAuthor())
          <th>Owner</th>
          @endif
          <th>Category</th>
          <th>Control</th>
          <th>Created AT</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subcategories as $s)
        <tr>
          <td>{{$s->id}}</td>
          <td class="w-25">{{$s->title}}</td>
          @if(!Auth::user()->isAuthor())
          <td>{{$s->user->name}}</td>
          @endif
          <td>{{$s->category->title}}</td>
          <td>
            @can('update',$s)
            <form action="{{route('subcategory.destroy',$s->id)}}" method="post" class="d-inline-block">
              @csrf
              @method('delete')
            <button class="btn btn-outline-danger btn-sm">
              Del
            </button>
            </form>
            @endcan
            @can('update',$s)
            <a href="{{ route('subcategory.edit',$s->id) }}" class="btn btn-outline-warning btn-sm">
              Edit
            </a>
            @endcan
            @php
            if(Auth::user()->isAuthor()){
              if(Auth::id() != $s->user_id){
                echo '-';
              }
            }
            @endphp
          </td>
          <td>
            <p><i class="fa fa-calendar-alt"></i>{{$s->created_at->format('d m Y')}}</p>
            <p><i class="fa fa-clock fa-fw"></i>{{$s->created_at->format('g:m A')}}</p>
          </td>
        </tr>
        @endforeach
        <!-- @if(empty($s))
        <tr><td colspan="5" class="text-center">There is no your subcategory</td></tr>
        @endif -->
      </tbody>
    </table>
  </div>
</div>

@endsection