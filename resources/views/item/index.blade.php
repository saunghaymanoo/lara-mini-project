@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Item List</li>
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
      <th>Item Code</th>
      <th>SubCategory</th>
      <th>Price</th>
      <th>Photo</th>
      <th>Discount</th>
      <th>Control</th>
    </thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td class="w-25">{{$item->name}}</td>
        <td>{{$item->code}}</td>
        <td>{{$item->subcategory->title}}</td>
        <td>{{$item->price}}</td>
        <td>
          @if($item->photo)
          <img src="{{ asset('storage/'.$item->photo) }}" alt="" style="width:70px;height:70px;">
          @else
          <span>No Photo</span>
          @endif
        </td>
        <td>{{$item->discount}}</td>
        <td>
          <a href="{{route('item.show',$item->id)}}" class="btn btn-sm btn-outline-info">
            <i class="bi bi-info-circle"></i>
          </a>
          @can('delete',$item)
          <form action="{{route('item.destroy',$item->id)}}" method='post' class='d-inline-block'>
            @csrf 
            @method('delete')
            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
          </form>
          @endcan
          @can('update',$item)
          <a href="{{route('item.edit',$item->id)}}" class="btn btn-sm btn-outline-warning">
            <i class="bi bi-pencil"></i>
          </a>
          @endcan
        </td>
      </tr>
      @endforeach
      @if(empty($item))
        <tr><td colspan="8" class="text-center">There is no items</td></tr>
      @endif
    </tbody>
  </table>
  <div class="">{{$items->onEachSide(1)->links()}}</div>
</div>
@endsection