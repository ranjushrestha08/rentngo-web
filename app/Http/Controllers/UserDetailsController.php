<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info['user'] = User::findOrFail($id);
        return view('users.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info['user'] = User::findOrFail($id);
        return view('users.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //add validation here
        $request->validate([

        ]);
        $data = $request->all();
        $User = User::findOrFail($id);
        $User->update($data);
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
