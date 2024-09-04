<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function verifyEmails()
    {
        $user = Auth::user();
        $verifyURL = URL::temporarySignedRoute( 'user.verify', now()->addMinutes(1), ['id' => $user->id]);

        // Kiểm tra xem người dùng đã xác minh email chưa
        Mail::to($user->email)->send(new VerifyEmail($user, $verifyURL));

        return response()->json(['success' => true, 'message' => ' Verification emails sent! ']);
    }

    public function verify($id)
    {
        $user = User::where('id', $id)->whereNULL('email_verified_at')->firstOrFail();
        $user->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        // $user->markEmailAsVerified();

        return redirect()->route('loginPage')->with('success', 'Email verified successfully!');
    }































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
