<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.login_page');
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
    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd($request->all);
        // dd($user);

        if (empty($user)) {
            return back()->withInput($request->only('email'))->withErrors(['email' => 'No user found with this email address.']);
        }
        if (password_verify($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect()->intended(route('product.index'));
        }

        return back()->withInput($request->only('email'))->withErrors(['password' => 'Incorrect password.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
}
