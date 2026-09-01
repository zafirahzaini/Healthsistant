<!DOCTYPE html>
<html>
<head>
    <title>Vital Signs Monitoring</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #faf5ff;
            min-height: 100vh;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .page-title {
            font-size: 40px;
            font-weight: 700;
            color: #86198f;
        }

        /* Updated to exactly match the dashboard subtitle color and 20px size */
        .page-subtitle {
            color: #78716c; 
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 30px;
            font-weight: 400;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(134, 25, 143, 0.03);
            border: 1px solid rgba(243, 232, 255, 0.7);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #c026d3;
            color: white;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3e8ff;
            color: #1e293b;
            font-size: 15px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fdfafe;
        }

        .badge {
            background: #dcfce7;
            color: #166534;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-record {
            background: #c026d3;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(192, 38, 211, 0.1);
        }

        .btn-record:hover {
            background: #86198f;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(134, 25, 143, 0.2);
        }
    </style>
</head>
<body>

<div class="main-container">

    @include('layouts.nurse_haematology_sidebar')

    <div class="content">

        <h1 class="page-title">Vital Signs Monitoring</h1>
        <p class="page-subtitle">Select a patient to record vital signs</p>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 50%;">Patient Name</th>
                        <th style="width: 20%;">Status</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td style="font-weight: 600; color: #64748b;">#{{ $patient->PatientID }}</td>
                        <td style="font-weight: 600; color: #1e293b;">{{ $patient->name }}</td>
                        <td>
                            <span class="badge">
                                Admitted
                            </span>
                        </td>
                        <td>
                            <a href="/nurse-haematology/vitals/{{ $patient->PatientID }}" class="btn-record">
                                Record Vitals
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:40px; color: #64748b;">
                            No admitted patients found for vitals tracking.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>