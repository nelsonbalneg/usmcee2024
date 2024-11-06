New Report Machine Ledger

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEE Examination Slip </title>
    <style>
        @page {
    size: 8.5in 13in;
    margin: 0.25in;
}

body {
    font-family: 'Corbel', sans-serif;
    margin: 0;
    padding: 0;
    width: calc(8.5in - 0.5in);
    height: 12.5in; /* Slightly smaller to avoid overflow */
    box-sizing: border-box;
    font-size: 9pt;
}

.container {
    width: 100%;
    height: 100%;
    padding: 0; /* Remove padding */
    box-sizing: border-box;
    page-break-inside: avoid; /* Avoid page break inside */
}

.header,
.section {
    width: 100%;
    margin-bottom: 5px;
    page-break-inside: avoid; /* Avoid page break inside */
}

.section div {
    font-size: 9pt;
}

.header div {
    text-align: center;
    font-weight: bold;
}

.header img {
    position: absolute;
    top: 0;
    width: 100px;
}

.header .left-logo {
    left: 0;
    margin-left: 100px;
}

table {
    width: 100%;
    border-collapse: collapse;
    page-break-inside: avoid; /* Prevent tables from breaking across pages */
}

th,
td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
    font-size: 12px;
    vertical-align: middle;
}

th {
    background-color: #cecece;
    text-align: center;
    white-space: nowrap;
}

.fixed-width th {
    width: 130px;
    height: 8px;
}

.equipment-specifications th,
.equipment-specifications td {
    background-color: #a1a1a1;
}

.round-image {
    border-radius: 50%;
    width: 200px;
    height: 200px;
    object-fit: cover;
}

.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    /* font-size: 100px; */
    color: rgba(0, 0, 0, 0.1);
    white-space: nowrap;
    z-index: -1;
    pointer-events: none;
    opacity: 0.3; /* 20% opacity */
}

.title {
    text-align: center;
    margin: 5px 0;
}

.row-height td {
    height: 12px;
}

.text-left {
    display: flex;
    justify-content: space-between;
}

.info-item {
    margin-right: 40px;
}

.footer {
    position: absolute; /* Change to absolute instead of fixed */
    bottom: 0;
    width: 100%;
    color: rgb(46, 46, 46);
    font-size: 7pt;
}

        </style>
</head>

<body>
    <div class="container">
        <div class="header">

            <img src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" alt="University Logo"
                class="left-logo">
            <div>University of Southern Mindanao</div>
            <div>UNIVERSITY TEST DEVELOPMENT CENTER</div>
            <div style="font-size: 10pt;">Kabacan, Cotabato</div>
            <br>

            <div style="color: blue;">UNIVERSITY OF SOUTHERN MINDANAO <br>
                COLLEGE ENTRANCE EXAMINATION</div>
            <div class="title">Entrance Examination Slip</div>
        </div>

        <div class="row d-flex justify-content-center" style="margin-bottom: 10px; margin-top:40px;">
            <div class="col">
                <div class="text-left">
                    <span class="info-item"><b>Congratulations!</b>You have successfully reserved a slot for the USMCEE. Below are your reservation details:</span>
                </div>

            </div>
        </div>

        <table style="margin-bottom: 10px; width: 100%;">
            <tr>
                <th colspan="2" style="text-align: center;">CEE RESERVATION DETAILS</th>
            </tr>
            <tr>
                <!-- Left Column -->
                <td style="vertical-align: top; width: 50%;">
                    <table style="width: 100%;">
                        @if ($cee_reservation->photo)

                        @endif
                        <img src="{{ public_path($cee_reservation->applicant->photo) }}" alt="Applicant Photo"
                            style="width: 100px; height: 100px; margin-left: 120px;" class="round-image">
                        <p style="text-align: center;">App No.: <b> {{ $cee_reservation->app_no }}</b><br>
                            Full Name: <b>{{ $cee_reservation->applicant->lastname }},
                                {{ $cee_reservation->applicant->firstname }}
                                {{ $cee_reservation->applicant->middlename }}
                                {{ $cee_reservation->applicant->suffix }}</b> </p>
                    </table>
                </td>

                <!-- Right Column -->
                <td style="vertical-align: top; width: 50%;">
                    <table style="width: 100%;">
                        <tr>
                            <th style="text-align: left; width: 100px;">Test Session:</th>
                            <td>{{ $cee_reservation->exam_session }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left; width: 100px;">Test Venue:</th>
                            <td>{{ $cee_reservation->room->college_name }} - {{ $cee_reservation->room->room_name }}
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: left; width: 100px;">Date and Time:</th>
                            <td> {{ \Carbon\Carbon::parse($cee_reservation->room->schedule)->format('Y-m-d') }} -
                                {{ $cee_reservation->room->time }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: left; width: 100px;">Examinee Type:</th>
                            <td>
                                @if ($cee_reservation->is_repeat_exam === 'Yes')
                                    Retaker
                                @else
                                    New
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



        <table class="table table-borderless">
            <tr>
                <td style=" border: none;">
                    <h3>Requirements upon entry to the testing center/venue:</h3>
                    <ul>
                        <li>USMCEE Entrance Examination Slip</li>
                        <li>One (1) Valid ID (Government-Issued ID, High School ID, Company ID, and National ID)</li>
                        <li>Face mask</li>
                        <li>Personal alcohol/sanitizer</li>
                        <li>Personal ballpen (not sign pen)</li>
                        <li>Pencil and sharpener</li>
                        <li>Snacks</li>
                        </ul>
                </td>
            </tr>
        </table>

        <div class="watermark">
            @for ($i = 0; $i < 55; $i++)
            <p>USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 {{$cee_reservation->app_no}} USMCEE -2024 USMCEE -2024</p>
        @endfor

        <br>
        {{-- <div class="footer">
            <p>Downloaded Date and Time: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
            <p> <i>University of Southern Mindanao - College Entrance Examination Reservation System v4.0 | <b> Powered by: UICTO</b></i></p>
        </div> --}}
    </div>

</body>

</html>
