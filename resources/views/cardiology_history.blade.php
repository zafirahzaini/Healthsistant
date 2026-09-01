<!DOCTYPE html>
<html>
<head>
    <title>Cardiology Assessment History</title>
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
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 40px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 40px;
            font-weight: 700;
            color: #0f172a;
        }

        .page-subtitle {
            color: #64748b;
            margin-top: 10px;
            font-size: 20px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #ca8a04;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            background: #dcfce7;
            color: #15803d;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
        }

        .view-btn {
            background: #ca8a04;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s ease;
        }

        .view-btn:hover {
            background: #a16207;
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 20px 0;
        }
    </style>
</head>
<body>
<div class="main-container">
    @include('layouts.cardiology_sidebar')
    <div class="content">
        <div class="page-header">
            <h1 class="page-title">Cardiology Assessment History</h1>
            <p class="page-subtitle">Logs of all completed clinical evaluations</p>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Assessment Time</th>
                        <th>Symptoms</th>
                        <th>Preliminary Diagnosis</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->PatientID }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>
                            {{ $patient->assessment_time ? date('d/m/Y H:i', strtotime($patient->assessment_time)) : 'Not Recorded' }}
                        </td>
                        <td>{{ $patient->symptoms }}</td>
                        <td>{{ $patient->preliminary_diagnosis }}</td>
                        <td>
                            <span class="badge">
                                Completed
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('cardiology.history.details', $patient->PatientID) }}" class="view-btn">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                No completed cardiology assessments available.
                            </div>
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