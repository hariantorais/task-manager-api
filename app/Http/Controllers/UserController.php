<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('role', 'member')->get();
        return response()->json([
            'data' => $user
        ]);
    }

    public function search(Request $request)
    {
        $user = User::whereDoesntHave('cards', function ($query) use ($request) {
            $query->where('cards.id', $request->cardId);
        })
        ->where('name', 'like', '%' . $request->search . '%')->get();
        if ($user){
            $data = ['data' => $user];
        } else {
            $data = ['message' => 'No data found'];
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        } else {
            return response()->json([
                'data' => $user
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        } else {
            $user->update($request->all());
            return response()->json([
                'data' => $user
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        } else {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully'
            ]);
        }

    }
}
