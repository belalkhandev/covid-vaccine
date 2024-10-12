<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Covid Vaccine Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .email-header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            text-align: left;
        }
        .email-footer {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .email-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .email-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .email-table th {
            padding: 10px;
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Covid Vaccine Schedule</h1>
    </div>

    <div class="email-body">
        <p>Hello {{ $vaccineRecipient->name }},</p>
        <p>We are pleased to inform you about your covid vaccine schedule:</p>

        <table class="email-table">
            <tr>
                <th>Schedule Date</th>
                <td>{{ $vaccineRecipient->vaccine->formatted_vaccination_date }}</td>
            </tr>
            <tr>
                <th>Vaccine Center</th>
                <td>{{ $vaccineRecipient->vaccine->vaccineCenter->name }}</td>
            </tr>
            <tr>
                <th>Vaccine Center Address</th>
                <td>{{ $vaccineRecipient->vaccine->vaccineCenter->address }}</td>
            </tr>
            <tr>
                <th>Vaccine Dosage</th>
                <td>{{ $vaccineRecipient->vaccine->vaccineDosage->name }}</td>
            </tr>
        </table>

        <p>Thank you,<br>Vaccine Center</p>
    </div>
</div>
</body>
</html>
