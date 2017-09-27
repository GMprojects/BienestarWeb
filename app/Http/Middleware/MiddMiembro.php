<?php

namespace BienestarWeb\Http\Middleware;

use Closure;

class MiddMiembro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {    $persona = (Persona::where('email', $request->user()->email)->get())[0];
          if($persona->funcion == 1){
             return $next($request);
          }else{
             abort(401);
          }
     }
}
