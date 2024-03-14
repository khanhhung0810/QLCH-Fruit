<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        return view('login.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        // $data = $request->all();
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('loginPage')->with('success', 'Đăng ký thành công');
    }



    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session(['name' => Auth::user()->name]);
            return redirect()->route('product.index')->with('message', 'Đăng nhập thành công');
        } else {
            return back()->with('login_error', 'Email hoặc mật khẩu không đúng');
        }
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
