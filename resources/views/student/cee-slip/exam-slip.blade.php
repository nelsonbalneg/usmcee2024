<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Machine Ledger Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 30px;
            background-color: #f9f9f9;
            color: #333;
        }

        .slip-container {
            position: relative;
            max-width: 750px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-left,
        .header-right {
            width: 100px;
            text-align: center;
        }

        .header-center {
            text-align: center;
            flex-grow: 1;
            margin: 0 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
            color: #006400;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
            font-weight: 600;
        }

        .header-left-logo {
            max-width: 50px;
            /* Adjust this value as needed */
            height: auto;
        }

        .photo-container {
            display: flex;
            justify-content: center;
            /* Centers the image horizontally */
            align-items: center;
            /* Centers the image vertically */
            margin-top: 5px;
            height: 150px;
            /* You can adjust the height based on your layout */
        }

        .applicant-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ddd;
            margin-bottom: 10px;
        }

        .info-table,
        .item-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td,
        .item-table th,
        .item-table td {
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .item-table th {
            background-color: #f4f4f4;
            text-align: left;
            font-weight: bold;
        }

        .item-table td {
            background-color: #fafafa;
        }

        .total {
            text-align: right;
            padding: 12px;
            font-weight: bold;
            color: #0056b3;
        }

        .requirements-container {
            margin-top: 25px;
        }

        .requirements-container th {
            text-align: left;
            font-weight: bold;
            color: #333;
            font-size: 12px;
        }

        .requirements-container td {
            padding-left: 20px;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .footer p {
            margin: 3px 0;
        }

        .login-section {
            margin-top: 15px;
            text-align: center;
        }

        .login-section a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #006400;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-section a:hover {
            background-color: #004d00;
        }
    </style>
</head>

<body>

    <div class="slip-container">
        <!-- Slip Header -->
        <div class="header">
            <div class="header-center">
                <p>University of Southern Mindanao</p>
                <p>UNIVERSITY TEST DEVELOPMENT CENTER</p>
                <p>Kabacan, Cotabato</p>
                <br>
                <h1>COLLEGE ENTRANCE EXAMINATION</h1>
                <p>Entrance Examination Slip</p>
            </div>
            <div class="header-right">
                <!-- Empty for symmetry -->
            </div>
        </div>

        <!-- Applicant Photo -->
        <div class="photo-container">
            <img src="{{ public_path($cee_reservation->applicant->photo) }}" alt="Applicant Photo"
                class="applicant-photo">
        </div>
        <!-- Applicant Information -->
        <table class="item-table">
            <thead>
                <tr>
                    <th colspan="2">Applicant Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>App No.:</strong></td>
                    <td>{{ $cee_reservation->app_no }}</td>
                </tr>
                <tr>
                    <td><strong>Full Name:</strong></td>
                    <td>{{ $cee_reservation->applicant->lastname }},
                        {{ $cee_reservation->applicant->firstname }}
                        {{ $cee_reservation->applicant->middlename }}
                        {{ $cee_reservation->applicant->suffix }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Test Session:</strong></td>
                    <td>{{ $cee_reservation->exam_session }}</td>
                </tr>
                <tr>
                    <td><strong>Test Venue:</strong></td>
                    <td>{{ $cee_reservation->room->campus }} /
                        {{ $cee_reservation->room->college_name }} /
                        {{ $cee_reservation->room->room_name }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Date and Time:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($cee_reservation->room->schedule)->format('Y-m-d') }} /
                        {{ $cee_reservation->room->time }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Requirements Section -->
        <div class="requirements-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80%;">Requirements upon entry to the testing center/venue:</th>
                        <th style="width: 20%; text-align: right;"></th> <!-- Adjusted to align right -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>* USMCEE Entrance Examination Slip</td>
                        <td rowspan="6" style="text-align: right; vertical-align: middle; padding-left: 20px;">
                            <img src="{{ public_path('backend/assets/images/logo/qr.png') }}" alt="QR Code"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </td>
                    </tr>
                    <tr>
                        <td>* Valid Government-Issued ID, High School ID, or National ID</td>
                    </tr>
                    <tr>
                        <td>* Face Mask</td>
                    </tr>
                    <tr>
                        <td>* Personal Alcohol/Sanitizer</td>
                    </tr>
                    <tr>
                        <td>* Personal Ballpen</td>
                    </tr>
                    <tr>
                        <td>* Pencil and Sharpener</td>
                    </tr>
                    <tr>
                        <td>* Snacks</td>
                    </tr>
                </tbody>
            </table>
        </div>




        <!-- Footer -->
        <div class="footer">
            <p>Issued by: University Test Development Center</p>
            <p>This is a computer-generated slip and does not require a signature.</p>
            <p>Date: {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
        </div>
    </div>

</body>

</html>