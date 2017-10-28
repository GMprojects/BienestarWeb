<?php

namespace BienestarWeb\Http\Middleware;

use Closure;

class MiddAlumno
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
      if($request->user()->idTipoPersona == 1){
         return $next($request);
      }else{
         abort(401);
      }
    }
}
