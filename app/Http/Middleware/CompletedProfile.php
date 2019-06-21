<?php

namespace App\Http\Middleware;

use Closure;

class CompletedProfile
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
        $has_completed_profile = $request->user()->profile->bio
            && $request->user()->addresses->first()->line_1;

        if (!$has_completed_profile) {
            return redirect()->route('user-profile.edit');
        }

        return $next($request);
    }
}
