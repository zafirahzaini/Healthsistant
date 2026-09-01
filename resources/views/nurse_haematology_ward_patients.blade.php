<!DOCTYPE html>
<html>

<head>
    <title>Ward Patients</title>
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

        /* Updated to exactly match the dashboard subtitle's color and size */
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, .05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #c026d3;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #1e293b;
        }

        .badge {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-monitor {
            background: #c026d3;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-monitor:hover {
            background: #86198f;
        }

        .btn-meds {
            background: #7c3aed;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-meds:hover {
            background: #6d28d9;
        }
    </style>
</head>

<body>

<div class="main-container">

    @include('layouts.nurse_haematology_sidebar')

    <div class="content">

        <div class="page-title">
            Ward Patients
        </div>

        <div class="page-subtitle">
            Admitted patients under haematology department
        </div>

        <div class="card">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                        <th>Medical Records</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td style="font-weight: 500;">{{ $patient->name }}</td>
                        <td>{{ $patient->preliminary_diagnosis ?? '-' }}</td>
                        <td>
                            <span class="badge">
                                Admitted
                            </span>
                        </td>
                        <td>
                            <a href="/nurse-haematology/medications?patient_id={{ $patient->PatientID }}" class="btn-meds">
                                Medication Records
                            </a>
                        </td>
                        <td>
                            <a href="/nurse-haematology/vitals/{{ $patient->PatientID }}" class="btn-monitor">
                                Monitor
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px;">
                            No admitted patients found.
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