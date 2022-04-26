<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('panel.index');
        }
        return view('panel.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('username'))->where('level', '<', '4')->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->withErrors(['email' => 'نام کاربری یا رمز عبور صحیح نمیباشد']);
        }

        Auth::guard('admin')->loginUsingId($user->id);
        return redirect()->route('panel.index');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('panel.login');
    }
}
