<!DOCTYPE html>
<html>
<head>
    <title>Patient Flow Timeline - HealthSistant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff8f8;
            color: #111827;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 40px;
            background: radial-gradient(circle at top right, rgba(127, 29, 29, 0.05), transparent 30%);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #7f1d1d;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 35px;
        }

        /* Top Timeline Horizon Stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 40px;
            padding: 0 10px;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
            text-align: center;
            position: relative;
            flex: 1;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
            background: #e5e7eb;
            color: #9ca3af;
            margin-bottom: 8px;
            border: 3px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .step-item.active .step-icon {
            background: #15803d;
            color: white;
        }

        .step-item.deceased .step-icon {
            background: #7f1d1d;
            color: white;
        }

        .step-title {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
        }

        .step-time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* Layout Columns */
        .journey-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid #fee2e2;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #7f1d1d;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #fee2e2;
        }

        /* Activity Log List */
        .log-item {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
        }

        .log-timestamp {
            width: 140px;
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            text-align: right;
            flex-shrink: 0;
            padding-top: 2px;
        }

        .log-content h4 {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .log-content p {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.5;
        }

        /* Profile Data List */
        .profile-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            font-size: 13.5px;
        }

        .profile-label {
            color: #6b7280;
            font-weight: 500;
        }

        .profile-value {
            font-weight: 700;
            color: #111827;
            text-align: right;
        }

        .status-badge-admitted {
            color: #b91c1c;
            font-weight: 700;
        }

        .status-badge-deceased {
            color: #ffffff;
            background: #1f2937;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 700;
        }

        .deceased-banner {
            background: #1f2937;
            color: white;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="main-container">
    @include('layouts.admin_sidebar')

    <div class="content">
        <a href="{{ url('/admin/journey') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Back to Journey Tracker
        </a>

        <div class="page-header">
            <h1>Patient Flow Timeline</h1>
            <p>Tracking live tracking updates for <strong>{{ $patient->name }}</strong></p>
        </div>

        @if($patient->status == 'Deceased' || !empty($patient->time_of_death))
            <div class="deceased-banner">
                <i class="fa-solid fa-cross fa-lg" style="color:#ef4444;"></i>
                <div>
                    <strong>Patient Record Closed (Deceased)</strong> — 
                    Time of Death: {{ $patient->time_of_death ? \Carbon\Carbon::parse($patient->time_of_death)->format('d/m/Y h:i A') : 'Recorded' }}
                </div>
            </div>
        @endif

        <!-- Horizontal Stepper Horizon -->
        <div class="stepper">
            <div class="step-item active">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-title">Registration</div>
                <div class="step-time">{{ $patient->created_at ? \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y h:i A') : '-' }}</div>
            </div>

            <div class="step-item {{ $patient->doctor_seen_at ? 'active' : '' }}">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-title">Assessment</div>
                <div class="step-time">{{ $patient->doctor_seen_at ? \Carbon\Carbon::parse($patient->doctor_seen_at)->format('d/m/Y h:i A') : 'Pending' }}</div>
            </div>

            <div class="step-item {{ $patient->specialist_department ? 'active' : '' }}">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-title">Referral</div>
                <div class="step-time">{{ $patient->specialist_department ?? 'Pending' }}</div>
            </div>

            <div class="step-item {{ $patient->doctor_seen_at ? 'active' : '' }}">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-title">Doctor Review</div>
                <div class="step-time">{{ $patient->doctor_seen_at ? \Carbon\Carbon::parse($patient->doctor_seen_at)->format('d/m/Y h:i A') : 'Pending' }}</div>
            </div>

            <div class="step-item {{ $patient->admitted_at ? 'active' : '' }}">
                <div class="step-icon">
                    @if($patient->admitted_at)
                        <i class="fa-solid fa-check"></i>
                    @else
                        <i class="fa-solid fa-circle" style="font-size:10px;"></i>
                    @endif
                </div>
                <div class="step-title">Admission</div>
                <div class="step-time">{{ $patient->admitted_at ? \Carbon\Carbon::parse($patient->admitted_at)->format('d/m/Y h:i A') : 'Pending' }}</div>
            </div>

            <div class="step-item {{ $patient->status == 'Deceased' ? 'deceased' : ($patient->discharged_at ? 'active' : '') }}">
                <div class="step-icon">
                    @if($patient->status == 'Deceased')
                        <i class="fa-solid fa-cross"></i>
                    @elseif($patient->discharged_at)
                        <i class="fa-solid fa-check"></i>
                    @else
                        <i class="fa-solid fa-circle" style="font-size:10px;"></i>
                    @endif
                </div>
                <div class="step-title">{{ $patient->status == 'Deceased' ? 'Deceased' : 'Discharge' }}</div>
                <div class="step-time">
                    @if($patient->status == 'Deceased')
                        {{ $patient->time_of_death ? \Carbon\Carbon::parse($patient->time_of_death)->format('d/m/Y h:i A') : 'Recorded' }}
                    @else
                        {{ $patient->discharged_at ? \Carbon\Carbon::parse($patient->discharged_at)->format('d/m/Y h:i A') : 'Pending' }}
                    @endif
                </div>
            </div>
        </div>

        <div class="journey-grid">
            <!-- Left Side: Journey Activity Log -->
            <div class="card">
                <h3 class="card-title">Journey Activity Log</h3>

                <div class="log-item">
                    <div class="log-timestamp">{{ $patient->created_at ? \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y h:i A') : '-' }}</div>
                    <div class="log-content">
                        <h4>Patient Registered</h4>
                        <p>Triage staff logged patient details into the central hospital queue dashboard.</p>
                    </div>
                </div>

                @if($patient->doctor_seen_at)
                <div class="log-item">
                    <div class="log-timestamp">{{ \Carbon\Carbon::parse($patient->doctor_seen_at)->format('d/m/Y h:i A') }}</div>
                    <div class="log-content">
                        <h4>General Medical Assessment Finished</h4>
                        <p>Diagnosis recorded: <strong>{{ $patient->preliminary_diagnosis ?? 'N/A' }}</strong>. Notes: "{{ $patient->doctor_notes ?? 'None' }}"</p>
                    </div>
                </div>
                @endif

                @if($patient->specialist_department)
                <div class="log-item">
                    <div class="log-timestamp">{{ $patient->doctor_seen_at ? \Carbon\Carbon::parse($patient->doctor_seen_at)->format('d/m/Y h:i A') : '-' }}</div>
                    <div class="log-content">
                        <h4>Specialist Routing Confirmed</h4>
                        <p>Patient assigned seamlessly to the <strong>{{ $patient->specialist_department }}</strong> clinical department under active load balancing criteria.</p>
                    </div>
                </div>
                @endif

                @if($patient->admitted_at)
                <div class="log-item">
                    <div class="log-timestamp">{{ \Carbon\Carbon::parse($patient->admitted_at)->format('d/m/Y h:i A') }}</div>
                    <div class="log-content">
                        <h4>Admitted to Ward Care</h4>
                        <p>
                            Assigned to <strong>{{ $patient->ward_name ?? $patient->ward->name ?? 'Ward Unassigned' }}</strong> 
                            (Bed: <strong>{{ $patient->bed_number ?? 'N/A' }}</strong>) 
                            under <strong>{{ $patient->doctor_name ?? $patient->doctor->name ?? 'Attending Doctor' }}</strong>.
                        </p>
                    </div>
                </div>
                @endif

                @if($patient->status == 'Deceased' || !empty($patient->time_of_death))
                <div class="log-item">
                    <div class="log-timestamp">{{ $patient->time_of_death ? \Carbon\Carbon::parse($patient->time_of_death)->format('d/m/Y h:i A') : '-' }}</div>
                    <div class="log-content">
                        <h4 style="color:#ef4444;">Patient Record Closed — Deceased</h4>
                        <p>Medical staff registered patient death. Inpatient file closed.</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Patient Profile -->
            <div class="card">
                <h3 class="card-title">Patient Profile</h3>

                <div class="profile-row">
                    <span class="profile-label">Name:</span>
                    <span class="profile-value">{{ $patient->name }}</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Gender / Age:</span>
                    <span class="profile-value">{{ $patient->gender }} ({{ $patient->age }} yrs)</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Status Flag:</span>
                    <span class="profile-value {{ $patient->status == 'Deceased' ? 'status-badge-deceased' : 'status-badge-admitted' }}">
                        {{ $patient->status }}
                    </span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Attending Doctor:</span>
                    <span class="profile-value">{{ $patient->doctor_name ?? $patient->doctor->name ?? 'Unassigned' }}</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Ward:</span>
                    <span class="profile-value">{{ $patient->ward_name ?? $patient->ward->name ?? 'Unassigned' }}</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Bed Number:</span>
                    <span class="profile-value">{{ $patient->bed_number ?? 'N/A' }}</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Temperature:</span>
                    <span class="profile-value">{{ $patient->temperature ? $patient->temperature . ' °C' : '-' }}</span>
                </div>

                <div class="profile-row">
                    <span class="profile-label">Blood Pressure:</span>
                    <span class="profile-value">
                        @if($patient->sbp && $patient->dbp)
                            {{ $patient->sbp }}/{{ $patient->dbp }} mmHg
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>