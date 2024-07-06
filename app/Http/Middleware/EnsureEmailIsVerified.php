<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next)
     {
         if ($request->user() && !$request->user()->hasVerifiedEmail() && !$this->isEmailVerificationRoute($request)) {
             return $request->expectsJson()
                 ? abort(403, 'Ваш адрес электронной почты не подтвержден.')
                 : redirect()->route('verification.form');
         }

         return $next($request);
     }

     protected function isEmailVerificationRoute(Request $request)
     {
         return $request->is('email/*', 'logout');
     }


}
