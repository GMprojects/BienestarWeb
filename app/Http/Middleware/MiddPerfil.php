<?php

namespace BienestarWeb\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class MiddPerfil
{
   /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
   public function handle(Request $request, Closure $next) {
      dd($request);
      //if($request->user()->id == $request->id ){
       return $next($request);
      //}else{
      //   abort(401);
      //}
   }
}
