<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIFUserManPower
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
        if (auth('seller')->check()){
            $cats = auth('seller')->user()->cat_id;
            foreach (json_decode($cats) as $cat){
                if ($cat == 4){
                    return $next($request);
                }
            }
            return redirect()->back();
        }else{
            return redirect(route('seller.show.login'));
        }
    }
}
