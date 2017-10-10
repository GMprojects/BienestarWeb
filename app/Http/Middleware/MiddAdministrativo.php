<?php

namespace BienestarWeb\Http\Middleware;

use Closure;
use BienestarWeb\Persona;

class MiddAdministrativo
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
      if($request->user()->idTipoPersona == 3){
         return $next($request);
      }else{
         abort(401);
      }
    }
}
