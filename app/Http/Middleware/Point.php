<?php

namespace App\Http\Middleware;

use App\Enums\UserStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Point
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
        if(!Auth::user()->isPoint()){
            abort(403);
        }
        // dd(Auth::user());
        // dd(!Auth::user()->point->status != UserStatusEnum::ACTIVE->value);
        if(Auth::user()->point->status != UserStatusEnum::ACTIVE->value){
            abort(403,'تم تعطيل الحساب الرجاء الاتصال بفريق الدعم');
            return view('point.pages.point-inactive');
        }
        return $next($request);
    }
}
