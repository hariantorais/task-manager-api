<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $lastPosition = Card::where('task_list_id', $request->taskListId)->max('position');

        $card = Card::create([
            'title' => $request->title,
            'task_list_id' => $request->taskListId,
            'position' => $lastPosition + 1
        ]);

        return response()->json([
            'data' => $card,
            'message' => 'Card added successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return response()->json(null, 204);
    }

    public function update($id, Request $request)
    {
        $card = Card::findOrFail($id);
        $card->update([
            'title' => $request->title
        ]);

        return response()->json([
            'data' => $card
        ],200);
    }

    public function move($id, Request $request)
    {
        $card = Card::findOrFail($id);
        $card->update([
            'task_list_id' => $request->newListId
        ]);

        return response()->json([
            'data' => $card,
            'message' => 'Card moved successfully'
        ]);
    }

}
