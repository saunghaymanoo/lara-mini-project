@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">SubCategory</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Edit SubCategory</h2>
            <a href="{{route('subcategory.index')}}" class="btn btn-primary btn-md rounded rounded-full"><i class="fa fa-list"></i></a>
        </div>
        <hr>
        <form action="{{route('subcategory.update',$subCategory->id)}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <label for="">Title:</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$subCategory->title)}}">
                    @error('title')
                    <div class="text-sm text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="">Category:</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        @foreach(App\Models\Category::all() as $c)
                        <option value="{{$c->id}}" {{$c->id==old('category',$subCategory->category_id)?'selected':''}}>
                            {{$c->title}}
                        </option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="text-sm text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col d-flex align-items-center">
                    
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection