<?php

namespace BienestarWeb\Http\Middleware;

use Closure;

class MiddProgramador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next)
   {    if($request->user()->funcion == 2 || $request->user()->funcion == 3 ){
         return $next($request);
       }else{
         abort(401);
       }
   }
}
