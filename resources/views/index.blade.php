@extends('master')
@section('title') post page @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <h1>Items</h1>
        
            <form url="{{route('page.index') }}" class="my-4">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" value="{{request('keyword')}}">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form> 
            @isset($subcategory)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Filter By : {{ $subcategory->title }}</p>
                            <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
                        </div>
            @endisset
            @forelse($items as $item)     
            <div class="card my-4 p-2">
                <div class="card-body">
                    <h2>{{$item->name}}</h2>
                    
                        <a href="{{route('page.itembysubcategory',$item->sub_category_id)}}">
                            <div class="badge bg-secondary">
                            {{$item->subcategory->title}}
                            </div>
                        </a>
                        <div class="d-flex my-3">
                        @foreach($item->photos as $key=>$photo)                               
                                
                                    
                                <img src="{{asset('storage/'.$photo->name)}}" class="rounded mr-2" width="100" height="100" alt="">
                                    
                                
                            @endforeach
                            </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <i class="bi bi-person"></i><small>{{ $item->user->name }}</small><br>
                            <i class="bi bi-clock"></i><small>{{ $item->created_at->diffforHumans() }}</small>
                        </div>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body">
                    <h1>There is no items yet!</h1>
                </div>
            </div>
            @endforelse
           
        </div>
    </div>
</div>
@endsection