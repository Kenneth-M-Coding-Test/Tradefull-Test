<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('item')->with([
            'items' => Item::get()
        ]);
    }

    public function show($id)
    {
        $item = $id ? Item::find($id) : new Item;
        return view('item-edit')->with([
            'item' => $item
        ]);
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
    }

    public function create() 
    {
        return $this->show(0);
    }

    public function update(Request $request)
    {
        $itemData = $request->get('item');

        $item = $itemData['id'] == '0' ? New Item : Item::find($itemData['id']);
        $item->name = $itemData['name'];
        $item->price = $itemData['price'];
        $item->save();
    }
}
