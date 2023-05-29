<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Kiểm tra xem user đang đăng nhập có phải admin hay không, nếu không thì không cho vào
        if (!auth()->check())   //Kiểm tra xem có đăng nhập hay chưa?
            return redirect()->to("/login");
        $u = auth()->user();    //Lấy tài khoản đang đăng nhập
        if ($u->role != "admin")
            return abort(404);
        return $next($request);
    }
}
