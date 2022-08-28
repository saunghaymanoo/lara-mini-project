@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('item.index')}}">Items</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
  </ol>
</nav>
<div class="row">
  <div class="col-lg-7">
  <div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Edit Item</h2>
      <a href="{{route('item.index')}}" class="btn btn-primary btn-md rounded rounded-full"><i class="fa fa-list"></i></a>
    </div>
    <hr>
    <form action="{{route('item.update',$item->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="">
        <div class="form-group mb-4">
          <label for="">Item Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$item->name)}}">
          @error('name')
          <div class="text-sm text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="form-group mb-4">
          <label for="">Item Code</label>
          <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code',$item->code)}}">
          @error('code')
          <div class="text-sm text-danger">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group mb-4">
          <label for="">Sub Category</label>
          <select name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror">
            @foreach(App\Models\SubCategory::all() as $sc)
            <option value="{{$sc->id}}" {{$sc->id==old('subcategory',$item->sub_category_id)?'selected':''}}>
              {{$sc->title}}
            </option>
            @endforeach
          </select>
          @error('subcategory')
          <div class="text-sm text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mb-3">
        <div class="mb-2 d-flex position-relative">
            @foreach($item->photos as $photo)
              
              <img src="{{asset('storage/'.$photo->name)}}" height="100" width="100" class="rounded" alt="">
        
              <form action="{{route('photo.destroy',$photo->id)}}" method="post" class="d-inline-block">
              @csrf
              @method('delete')
              <button class="btn btn-outline-danger btn-sm position-absolute bottom-0 left-0 z-20 me-2">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            
           
            @endforeach
        </div>
        <div>

        <div class="row border border-1 p-2 rounded mb-3">
          <div class="col-7">
            <label for="">Item Price</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$item->price)}}">
            @error('price')
            <div class="text-sm text-danger">{{$message}}</div>
            @enderror
          </div>
          <div class="col-5">
            <label for="">Discount</label>
            <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror" value="{{old('discount',$item->discount)}}">
            @error('discount')
            <div class="text-sm text-danger">{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="form-group my-4">
         
          <div class="d-flex align-items-end">
          @if($item->photo)
                <img src="{{asset('storage/'.$item->photo)}}" class="mr-2 rounded-pill" width="70" height="70" alt="">
                <input type="hidden" name="oldphoto" value="{{old('photo',$item->photo)}}">
          @endif
          <div>
          <label for="">Feature Photo</label>
          <input type="file" name="photo" class="p-1 form-control @error('photo') is-invalid @enderror">
          @error('photo')
          <div class="text-sm text-danger">{{$message}}</div>
          @enderror
          </div>
          </div>
         
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