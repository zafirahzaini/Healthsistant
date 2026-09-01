<!DOCTYPE html>
<html>
<head>
    <title>Assessment Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fdf2f8;
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            background: #fdf2f8;
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
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            border-top: 5px solid #db2777;
        }

        .card h3 {
            margin-top: 0;
            color: #0f172a;
            font-size: 24px;
            margin-bottom: 25px;
            border-bottom: 2px solid #fce7f3;
            padding-bottom: 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label {
            font-size: 15px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .value {
            font-size: 18px;
            color: #1e293b;
            font-weight: 500;
        }

        .notes-box {
            background: #f8fafc !important; 
            border: 1px solid #e2e8f0;
            border-left: 4px solid #db2777;
            padding: 20px;
            border-radius: 10px;
            color: #1e293b;
            font-size: 17px;
            line-height: 1.6;
            margin-top: 5px;
        }

        .button-group {
            margin-top: 35px;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .btn-primary {
            background: #db2777;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    
    @include('layouts.haematology_sidebar')

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Assessment Details</h1>
            <p class="page-subtitle">Detailed clinical assessment data for patient</p>
        </div>

        <div class="card">
            <h3>Patient Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Patient ID</span>
                    <span class="value">#{{ $patient->PatientID }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Full Name</span>
                    <span class="value">{{ $patient->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">IC Number</span>
                    <span class="value">{{ $patient->ic_number ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Passport Number</span>
                    <span class="value">{{ $patient->passport_number ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Nationality</span>
                    <span class="value">{{ $patient->nationality ?? 'Malaysian' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Age / Gender</span>
                    <span class="value">{{ $patient->age }} Y/O / {{ $patient->gender }}</span>
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
            <a href="{{ url('/haematology/history') }}" class="btn-secondary">
                Back
            </a>

            <button onclick="window.print()" class="btn-primary" style="background: #64748b;">
                Print Report
            </button>

            @if($patient->status !== 'Discharged' && $patient->status !== 'Admitted')
                <form action="{{ url('/haematology/patient/admit/' . $patient->PatientID) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-primary" style="background: #1e40af; color: white; cursor: pointer;">
                        Admit Patient
                    </button>
                </form>
            @endif
        </div>

    </div>
</div>

</body>
</html>