<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Term;
use App\User;

class EnsureLastTermsIsAccepted {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $term = Term::orderBy('published_at', 'desc')->take(1)->get()->first();
        $user = $request->user();

        if ($term->id != $user->getAcceptedTermsId()) {
            Session::flash('terms', ['current' => $term->id, 'old' => $request->user()->getAcceptedTermsId()]);
        }

        return $next($request);
    }

}
