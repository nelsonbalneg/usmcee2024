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


    // public function handle(Request $request, Closure $next)
    // {
    //     $userId = Auth::id();

    //     $ceeSession = CeeSession::where('status', 'active')->first();

    //     if (!$ceeSession) {
    //         return $next($request);
    //     }

    //     $studentProfile = StundentProfile::where('user_id', $userId)
    //         ->where('preregistration_id', $ceeSession->id)
    //         ->first();

    //     // ✅ New account / no profile yet = do not block
    //     if (!$studentProfile) {
    //         return $next($request);
    //     }

    //     $requirements = Requirements::where('user_id', $userId)
    //         ->where('cee_session_id', $ceeSession->id)
    //         ->first();

    //     $hasRequirements = !is_null($requirements);

    //     // 1. Block first if profile exists but is incomplete
    //     $isIncompleteProfile =
    //         $studentProfile->prereg_status === 'pending' &&
    //         (is_null($studentProfile->applicant_profile_status) || $studentProfile->applicant_profile_status == 0);

    //     if ($isIncompleteProfile) {
    //         return response()->view('student.profile.incomplete-profile', [
    //             'hasRequirements' => $hasRequirements,
    //             'studentProfile' => $studentProfile,
    //             'blockType' => 'profile',
    //         ]);
    //     }

    //     // 2. Block only if profile exists but requirements are missing
    //     if (!$hasRequirements && $isIncompleteProfile) {
    //         return response()->view('student.profile.incomplete-profile', [
    //             'hasRequirements' => false,
    //             'studentProfile' => $studentProfile,
    //             'blockType' => 'requirements',
    //         ]);
    //     }

    //     return $next($request);
    // }

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

        // ✅ New account = no blocking
        if (!$studentProfile) {
            return $next($request);
        }

        $requirements = Requirements::where('user_id', $userId)
            ->where('cee_session_id', $ceeSession->id)
            ->first();

        $hasRequirements = !is_null($requirements);

        // ✅ 1. Incomplete Profile (Draft / Not Published)
        $isIncompleteProfile =
            $studentProfile->prereg_status === 'pending' &&
            (is_null($studentProfile->applicant_profile_status) || $studentProfile->applicant_profile_status == 0);

        if ($isIncompleteProfile) {
            return response()->view('student.profile.incomplete-profile', [
                'hasRequirements' => $hasRequirements,
                'studentProfile' => $studentProfile,
                'blockType' => 'profile',
            ]);
        }

        // ✅ 2. NEW CONDITION: Published BUT no requirements
        $isPublishedNoRequirements =
            $studentProfile->applicant_profile_status == 1 &&
            !$hasRequirements;

        if ($isPublishedNoRequirements) {
            return response()->view('student.profile.incomplete-profile', [
                'hasRequirements' => false,
                'studentProfile' => $studentProfile,
                'blockType' => 'requirements',
            ]);
        }

        return $next($request);
    }
}
