<?php

namespace App\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;

class HasPermission
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
        
        if($this->hasPermission($request)) {

            return $next($request);
        }

        Flash::warning("You have no permission to access the page.");

        return back();
    }

    protected function hasPermission ($request)
    {
        $route_name = $request->route()->getName();

        if ($route_name && $route_name != 'dashboard') {
            $route_name = $request->route()->getName();

            $name = explode('.', $route_name)[0];
            $verb = explode('.', $route_name)[1];

            if ($verb == 'store' || $verb == 'create') {

                return $request->user()->hasPermissionTo('create-' . str_singular($name));

            } elseif ($verb == 'show' || $verb == 'edit' || $verb == 'update' || $verb == 'index') {

                return $request->user()->hasPermissionTo('update-' . str_singular($name));

            } elseif ($verb == 'destroy') {

                return $request->user()->hasPermissionTo('delete-' . str_singular($name));
            }
        }

        return true;
    }
}
