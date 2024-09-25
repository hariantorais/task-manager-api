<?php

namespace App\Http\Controllers;

use App\Models\CardUser;
use Illuminate\Http\Request;

class CardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getCardMembers($id)
    {
        $cardMembers = CardUser::where('card_id', $id)->get();
        if ($cardMembers) {
            $data = ['data' => $cardMembers];
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
        CardUser::create([
           'user_id' => $request->userId,
           'card_id' => $request->cardId
        ]);

        return response()->json([
            'message' => 'Card User created'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteMember(Request $request)
    {
        $cardMember = CardUser::where('user_id', $request->memberId)->where('card_id', $request->cardId)->first();
        if (!$cardMember) {
            return response()->json([
                'message' => 'Card member not found'
            ], 404);
        }

        $cardMember->delete();
        return response()->json([
            'message' => 'Card member deleted'
        ], 200);
    }
}
