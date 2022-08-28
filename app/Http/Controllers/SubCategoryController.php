<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q -> orWhere('title',"like","%$keyword%");
        })
        // ->when(Auth::user()->role === 'author',fn($q)=>$q->where('user_id',Auth::id()))
        ->latest('id')->get();
        return view('subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $subcategory = new SubCategory();
        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category;
        $subcategory->user_id = Auth::id();
        $subcategory->save();
        return redirect()->route('subcategory.index')->with('status','insert is successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($subcategory)
    {
        $subCategory = SubCategory::findOrFail($subcategory);
        Gate::authorize('update',$subCategory);
        return view('subcategory.edit',compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCategoryRequest  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory,$subcategory)
    {
        $subCategory = SubCategory::findOrFail($subcategory);
        Gate::authorize('update',$subCategory);

        $subCategory->title = $request->title;
        $subCategory->category_id = $request->category;
        $subCategory->user_id = Auth::id();
        $subCategory->update();
        return redirect()->route('subcategory.index')->with('status','update is successful!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory,$subcategory)
    {
        $subCategory = SubCategory::findOrFail($subcategory);
        Gate::authorize('delete',$subCategory);

        $subCategory->delete();
        return redirect()->route('subcategory.index')->with('status','delete is successful!');
        
    }
}
