@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('item.index')}}">Items</a></li>
        <li class="breadcrumb-item active" aria-current="page">Item Details</li>
    </ol>
</nav>
<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{Str::words($item->name,7)}}</h3>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="{{route('item.create')}}" class="text-primary pr-2"><i class="bi bi-plus-circle" style="font-size: 2rem;"></i></a>
                    <a href="{{route('item.index')}}" class="btn btn-primary rounded btn-md px-1 py-0"><i class="bi bi-list" style="font-size: 1.5rem;"></i></a>
                    </div>
                </div>
                <hr>
                <div class="">
                    <span class="bradge bg-secondary text-light rounded">{{App\Models\SubCategory::find($item->sub_category_id)->title}}</span>
                    <span class="bradge bg-secondary text-light rounded">{{$item->price}}</span>
                    @if($item->discount)
                    <span class="bradge bg-secondary text-light rounded">{{$item->discount}}</span>
                    @endif
                </div>
                @if($item->photo)
                <img src="{{asset('storage/'.$item->photo)}}" class="w-75 mt-3" alt="">
               
                @endif
               
            </div>
        </div>
    </div>
</div>
@endsection