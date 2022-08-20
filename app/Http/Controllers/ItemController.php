<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->orWhere('name', "like", "%$keyword%");
        })
            ->latest('id')->paginate(5)->withQueryString();
        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->code = $request->code;
        $item->sub_category_id = $request->subcategory;
        $item->price = $request->price;
        if ($request->photo) {
            $newN = uniqid() . "_photo_" . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs("public", $newN);
            $item->photo = $newN;
        }
        if ($request->discount) {
            $item->discount = $request->discount;
        }

        $item->save();
        return redirect()->route('item.index')->with('status', 'insert successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {

        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->code = $request->code;
        $item->sub_category_id = $request->subcategory;
        $item->price = $request->price;
        if ($request->photo) {
            if ($request->file('photo')) {
                Storage::delete('public/' . $item->photo);

                $newN = uniqid() . "_photo_" . $request->file('photo')->getClientOriginalName();
                $request->file('photo')->storeAs("public", $newN);
            } else {
                $newN = $request->oldphoto;
            }

            $item->photo = $newN;
        }
        if ($request->discount) {
            $item->discount = $request->discount;
        }

        $item->update();
        return redirect()->route('item.index')->with('status', 'update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('status', 'delete successful');

    }
}
