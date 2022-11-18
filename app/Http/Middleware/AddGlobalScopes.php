<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Yadda\Enso\Facades\EnsoCrud;

class AddGlobalScopes
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
        EnsoCrud::modelClass('class')::addGlobalScope(new \App\Models\Scopes\FrontendClassScope);
        EnsoCrud::modelClass('location')::addGlobalScope(new \App\Models\Scopes\FrontendLocationScope);
        EnsoCrud::modelClass('trainer')::addGlobalScope(new \App\Models\Scopes\FrontendTrainerScope);

        return $next($request);
    }
}
