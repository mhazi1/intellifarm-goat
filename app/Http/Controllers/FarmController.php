<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use MongoDB\Laravel\Eloquent\Casts\ObjectId;

class FarmController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id = Auth::id();

        $user = User::find($id);

        if (!$id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'name' => ['required', 'string'],
            'location' => ['required', 'string'],
        ]);

        $farm = Farm::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        $user->farms()->save($farm);

        return response()->json([
            'message' => 'Farm created successfully',
            'farm' => $farm
        ], 201);
    }

    public function store_employee(Request $request)
    {
        $id = Auth::id();

        $user = User::find($id);

        $farmId = $request->farmId;

        $farm = Farm::findOrFail($farmId);

        $farm->employees()->save($user);

        return response()->json([
            'message' => 'Employee registered to farm successfully',
            'farm' => $farm
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        //
    }
}
