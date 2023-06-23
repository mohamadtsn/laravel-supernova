<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = admin();
        if (
            !$user ||
            $user->level >= 4 ||
            (
                $user->level !== 0 &&
                $request->route()->uri !== '/' &&
                !$user->checkPermissionTo($request->method() . '-/' . $request->route()->uri)
            )
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'title' => 'دسترسی غیرمجاز',
                    'text' => 'شما مجوز دسترسی به این صفحه/عملیات را ندارید!',
                    'type' => 'error',
                ], Response::HTTP_FORBIDDEN);
            }

            alert()->error('درخواست غیرمجاز', 'شما مجوز دسترسی به این صفحه/عملیات را ندارید!');
            return redirect()->route('panel.index');
        }
        return $next($request);
    }
}
