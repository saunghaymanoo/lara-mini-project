@extends('layouts.backend')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Info</li>
    </ol>
</nav>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>
                        <img src="{{asset('storage/'.$user->photo)}}" style="width:50px;height:50px;" class="mb-2 rounded-full" alt="">

                        {{$user->name}}
                    </h3>
                    <a href="{{route('user.index')}}" class="btn btn-primary btn-md rounded rounded-full"><i class="fa fa-list"></i></a>
                </div>
                <hr>
                <table class="border-none">
                    <tr class="align-items-center">
                        <td><span style="font-size:22px" class="mr-5">Name:</span></td>
                        <td class="text-black-50 ">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td><span style="font-size:22px" class="mr-5">Email:</span></td>
                        <td class="text-black-50">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td><span style="font-size:22px" class="mr-5">role:</span></td>
                        <td class="text-black-50">{{$user->role}}</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection