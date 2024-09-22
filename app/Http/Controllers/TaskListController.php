<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function store(Request $request, $boardId)
    {
        $list = TaskList::create([
            'name' => $request->name,
            'board_id' => $boardId,
        ]);

        return response()->json($list, 201);
    }

    public function update($id, Request $request)
    {
        $list = TaskList::findOrFail($id);
        $list->update([
            'name' => $request->name
        ]);
    }

    public function destroy($id)
    {
        $list = TaskList::findOrFail($id);
        $list->delete();

        return response()->json(null, 204);
    }

    public function index()
    {
        $lists = TaskList::with('cards')->get();

        return response()->json([
            'data' => $lists
        ]);
    }
}
