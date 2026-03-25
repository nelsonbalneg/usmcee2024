<?php

namespace App\Http\Middleware;

use App\Models\CeeSession;
use App\Models\Requirements;
use App\Models\StundentProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPendingApplicant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::id();

        $ceeSession = CeeSession::where('status', 'active')->first();

        if (!$ceeSession) {
            return $next($request);
        }

        $studentProfile = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $ceeSession->id)
            ->first();

        // Check requirements early
        $hasRequirements = Requirements::where('user_id', $userId)
            ->where('cee_session_id', $ceeSession->id)
            ->exists();

        // No profile at all
        if (!$studentProfile) {
            return response()->view('student.profile.incomplete-profile', [
                'hasRequirements' => false,
            ]);
        }

        // Incomplete profile
        $hasIncompleteProfile =
            $studentProfile->prereg_status === 'pending' &&
            (is_null($studentProfile->applicant_profile_status) || $studentProfile->applicant_profile_status == 0);

        if ($hasIncompleteProfile) {
            return response()->view('student.profile.incomplete-profile', [
                'hasRequirements' => $hasRequirements,
                'studentProfile' => $studentProfile,
            ]);
        }

        //NEW: No requirements uploaded → BLOCK ACCESS
        if (!$hasRequirements) {
            return response()->view('student.profile.incomplete-profile', [
                'hasRequirements' => false,
                'studentProfile' => $studentProfile,
                'message' => 'Please upload your required documents to proceed.',
            ]);
        }

        // All good → allow access
        return $next($request);
    }
}
