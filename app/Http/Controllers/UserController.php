<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $users = User::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere('name','like',"%$keyword%")
            ->orWhere('email','like',"%$keyword%");
        })
        ->when(Auth::user()->role !== 'admin',fn($q)=>$q->where('id',Auth::id()))
        ->latest('id')->paginate(7);
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(403);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show',compact('user')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::findOrFail($id);
        // dd(Auth::user()->id);
       
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'role' => 'required',
            'photo' => "nullable|mimes:jpeg,png,jpg|file|max:512"
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if($request->photo){
            if($user->photo != 'user.png'){
                Storage::delete("public/".$user->photo);
            }
            $newN = uniqid()."_photo_".$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$newN);
            $user->photo = $newN;
        }else{
            $newN = $request->oldphoto;
        }
        $user->photo = $newN;
        $user->update();
        return redirect()->route('user.index')->with('status','update is successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->photo != 'user.png'){
            Storage::delete("public/".$user->photo);
        }
        $user->delete();
        return redirect()->route('user.index')->with('status','delete is successful');

    }
}
