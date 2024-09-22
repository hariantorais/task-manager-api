<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\TaskList;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // Create new board
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $board = Board::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        $lists = ['Todo', 'In Progress', 'Done'];
        foreach ($lists as $list){
            TaskList::create([
                'name' => $list,
                'board_id' => $board->id
            ]);
        }

        return response()->json($board, 201);
    }

    public function update($id, Request $request)
    {
        $board = Board::findOrFail($id);
        $board->update([
            'name' => $request->name
        ]);

        return response()->json([
            'data' => $board
        ]);
    }

    // Get all boards
    public function index()
    {
        $boards = Board::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $boards
        ], 200);
    }

    public function show($id)
    {
        $board = Board::with('lists', 'lists.cards')->findOrFail($id);

        if ($board->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'data' => $board,
            'message' => 'Board retrieved successfully'
        ]);
    }

    // Delete a board
    public function destroy($id)
    {
        $board = Board::findOrFail($id);

        foreach ($board->lists as $list) {
            foreach ($list->cards as $card) {
                $card->delete();
            }
            $list->delete();
        }

        $board->delete();

        return response()->json([
            'message' => 'Board deleted successfully'
        ]);
    }
}
