<?php

namespace App\Http\Middleware;

use App\Models\TermsPolicy;
use App\Models\TermsPolicyAcceptance;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTermsAccepted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $activeTermsPolicy = TermsPolicy::query()
            ->where('is_active', true)
            ->latest('id')
            ->first();

        if (!$activeTermsPolicy) {
            return $next($request);
        }

        $hasAcceptedTermsPolicy = TermsPolicyAcceptance::query()
            ->where('user_id', Auth::id())
            ->where('terms_policy_id', $activeTermsPolicy->id)
            ->exists();

        view()->share('activeTermsPolicy', $activeTermsPolicy);
        view()->share('hasAcceptedTermsPolicy', $hasAcceptedTermsPolicy);

        if ($hasAcceptedTermsPolicy) {
            return $next($request);
        }

        if (
            $request->routeIs([
                'student.terms-policy.accept',
                'student.terms-policy.show',
                'logout',
            ])
        ) {
            return $next($request);
        }

        return redirect()->route('student.terms-policy.show');
    }
}
