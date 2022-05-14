<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('panel.index');
        }
        return view('admin-panel.pages.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->get('username'))->where('level', '<', '4')->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return back()->withErrors(['username' => 'نام کاربری یا رمز عبور صحیح نمی باشد.']);
        }

        if ($user->status !== 'active') {
            alert()->error('تعلیق حساب کاربری', 'حساب کاربری شما تعلیق یا غیرفعال شده است. برای کسب اطلاعات بیشتر با پشتیبانی تماس بگیرید.')->showConfirmButton('متوجه شدم!');
            return back();
        }

        Auth::guard('admin')->loginUsingId($user->id);
        return redirect()->route('panel.index');
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('panel.login');
    }
}
