<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class SuperAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        If(!App('Illuminate\Contracts\Auth\Guard')->guest()){
            $role= User::getRole(Auth::user()->id);
            $result=false;
            if(count($role)>1)
            {
                foreach ($role as $r) {
                    if($r->id==1)
                    {
                        $result= true;
                    }
                }

            }elseif($role[0]->id==1){
                $result=true;
            }

            if($result){
                return $next($request);
            }else{
                return response(view('user::user_access.unauthorized')->render());
            }
        }
    }
}
