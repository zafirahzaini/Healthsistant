<!DOCTYPE html>
<html>
<head>
    <title>Assessment Details</title>
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
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            background: #fdf8f2;
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
            font-size: 20px;
            margin-top: 10px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #ca8a04;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 2px solid #fde047;
            padding-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .label {
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
        }

        .value {
            color: #0f172a;
            font-size: 16px;
        }

        .notes-box {
            background: #fefce8;
            border-left: 4px solid #ca8a04;
            padding: 15px;
            border-radius: 4px;
            color: #334155;
            font-size: 15px;
            margin-top: 5px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-primary, .btn-secondary {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: opacity 0.2s ease;
        }

        .btn-primary {
            background: #ca8a04;
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        @media print {
            .dashboard-container { display: block; }
            .button-group, .sidebar { display: none !important; }
            .main-content { padding: 0; background: white; }
            .card { box-shadow: none; border: 1px solid #cbd5e1; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('layouts.cardiology_sidebar')
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Assessment Details</h1>
            <p class="page-subtitle">Comprehensive overview of patient vital statistics and clinical recommendations</p>
        </div>

        <div class="card">
            <h3>Patient Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Patient ID</span>
                    <span class="value">{{ $patient->PatientID }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Full Name</span>
                    <span class="value">{{ $patient->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Age / Gender</span>
                    <span class="value">{{ $patient->age }} Years / {{ $patient->gender }}</span>
                </div>
                <div class="info-item">
                    <span class="label">IC / Passport Number</span>
                    <span class="value">{{ $patient->ic_number ?? ($patient->passport_number ?? '-') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Vital Signs</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Temperature</span>
                    <span class="value">{{ $patient->temperature }} °C</span>
                </div>
                <div class="info-item">
                    <span class="label">Heart Rate</span>
                    <span class="value">{{ $patient->heart_rate }} BPM</span>
                </div>
                <div class="info-item">
                    <span class="label">Respiratory Rate</span>
                    <span class="value">{{ $patient->respiratory_rate }} RR</span>
                </div>
                <div class="info-item">
                    <span class="label">Blood Pressure</span>
                    <span class="value">{{ $patient->sbp }}/{{ $patient->dbp }} mmHg</span>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Clinical Assessment</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Symptoms</span>
                    <span class="value">{{ $patient->symptoms }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Preliminary Diagnosis</span>
                    <span class="value">{{ $patient->preliminary_diagnosis }}</span>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <span class="label">Specialist Notes</span>
                    <div class="notes-box">
                        {{ $patient->doctor_notes ?? 'No notes provided.' }}
                    </div>
                </div>
                <div class="info-item">
                    <span class="label">Decision</span>
                    <span class="value">{{ $patient->decision }}</span>
                </div>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ url('/cardiology/history') }}" class="btn-secondary">
                Back
            </a>

            <button onclick="window.print()" class="btn-primary" style="background: #64748b;">
                Print Report
            </button>

            @if($patient->status !== 'Discharged' && $patient->status !== 'Admitted')
                <form action="{{ url('/cardiology/patient/admit/' . $patient->PatientID) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-primary" style="color: white; cursor: pointer;">
                        Admit Patient
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
</body>
</html>