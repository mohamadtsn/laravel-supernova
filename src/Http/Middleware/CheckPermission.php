<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('admin')->user();
        if (
            !$user ||
            $user->level >= 4 ||
            (
                $user->level !== 0 &&
                $request->route()->uri !== '/' &&
                !$user->checkPermissionTo($request->method() . '-/' . $request->route()->uri)
            )
        ) {
            toastr()->error('شما مجوز دسترسی به این صفحه/عملیات را ندارید!');
            return redirect()->route('panel.index');
        }
        return $next($request);
    }
}
