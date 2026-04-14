<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>USMCEE Official Examination Slip</title>
    <style>
        @page {
            size: 8.5in 13in;
            margin: 0.22in 0.25in 0.32in 0.25in;
        }

        /* Replace these with your actual font files if available */
        @font-face {
            font-family: 'CorbelCustom';
            src: url("{{ public_path('fonts/corbel.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'CorbelCustom';
            src: url("{{ public_path('fonts/corbel-bold.ttf') }}") format("truetype");
            font-weight: bold;
            font-style: normal;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'CorbelCustom', Corbel, DejaVu Sans, sans-serif;
            margin: 0;
            color: #1f2937;
            font-size: 8.35pt;
            line-height: 1.18;
            background: #ffffff;
        }

        .page {
            position: relative;
            width: 100%;
        }

        .page-break {
            page-break-before: always;
        }

        .watermark {
            position: fixed;
            top: 41%;
            left: 6%;
            width: 88%;
            text-align: center;
            transform: rotate(-30deg);
            font-size: 21pt;
            font-weight: bold;
            color: #0f172a;
            opacity: 0.032;
            z-index: -1;
            white-space: nowrap;
        }

        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 6.5pt;
            color: #64748b;
        }

        .footer p {
            margin: 1px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td,
        .details-table td,
        .info-table td,
        .sign-table td,
        .stub-table td {
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .logo {
            width: 58px;
            height: 58px;
        }

        .qr-main {
            width: 66px;
            height: 66px;
            border: 0.8px solid #94a3b8;
            padding: 2px;
            background: #ffffff;
        }

        .qr-stub {
            width: 58px;
            height: 58px;
            border: 0.8px solid #94a3b8;
            padding: 2px;
            background: #ffffff;
        }

        .republic {
            font-size: 6.8pt;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #475569;
            margin-bottom: 1px;
        }

        .school-name {
            font-size: 12.5pt;
            font-weight: bold;
            line-height: 1.03;
            color: #0f172a;
        }

        .office-name {
            font-size: 8pt;
            font-weight: bold;
            margin-top: 1px;
            color: #1e293b;
        }

        .location {
            font-size: 7.2pt;
            color: #64748b;
            margin-top: 1px;
        }

        .doc-title {
            margin-top: 5px;
            font-size: 10.3pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #0f172a;
        }

        .doc-subtitle {
            margin-top: 1px;
            font-size: 8.4pt;
            font-weight: bold;
            color: #334155;
        }

        .ref-box {
            margin-top: 6px;
            border: 0.8px solid #cbd5e1;
            padding: 6px 7px;
            background: #f8fafc;
        }

        .ref-title {
            font-size: 7.4pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
            color: #0f172a;
        }

        .ref-text {
            font-size: 7.4pt;
            color: #334155;
            margin: 0;
        }

        .section {
            margin-top: 6px;
            border: 0.8px solid #cbd5e1;
            background: #ffffff;
        }

        .section-head {
            background: #eff6ff;
            border-bottom: 0.8px solid #cbd5e1;
            padding: 5px 7px;
            font-size: 7.8pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #0f172a;
        }

        .section-body {
            padding: 7px;
        }

        .left-pane {
            width: 26%;
            padding-right: 6px;
        }

        .right-pane {
            width: 74%;
            padding-left: 6px;
        }

        .photo-box {
            /* border: 0.8px solid #cbd5e1; */
            padding: 5px;
            text-align: center;
            /* background: #f8fafc; */
        }

        .photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 0.8px solid #cbd5e1;
            background: #ffffff;
        }

        .app-no {
            margin-top: 5px;
            font-size: 8.6pt;
            font-weight: bold;
            color: #0f172a;
        }

        .fullname {
            margin-top: 4px;
            font-size: 7.7pt;
            font-weight: bold;
            line-height: 1.14;
            text-transform: uppercase;
            color: #1e293b;
        }

        .status-tag {
            display: inline-block;
            padding: 2px 7px;
            border: 0.8px solid #bfdbfe;
            background: #eff6ff;
            font-size: 6.9pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #1d4ed8;
            margin-bottom: 4px;
        }

        .info-table tr+tr td {
            padding-top: 3px;
        }

        .info-label {
            width: 104px;
            font-size: 7.2pt;
            font-weight: bold;
            color: #64748b;
            padding-right: 5px;
        }

        .info-value {
            font-size: 7.9pt;
            font-weight: bold;
            color: #0f172a;
        }

        .req-note {
            font-size: 7.3pt;
            color: #334155;
            margin-bottom: 3px;
        }

        .req-list {
            margin: 0 0 0 14px;
            padding: 0;
        }

        .req-list li {
            margin-bottom: 1px;
            font-size: 7.35pt;
            color: #1f2937;
            line-height: 1.16;
        }

        .sign-wrap {
            margin-top: 6px;
            /* border: 0.8px solid #cbd5e1; */
            padding: 6px 7px;
            /* background: #fcfdff; */
        }

        .sign-title {
            font-size: 7.5pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 6px;
            color: #0f172a;
        }

        .sign-table td {
            width: 50%;
        }

        .sign-line {
            border-top: 0.8px solid #94a3b8;
            width: 88%;
            padding-top: 3px;
            font-size: 7pt;
            color: #475569;
            margin-top: 20px;
        }

        .sign-line.right {
            margin-left: auto;
        }

        .perforation-wrap {
            margin-top: 7px;
            margin-bottom: 2px;
            text-align: center;
        }

        .perforation-label {
            font-size: 6.5pt;
            font-weight: bold;
            letter-spacing: 1.1px;
            color: #64748b;
            margin-bottom: 1px;
            text-transform: uppercase;
        }

        .perforation-dots {
            font-size: 7.8pt;
            letter-spacing: 1.5px;
            line-height: 1;
            color: #94a3b8;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Bottom tear-off stub */
        .bottom-stub {
            margin-top: 2px;
            border: 0.8px dashed #94a3b8;
            background: #f8fafc;
        }

        .bottom-stub-head {
            background: #eff6ff;
            border-bottom: 0.8px dashed #94a3b8;
            padding: 4px 7px;
            font-size: 7.4pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #0f172a;
        }

        .bottom-stub-body {
            padding: 5px 7px;
        }

        .bottom-stub-note {
            font-size: 6.8pt;
            color: #475569;
            margin-bottom: 4px;
        }

        .stub-table td {
            border: 0.8px solid #cbd5e1;
            padding: 3px 5px;
            font-size: 7.05pt;
            color: #1f2937;
        }

        .stub-label {
            width: 70px;
            font-weight: bold;
            background: #ffffff;
            color: #64748b;
        }

        .stub-col-app {
            width: 36%;
        }

        .stub-col-exam {
            width: 34%;
        }

        .stub-col-qr {
            width: 14%;
            text-align: center;
        }

        .stub-col-sign {
            width: 16%;
        }

        .stub-qr-meta {
            margin-top: 2px;
            font-size: 6.2pt;
            color: #64748b;
            line-height: 1.1;
        }

        .mini-sign-line {
            border-top: 0.8px solid #94a3b8;
            width: 100%;
            margin-top: 14px;
            padding-top: 2px;
            font-size: 6.5pt;
            color: #64748b;
            text-align: center;
        }

        .map-title {
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
            color: #0f172a;
            margin-top: 2px;
        }

        .map-subtitle {
            text-align: center;
            font-size: 7.4pt;
            color: #64748b;
            margin-top: 2px;
            margin-bottom: 6px;
        }

        .map-wrap {
            border: 0.8px solid #cbd5e1;
            padding: 7px;
            background: #ffffff;
        }

        .map-image {
            width: 100%;
            max-height: 11.42in;
            object-fit: contain;
            border: 0.8px solid #e2e8f0;
        }

        .header-green {
            background: #065f46;
            color: #ffffff;
            padding: 6px 10px;
            border-radius: 4px;
            margin-bottom: 6px;
        }

        .header-green .title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-green .subtitle {
            font-size: 7.5pt;
            opacity: 0.9;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    @php
        $appNo = $cee_reservation->app_no;
        $fullName =
            strtoupper($cee_reservation->lastname) .
            ', ' .
            strtoupper($cee_reservation->firstname) .
            ' ' .
            strtoupper($cee_reservation->middlename ?? '') .
            ' ' .
            strtoupper($cee_reservation->suffix ?? '');
    @endphp

    <div class="watermark">
        UNIVERSITY OF SOUTHERN MINDANAO • OFFICIAL EXAMINATION SLIP • {{ $appNo }}
    </div>

    <div class="footer">
        <p>Downloaded: {{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i:s A') }}</p>
        <p>University of Southern Mindanao - College Entrance Examination Reservation System v4.0 | <strong>Powered by
                UICTO</strong></p>
    </div>

    {{-- PAGE 1 --}}

    <div class="header-green center">
        <div class="title">USM College Entrance Examination (USMCEE)</div>
        <div class="subtitle">Official Examination Slip</div>
    </div>
    <div class="page">
        <table class="header-table">
            <tr>
                <td style="width: 68px;">
                    <img src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" class="logo"
                        alt="USM Logo">
                </td>

                <td class="text-center">
                    <div class="republic">Republic of the Philippines</div>
                    <div class="school-name">University of Southern Mindanao</div>
                    <div class="office-name">UNIVERSITY TEST DEVELOPMENT CENTER</div>
                    <div class="location">Kabacan, Cotabato</div>
                </td>

                <td class="text-right" style="width: 74px;">
                    <img src="{{ $qrCodeUrl }}" class="qr-main" alt="QR Code">
                </td>
            </tr>
        </table>

        <div class="ref-box">
            <div class="ref-title">Important Notice</div>
            <p class="ref-text">
                This document shall be presented by the applicant on the scheduled examination date together with one
                (1) valid identification card for verification purposes.
            </p>
        </div>

        <div class="section">
            <div class="section-head">Applicant and Examination Information</div>
            <div class="section-body">
                <table class="details-table">
                    <tr>
                        <td class="left-pane">
                            <div class="photo-box">
                                <img src="{{ public_path($cee_reservation->photo) }}" alt="Applicant Photo"
                                    class="photo">
                                {{-- <div class="app-no">{{ $cee_reservation->app_no }}</div> --}}
                                <div class="fullname">{{ $fullName }}</div>
                            </div>
                        </td>

                        <td class="right-pane">
                            <div class="status-tag">Reserved Examination Slot</div>

                            <table class="info-table">
                                <tr>
                                    <td class="info-label">Application No.</td>
                                    <td class="info-value">{{ $cee_reservation->app_no }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Applicant Name</td>
                                    <td class="info-value">{{ $fullName }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Test Session</td>
                                    <td class="info-value">{{ $cee_reservation->exam_session }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Test Venue</td>
                                    <td class="info-value">({{ $cee_reservation->campus }})
                                        {{ $cee_reservation->college_name }} / {{ $cee_reservation->room_name }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Examination Date</td>
                                    <td class="info-value">
                                        {{ \Carbon\Carbon::parse($cee_reservation->schedule)->format('F j, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Examination Time</td>
                                    <td class="info-value">{{ $cee_reservation->time }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">Applicant Type</td>
                                    <td class="info-value">
                                        {{ $cee_reservation->is_repeat_exam === 'Yes' ? 'Retaker' : 'First Time Taker' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="section-head">Requirements Upon Entry to the Testing Center / Venue</div>
            <div class="section-body">
                <div class="req-note">The applicant is advised to bring the following:</div>
                <ul class="req-list">
                    <li>Printed examination slip generated after successful reservation</li>
                    <li>One (1) valid ID: Government-issued ID, High School ID, Company ID, or National ID</li>
                    <li>Personal ballpen (not sign pen)</li>
                    <li>Pencil and sharpener</li>
                    <li>Snacks and water in non-single-use plastic containers or tumbler</li>
                    <li>Transparent bag or envelope for personal items</li>
                </ul>
            </div>
        </div>

        <div class="sign-wrap">
            <div class="sign-title">Acknowledgment</div>
            <table class="sign-table">
                <tr>
                    <td>
                        <div class="sign-line">Applicant Signature over Printed Name</div>
                    </td>
                    <td class="text-right">
                        <div class="sign-line right">Authorized Testing Personnel</div>
                    </td>
                </tr>
            </table>
        </div>

        {{-- PERFORATION --}}
        <div class="perforation-wrap" style="margin-top: 20px; margin-bottom: 10px;;">
            {{-- <div class="perforation-label">Cut Here</div> --}}
            <div class="perforation-dots">
                ••••••••••••••••••••••••••••••••••••••••••••••••••• Cut Here
                •••••••••••••••••••••••••••••••••••••••••••••••••••••••••••
            </div>
        </div>

        {{-- FULL-WIDTH BOTTOM TEAR-OFF STUB --}}
        <div class="bottom-stub">
            <div class="bottom-stub-head">Claim Stub / Verification Stub</div>
            <div class="bottom-stub-body">
                <div class="bottom-stub-note">
                    Detach this strip only when required for attendance, validation, acknowledgment, or official
                    record-checking.
                </div>

                <table class="stub-table">
                    <tr>
                        <td class="stub-label stub-col-app">Applicant</td>
                        <td class="stub-col-app">{{ $fullName }}</td>

                        <td class="stub-label stub-col-exam">Session</td>
                        <td class="stub-col-exam">{{ $cee_reservation->exam_session }}</td>

                        <td class="stub-col-qr" rowspan="3">
                            <img src="{{ $qrCodeUrl }}" class="qr-stub" alt="Stub QR Code">
                            <div class="stub-qr-meta">USMCEE<br>Validation</div>
                        </td>

                    </tr>
                    <tr>
                        <td class="stub-label">App No.</td>
                        <td>{{ $cee_reservation->app_no }}</td>

                        <td class="stub-label">Date & Time</td>
                        <td>{{ \Carbon\Carbon::parse($cee_reservation->schedule)->format('F j, Y') }} /
                            {{ $cee_reservation->time }}</td>
                    </tr>
                    <tr>
                        <td class="stub-label">Venue</td>
                        <td colspan="3">{{ $cee_reservation->campus }} / {{ $cee_reservation->room_name }}</td>
                    </tr>
                </table>

                <div class="sign-wrap">
                    <table class="sign-table">
                        <tr>
                            <td>
                                <div class="sign-line">Applicant Signature over Printed Name</div>
                            </td>
                            <td class="text-right">
                                <div class="sign-line right">Authorized Testing Personnel</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- PAGE 2 --}}
    <div class="page page-break">
        <div class="map-title">Testing Center Location Map</div>
        <div class="map-subtitle">
            Please review the venue map before your scheduled examination day.
        </div>

        <div class="map-wrap">
            <img src="{{ public_path('backend/assets/images/map/' . Str::lower($cee_reservation->map_file) . '.png') }}"
                alt="{{ $cee_reservation->map_file }}" class="map-image">
        </div>
    </div>
</body>

</html>
