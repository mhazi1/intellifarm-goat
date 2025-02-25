<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livestock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LivestockController extends Controller
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
        //
        $id = Auth::id();

        $user = User::find($id);

        if (!$id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'species' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'status' => ['required', 'string']
        ]);

        $livestock = Livestock::create([
            'species' => $request->species,
            'age' => $request->age,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livestock $livestock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livestock $livestock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livestock $livestock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livestock $livestock)
    {
        //
    }
}
