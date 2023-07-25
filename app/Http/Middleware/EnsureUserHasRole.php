<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Traits\HasRoles;
 
class EnsureUserHasRole
{
    use HasRoles;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string $role): Response
    {
        dd($request->user()->hasRole($role));
        if (! $request->user()->hasRole($role)) {
            abort(403);

        }
 
        return $next($request);
    }
 
}