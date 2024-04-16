<?php


namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'item_id' => 'required',
        ]);

        $message = Message::create($request->all());

        return response()->json($message, 201);
    }

    public function history($id)
    {
        $messages = Message::where('item_id', $id)->with('user')->get();
        return response()->json($messages);
    }
}
