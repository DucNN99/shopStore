<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect("/")->with("danger","Tên đăng nhập hoặc mật khẩu không chính xác ! Vui lòng thử lại");
        }
    }
}
