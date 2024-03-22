<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile', ['user' => $user]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $profilePage) 
    {
        $user = User::find($profilePage);
        return view('admin.profile', compact('user')); 
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $profilePage)  
    {
        $user = User::find($profilePage);
        return view('login.edit_profile', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, string $profilePage) 
    {
        $user = User::find($profilePage);
        // dd($profilePage);
    
        $user->update($request->all());
        Log::info('User Updated');
        return response()->json(['success' => true, 'message' => 'Profile Updated !! ']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $profilePage)
    {
    }
}
