<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RestrictByRole {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string $Role): Response {
    // Public routes that anyone can access
    $publicRoutes = ['/', '/explore', '/rooms', '/about', '/contact', '/booking'];
    if (in_array($request->path(), $publicRoutes)) {
      return $next($request);
    }

    // Check if user is authenticated for protected routes
    if (!Auth::check()) {
      if ($request->is('room/*/checkout')) {
        return redirect()->route('login')->with('toast_error', 'Please login to proceed with checkout.');
      }
      return back()->with('toast_error', 'You must be logged in to access this page.');
    }

    // Get authenticated user's role
    $userRole = Auth::user()->role;

    // Admin can access everything
    if ($userRole === 'Admin') {
      return $next($request);
    }

    // Handle specific route permissions
    if ($request->is('room/*/checkout')) {
      if ($userRole === 'Customer') {
        return $next($request);
      }
      return back()->with('toast_error', 'Only customers can access checkout.');
    }

    // Admin routes - restricted to admin only
    if ($request->is('admin/*')) {
      return back()->with('toast_error', 'Only administrators can access this area.');
    }

    // Default deny access
    return back()->with('toast_error', 'You do not have permission to access this page.');
  }
}
