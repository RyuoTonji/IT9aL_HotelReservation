<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestrictByRole {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$roles): Response {
    if (!Auth::check()) {
      return redirect()->route('home')->with(['toast_error' => 'You must login first.']);
      // abort(403, 'Unauthorized action.');
    }

    if (Auth::user()->Role !== 'Admin' && !in_array(Auth::user()->Role, $roles)) {
      return redirect()->route('home')->with(['toast_error' => 'Unauthorized action.']);
      // abort(403, 'Unauthorized action.');
    }
    return $next($request);
  }
}
