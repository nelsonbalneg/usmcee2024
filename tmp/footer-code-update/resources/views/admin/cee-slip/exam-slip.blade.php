<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USMCEE Examination Slip - {{ $cee_reservation->app_no }}</title>
    <style>
        @page { size: A4 portrait; margin: .42in .45in .5in; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: DejaVu Sans, sans-serif; font-size: 7.65pt; line-height: 1.4; color: #263832; }
        table { width: 100%; border-collapse: collapse; table-layout: auto; }
        td { vertical-align: top; }
        p { margin: 0; }
        .masthead { border-bottom: 1.8px solid #17604b; padding-bottom: 8.1px; }
        .masthead td { vertical-align: middle; }
        .seal-cell { width: 61.2px; }
        .seal { width: 52.2px; height: 52.2px; }
        .eyebrow { font-size: 5.85pt; letter-spacing: 0.9px; text-transform: uppercase; color: #65756e; }
        .university { font-size: 12.6pt; font-weight: bold; color: #174d3d; line-height: 1.3; }
        .office { font-size: 6.75pt; margin-top: 2.7px; }
        .location { font-size: 6.3pt; color: #65756e; }
        .document-heading { margin: 9.9px 0; }
        .document-heading td { vertical-align: middle; }
        .document-heading .title-cell { width: 55%; padding-right: 10.8px; }
        .document-title { font-size: 19.8pt; line-height: 1.15; font-weight: bold; color: #174d3d; margin: 2.7px 0 3.6px; }
        .subtitle { font-size: 7.2pt; color: #65756e; }
        .reference { text-align: right; border-left: 0.9px solid #d4ded8; padding-left: 10.8px; }
        .reference-number { font-size: 16.2pt; line-height: 1.3; font-weight: bold; color: #174d3d; word-wrap: break-word; }
        .reference-number.legacy { font-size: 9pt; }
        .reference-note { font-size: 6.03pt; margin-top: 2.7px; color: #65756e; }
        .schedule { border-top: 2.7px solid #b49a4e; background: #f0f5f2; margin-bottom: 7.2px; }
        .schedule td { padding: 7.2px 10.8px; width: 36%; }
        .schedule td + td { border-left: 0.9px solid #d4ded8; }
        .schedule .room-cell { width: 28%; }
        .label { font-size: 6.03pt; letter-spacing: 0.54px; text-transform: uppercase; color: #65756e; }
        .schedule-value { font-size: 9.45pt; font-weight: bold; color: #174d3d; margin-top: 4.5px; line-height: 1.4; }
        .section { margin-top: 9.9px; page-break-inside: avoid; }
        .section-title { border-bottom: 0.9px solid #d4ded8; padding-bottom: 5.4px; margin-bottom: 7.2px; font-size: 7.2pt; font-weight: bold; letter-spacing: 0.45px; color: #174d3d; text-transform: uppercase; }
        .section-number { color: #8b773d; padding-right: 7.2px; }
        .photo-cell { width: 97.2px; padding-right: 12.6px; }
        .photo { width: 82.8px; height: 82.8px; border: 0.9px solid #d4ded8; }
        .photo-label { font-size: 5.4pt; color: #65756e; margin-top: 3.6px; }
        .identity { padding-right: 12.6px; }
        .applicant-name { font-size: 10.8pt; line-height: 1.35; font-weight: bold; color: #172f25; margin: 2.7px 0 8.1px; word-wrap: break-word; }
        .identity-details td { padding-bottom: 2.7px; font-size: 7.2pt; }
        .field-label { width: 74.7px; color: #65756e; }
        .field-value { word-wrap: break-word; }
        .qr-cell { width: 77.4px; text-align: center; border-left: 0.9px solid #e0e6e2; padding-left: 9px; }
        .qr { width: 66.6px; height: 66.6px; }
        .qr-caption { font-size: 5.4pt; color: #65756e; margin-top: 2.7px; line-height: 1.4; }
        .notice { border-left: 2.7px solid #b49a4e; padding: 5.4px 9.9px; background: #faf9f3; font-size: 7.2pt; margin-top: 9px; line-height: 1.5; }
        .notice strong { color: #174d3d; }
        .requirements td { padding: 1.8px 0; line-height: 1.3; border-bottom: 0.9px solid #edf0ee; font-size: 7.38pt; }
        .requirements .check-cell { width: 22.5px; vertical-align: middle; }
        .requirement-checkbox { display: inline-block; width: 8.1px; height: 8.1px; border: 0.9px solid #65756e; background: #ffffff; }
        .signature-table { margin-top: 7.2px; }
        .signature-table td { width: 50%; padding-right: 22.5px; }
        .signature-table td + td { padding-right: 0; padding-left: 22.5px; }
        .signature-space { height: 20.7px; border-bottom: 0.9px solid #8d9e94; }
        .signature-label { font-size: 6.3pt; color: #65756e; padding-top: 4.5px; }
        .cut-line { margin: 9px 0 6.3px; border-top: 0.9px dashed #9caea3; text-align: center; padding-top: 4.5px; font-size: 5.4pt; letter-spacing: 0.9px; text-transform: uppercase; color: #65756e; }
        .stub { border: 0.9px solid #cbd7cf; page-break-inside: avoid; }
        .stub-heading { background: #f0f5f2; padding: 5.4px 9.9px; border-bottom: 0.9px solid #cbd7cf; }
        .stub-heading td { vertical-align: middle; }
        .stub-title { color: #174d3d; font-weight: bold; font-size: 8.1pt; }
        .stub-kicker { text-align: right; font-size: 5.85pt; color: #65756e; }
        .stub-body { padding: 7.2px 9.9px; }
        .stub-info { padding-right: 13.5px; }
        .stub-name { font-size: 9pt; font-weight: bold; margin: 2.7px 0 4.5px; word-wrap: break-word; }
        .stub-number { font-weight: bold; color: #174d3d; word-wrap: break-word; }
        .stub-details td { padding: 1.8px 0; font-size: 6.75pt; }
        .stub-note { font-size: 5.85pt; color: #65756e; margin-top: 7.2px; }
        .stub .signature-table { margin-top: 2.7px; }
        .stub .signature-space { height: 16.2px; }
        .stub .signature-label { font-size: 5.85pt; }
        .footer { position: fixed; bottom: -22px; left: 0; right: 0; border-top: 0.9px solid #d4ded8; padding-top: 4.5px; font-size: 5.4pt; color: #65756e; }
        .footer td + td { text-align: right; }
        .page-break { page-break-before: always; }
        .map-heading { margin: 9.9px 0; }
        .map-title { font-size: 16.2pt; font-weight: bold; color: #174d3d; margin: 2.7px 0; }
        .map-image { max-width: 100%; max-height: 8.6in; }
        .map-frame { border: 0.9px solid #d4ded8; padding: 9px; text-align: center; }
</style>
</head>
<body>
    @php
        $appNo = (string) $cee_reservation->app_no;
        $checkCode = $cee_reservation->checksum ?? 'N/A';
        $fullName = mb_strtoupper(trim($cee_reservation->lastname . ', ' . $cee_reservation->firstname . ' ' .
            ($cee_reservation->middlename ?? '') . ' ' . ($cee_reservation->suffix ?? '')));
        $examDate = $cee_reservation->schedule
            ? \Carbon\Carbon::parse($cee_reservation->schedule)->format('F j, Y') : 'To be announced';
        $applicantType = in_array((string) $cee_reservation->is_repeat_exam, ['Yes', '1'], true)
            ? 'Retaker' : 'First Time Taker';
        $photoPath = public_path($cee_reservation->photo ?? '');
        $photoSource = is_file($photoPath) ? $photoPath :
            (!empty($cee_reservation->photo) ? config('academic.photo_url') . basename($cee_reservation->photo) : null);
        $mapPath = public_path('backend/assets/images/map/' . \Illuminate\Support\Str::lower($cee_reservation->map_file ?? '') . '.png');
    @endphp

    <div class="footer">
        <table><tr>
            <td>USMCEE Reservation System | Powered by UICTO</td>
            <td>Downloaded {{ now('Asia/Manila')->format('M j, Y g:i A') }} <span class="footer-reference">{{ $checkCode }}</span></td>
        </tr></table>
    </div>

    <div class="masthead">
        <table><tr>
            <td class="seal-cell"><img class="seal" src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" alt="USM seal"></td>
            <td>
                <div class="eyebrow">Republic of the Philippines</div>
                <div class="university">University of Southern Mindanao</div>
                <div class="office">UNIVERSITY TEST DEVELOPMENT CENTER</div>
                <div class="location">Kabacan, Cotabato</div>
            </td>
        </tr></table>
    </div>

    <table class="document-heading"><tr>
        <td class="title-cell">
            <div class="eyebrow">College Entrance Examination / USMCEE</div>
            <div class="document-title">Examination Slip</div>
            <div class="subtitle">Official applicant copy</div>
        </td>
        <td class="reference">
            <div class="label">Application number</div>
            <div class="reference-number {{ strlen($appNo) > 12 ? 'legacy' : '' }}">{{ $appNo }}</div>
            <div class="reference-note">Reserved examination slot</div>
        </td>
    </tr></table>

    <table class="schedule"><tr>
        <td><div class="label">Examination date</div><div class="schedule-value">{{ $examDate }}</div></td>
        <td><div class="label">Examination time</div><div class="schedule-value">{{ $cee_reservation->time }}</div></td>
        <td class="room-cell"><div class="label">Assigned room</div><div class="schedule-value">{{ $cee_reservation->room_name }}</div></td>
    </tr></table>

    <div class="section">
        <div class="section-title"><span class="section-number">01</span> Applicant details</div>
        <table><tr>
            <td class="photo-cell">
                @if($photoSource)
                    <img class="photo" src="{{ $photoSource }}" alt="Applicant photo">
                @else
                    <div class="photo"></div>
                @endif
                <div class="photo-label">APPLICANT PHOTO</div>
            </td>
            <td class="identity">
                <div class="label">Applicant name</div>
                <div class="applicant-name">{{ $fullName }}</div>
                <table class="identity-details">
                    <tr><td class="field-label">Applicant type</td><td class="field-value">{{ $applicantType }}</td></tr>
                    <tr><td class="field-label">Test session</td><td class="field-value">{{ $cee_reservation->exam_session }}</td></tr>
                    <tr><td class="field-label">Testing venue</td><td class="field-value">{{ $cee_reservation->campus }}<br>{{ $cee_reservation->college_name }} / {{ $cee_reservation->room_name }}</td></tr>
                </table>
            </td>
            <td class="qr-cell"><img class="qr" src="{{ $qrCodeUrl }}" alt="Applicant verification QR code"><div class="qr-caption">APPLICANT<br>VERIFICATION</div></td>
        </tr></table>
    </div>

    <div class="notice"><strong>Present this slip on examination day.</strong> Bring one (1) valid identification card together with this printed document for verification.</div>

    <div class="section">
        <div class="section-title"><span class="section-number">02</span> Examination-day requirements</div>
        <table class="requirements">
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>Printed examination slip generated after successful reservation</td></tr>
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>One (1) valid ID: Government-issued ID, High School ID, Company ID, or National ID</td></tr>
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>Personal ballpen (not sign pen)</td></tr>
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>Pencil and sharpener</td></tr>
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>Snacks and water in non-single-use plastic containers or tumbler</td></tr>
            <tr><td class="check-cell"><span class="requirement-checkbox"></span></td><td>Transparent bag or envelope for personal items</td></tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title"><span class="section-number">03</span> Acknowledgment</div>
        <table class="signature-table"><tr>
            <td><div class="signature-space"></div><div class="signature-label">Applicant Signature over Printed Name</div></td>
            <td><div class="signature-space"></div><div class="signature-label">Authorized Testing Personnel</div></td>
        </tr></table>
    </div>

    <div class="cut-line">Cut along this line only when instructed</div>
    <div class="stub">
        <div class="stub-heading"><table><tr><td class="stub-title">Claim / Verification Stub</td><td class="stub-kicker">USM COLLEGE ENTRANCE EXAMINATION</td></tr></table></div>
        <div class="stub-body">
            <table><tr>
                <td class="stub-info">
                    <div class="label">Applicant name</div><div class="stub-name">{{ $fullName }}</div>
                    <table class="stub-details">
                        <tr><td class="field-label">Application no.</td><td class="stub-number">{{ $appNo }}</td></tr>
                        <tr><td class="field-label">Date &amp; time</td><td>{{ $examDate }} / {{ $cee_reservation->time }}</td></tr>
                        <tr><td class="field-label">Session</td><td>{{ $cee_reservation->exam_session }}</td></tr>
                        <tr><td class="field-label">Venue</td><td>{{ $cee_reservation->campus }} / {{ $cee_reservation->room_name }}</td></tr>
                    </table>
                </td>
                <td class="qr-cell"><img class="qr" src="{{ $qrCodeUrl }}" alt="Stub verification QR code"><div class="qr-caption">USMCEE<br>VALIDATION</div></td>
            </tr></table>
            <table class="signature-table"><tr>
                <td><div class="signature-space"></div><div class="signature-label">Applicant Signature over Printed Name</div></td>
                <td><div class="signature-space"></div><div class="signature-label">Authorized Testing Personnel</div></td>
            </tr></table>
            <div class="stub-note">Detach only when required for attendance, validation, acknowledgment, or official record-checking.</div>
        </div>
    </div>

    @if(is_file($mapPath))
        <div class="page-break">
            <div class="map-heading">
                <div class="eyebrow">USMCEE / Venue guide</div>
                <div class="map-title">Testing Center Location Map</div>
                <div class="subtitle">{{ $cee_reservation->campus }} / {{ $cee_reservation->college_name }}</div>
            </div>
            <div class="map-frame"><img class="map-image" src="{{ $mapPath }}" alt="{{ $cee_reservation->map_file }} testing center map"></div>
            <div class="notice">Please review the venue map before your scheduled examination day.</div>
        </div>
    @endif
</body>
</html>
