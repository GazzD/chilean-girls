<?php
namespace App\Http\Middleware\Admin;

use Illuminate\Support\Facades\Route;
use Closure;

class AppAuth
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        // Define public routes
        $publicRoutes = array(
            'logout',
            'sign-in',
            'password-recovery',
            'password-recovery/change-password',
            'password-recovery/message-password-changed',
            'sign-in/authenticate'
        );
        
        // Check if session contains auth information
        if (! in_array(Route::getCurrentRoute()->getName(), $publicRoutes)) {
            if (! $request->session()->has('admin.auth.admin-user.id')) {
                // Save requested url
                $requestedUrl = $request->fullUrl();
                $request->session()->put('admin.auth.requested-url', $requestedUrl);
                // Redirect to admin login page
                return redirect()->route('sign-in');
            } else {
                // Get route name
                $requestedRouteName = $request->route()->getName();
            }
        }
        // Access granted
        return $next($request);
    }
}
