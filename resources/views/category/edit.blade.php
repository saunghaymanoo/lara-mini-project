@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
       
        <div class="d-flex justify-content-between align-items-center">
            <h2>Edit Category</h2>
            <a href="{{route('category.index')}}" class="btn btn-primary btn-md rounded rounded-full"><i class="fa fa-list"></i></a>
        </div>
        <hr>
        <form action="{{route('category.update',$category->id)}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$category->title)}}">
                    @error('title')
                    <div class="text-sm text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection