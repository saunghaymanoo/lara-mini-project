<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $items = Item::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q -> orWhere('name',"like","%$keyword%");
        })
        ->latest('id')
        ->with(['subcategory','user'])
        ->paginate(7)->withQueryString();
        return view('index',compact('items'));
    }

    public function itembysubcategory($id){
        $subcategory = SubCategory::findOrFail($id);
        
        $items = Item::where(function ($q){
            $q->when(request('keyword'),function($q){
                $keyword = request('keyword');
                $q->orWhere("name","like","%$keyword%");
            });
        })
        ->where("sub_category_id",$id)
        ->latest("id")
        ->with(['user','subcategory'])
        ->paginate(10)
        ->withQueryString();
        return view('index',compact('items','subcategory'));

    }
    
}
