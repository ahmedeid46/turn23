<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->segment(1) == 'admin'){
                return route('admin.show.login');
            }
            if ($request->segment(1) == 'supplier'){
                return route('seller.show.login');
            }
           return route('customer.show.login');
        }
    }
}
