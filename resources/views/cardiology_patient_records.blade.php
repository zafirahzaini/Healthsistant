<!DOCTYPE html>
<html>
<head>
    <title>Cardiology Patient Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fdf8f2;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .page-title {
            font-size: 40px;
            font-weight: 700;
            color: #0f172a;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .record-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .record-title {
            font-size: 22px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #ca8a04;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }
    </style>
</head>
<body>
    @include('layouts.cardiology_sidebar')
    <div class="main-content">
        <h1 class="page-title">Patient Records</h1>
        <p class="page-subtitle">View all cardiology patient records and specialist cases</p>

        <div class="record-card">
            <div class="record-title">Cardiology Patients</div>
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Symptoms</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->symptoms }}</td>
                        <td>{{ $patient->preliminary_diagnosis ?? '-' }}</td>
                        <td>
                            <span class="badge" style="{{ $patient->status == 'Discharged' ? 'background:#f1f5f9; color:#475569;' : '' }}">
                                {{ $patient->status }}
                            </span>
                        </td>
                        <td>
                            @if($patient->status == 'Admitted')
                                <form action="{{ url('/patient/discharge/' . $patient->PatientID) }}" method="POST" onsubmit="return confirm('Are you sure you want to discharge this patient?');" style="display:inline;">
                                    @csrf
                                    <button type="submit" style="background:#dc2626; color: white; padding: 6px 12px; border-radius: 6px; border:none; cursor:pointer; font-weight: 500; font-size: 14px;">
                                        Discharge
                                    </button>
                                </form>
                            @else
                                <span style="color: #94a3b8;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color: #64748b;">
                            No cardiology patient records found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>