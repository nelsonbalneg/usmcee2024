<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USMCEE Examination Slip - {{ $cee_reservation->app_no }}</title>
    <style>
        @page { size: 8.5in 13in; margin: .42in .45in .5in; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: DejaVu Sans, sans-serif; font-size: 8.5pt; line-height: 1.4; color: #263832; }
        table { width: 100%; border-collapse: collapse; table-layout: auto; }
        td { vertical-align: top; }
        p { margin: 0; }
        .masthead { border-bottom: 2px solid #17604b; padding-bottom: 9px; }
        .masthead td { vertical-align: middle; }
        .seal-cell { width: 68px; }
        .seal { width: 58px; height: 58px; }
        .eyebrow { font-size: 6.5pt; letter-spacing: 1px; text-transform: uppercase; color: #65756e; }
        .university { font-size: 14pt; font-weight: bold; color: #174d3d; line-height: 1.3; }
        .office { font-size: 7.5pt; margin-top: 3px; }
        .location { font-size: 7pt; color: #65756e; }
        .document-heading { margin: 11px 0; }
        .document-heading td { vertical-align: middle; }
        .document-heading .title-cell { width: 55%; padding-right: 12px; }
        .document-title { font-size: 22pt; line-height: 1.15; font-weight: bold; color: #174d3d; margin: 3px 0 4px; }
        .subtitle { font-size: 8pt; color: #65756e; }
        .reference { text-align: right; border-left: 1px solid #d4ded8; padding-left: 12px; }
        .reference-number { font-size: 18pt; line-height: 1.3; font-weight: bold; color: #174d3d; word-wrap: break-word; }
        .reference-number.legacy { font-size: 10pt; }
        .reference-note { font-size: 6.7pt; margin-top: 3px; color: #65756e; }
        .schedule { border-top: 3px solid #b49a4e; background: #f0f5f2; margin-bottom: 8px; }
        .schedule td { padding: 8px 12px; width: 36%; }
        .schedule td + td { border-left: 1px solid #d4ded8; }
        .schedule .room-cell { width: 28%; }
        .label { font-size: 6.7pt; letter-spacing: .6px; text-transform: uppercase; color: #65756e; }
        .schedule-value { font-size: 10.5pt; font-weight: bold; color: #174d3d; margin-top: 5px; line-height: 1.4; }
        .section { margin-top: 11px; page-break-inside: avoid; }
        .section-title { border-bottom: 1px solid #d4ded8; padding-bottom: 6px; margin-bottom: 8px; font-size: 8pt; font-weight: bold; letter-spacing: .5px; color: #174d3d; text-transform: uppercase; }
        .section-number { color: #8b773d; padding-right: 8px; }
        .photo-cell { width: 108px; padding-right: 14px; }
        .photo { width: 92px; height: 92px; border: 1px solid #d4ded8; }
        .photo-label { font-size: 6pt; color: #65756e; margin-top: 4px; }
        .identity { padding-right: 14px; }
        .applicant-name { font-size: 12pt; line-height: 1.35; font-weight: bold; color: #172f25; margin: 3px 0 9px; word-wrap: break-word; }
        .identity-details td { padding-bottom: 3px; font-size: 8pt; }
        .field-label { width: 83px; color: #65756e; }
        .field-value { word-wrap: break-word; }
        .qr-cell { width: 86px; text-align: center; border-left: 1px solid #e0e6e2; padding-left: 10px; }
        .qr { width: 74px; height: 74px; }
        .qr-caption { font-size: 6pt; color: #65756e; margin-top: 3px; line-height: 1.4; }
        .notice { border-left: 3px solid #b49a4e; padding: 6px 11px; background: #faf9f3; font-size: 8pt; margin-top: 10px; line-height: 1.5; }
        .notice strong { color: #174d3d; }
        .requirements td { padding: 2px 0; line-height: 1.3; border-bottom: 1px solid #edf0ee; font-size: 8.2pt; }
        .requirements .check-cell { width: 25px; vertical-align: middle; }
        .requirement-checkbox { display: inline-block; width: 9px; height: 9px; border: 1px solid #65756e; background: #ffffff; }
        .signature-table { margin-top: 8px; }
        .signature-table td { width: 50%; padding-right: 25px; }
        .signature-table td + td { padding-right: 0; padding-left: 25px; }
        .signature-space { height: 23px; border-bottom: 1px solid #8d9e94; }
        .signature-label { font-size: 7pt; color: #65756e; padding-top: 5px; }
        .cut-line { margin: 10px 0 7px; border-top: 1px dashed #9caea3; text-align: center; padding-top: 5px; font-size: 6pt; letter-spacing: 1px; text-transform: uppercase; color: #65756e; }
        .stub { border: 1px solid #cbd7cf; page-break-inside: avoid; }
        .stub-heading { background: #f0f5f2; padding: 6px 11px; border-bottom: 1px solid #cbd7cf; }
        .stub-heading td { vertical-align: middle; }
        .stub-title { color: #174d3d; font-weight: bold; font-size: 9pt; }
        .stub-kicker { text-align: right; font-size: 6.5pt; color: #65756e; }
        .stub-body { padding: 8px 11px; }
        .stub-info { padding-right: 15px; }
        .stub-name { font-size: 10pt; font-weight: bold; margin: 3px 0 5px; word-wrap: break-word; }
        .stub-number { font-weight: bold; color: #174d3d; word-wrap: break-word; }
        .stub-details td { padding: 2px 0; font-size: 7.5pt; }
        .stub-note { font-size: 6.5pt; color: #65756e; margin-top: 8px; }
        .stub .signature-table { margin-top: 3px; }
        .stub .signature-space { height: 18px; }
        .stub .signature-label { font-size: 6.5pt; }
        .footer { position: fixed; bottom: -22px; left: 0; right: 0; border-top: 1px solid #d4ded8; padding-top: 5px; font-size: 6pt; color: #65756e; }
        .footer td + td { text-align: right; }
        .page-break { page-break-before: always; }
        .map-heading { margin: 11px 0; }
        .map-title { font-size: 18pt; font-weight: bold; color: #174d3d; margin: 3px 0; }
        .map-image { max-width: 100%; max-height: 9.6in; }
        .map-frame { border: 1px solid #d4ded8; padding: 10px; text-align: center; }
    </style>
</head>
<body>
    @php
        $appNo = (string) $cee_reservation->app_no;
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
            <td>Downloaded {{ now('Asia/Manila')->format('M j, Y g:i A') }}</td>
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
