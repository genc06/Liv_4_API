<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

        ]);

        $item = new Item;
        $item->name = $validatedData['name'];
        $item->description = $validatedData['description'];
        $item->latitude = $validatedData['latitude'];
        $item->longitude = $validatedData['longitude'];
        $item->type = $request->type;
        $item->save();

        return response()->noContent();
    }


    public function getLostItems()
    {
        $lostItems = Item::where('type', 'Objet perdu')->get();
        return response()->json($lostItems);
    }

    public function getFoundItems()
    {
        $foundItems = Item::where('type', 'Objet trouvé')->get();
        return response()->json($foundItems);
    }

    // All items with status active
    public function index()
    {
        return Item::where('status', 'active')->get();
    }
}
