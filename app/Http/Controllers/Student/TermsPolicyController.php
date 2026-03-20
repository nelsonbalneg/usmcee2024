<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TermsPolicy;
use App\Models\TermsPolicyAcceptance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsPolicyController extends Controller
{
    public function show()
    {
        $activeTermsPolicy = TermsPolicy::query()
            ->where('is_active', true)
            ->latest('id')
            ->first();

        if (!$activeTermsPolicy) {
            return redirect()->route('dashboard');
        }

        $hasAcceptedTermsPolicy = TermsPolicyAcceptance::query()
            ->where('user_id', Auth::id())
            ->where('terms_policy_id', $activeTermsPolicy->id)
            ->exists();

        if ($hasAcceptedTermsPolicy) {
            return redirect()->route('dashboard');
        }

        return view('student.terms.blocked', compact(
            'activeTermsPolicy',
            'hasAcceptedTermsPolicy'
        ));
    }

    public function accept(Request $request)
    {
        $request->validate([
            'terms_policy_id' => ['required', 'exists:terms_policies,id'],
        ]);

        TermsPolicyAcceptance::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'terms_policy_id' => $request->integer('terms_policy_id'),
            ],
            [
                'accepted_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]
        );

        return response()->json([
            'success' => true,
            'redirect' => route('dashboard'),
        ]);
    }

    public function showtoc()
    {
        $activeTermsPolicy = TermsPolicy::query()
            ->where('is_active', true)
            ->latest('id')
            ->first();

        return view('student.terms.toc', compact(
            'activeTermsPolicy',
        ));
    }
}
