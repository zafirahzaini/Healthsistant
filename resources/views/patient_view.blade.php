<!DOCTYPE html>
<html>
<head>
    <title>Patient Medical Record</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Orbitron';
            background:#f5f7fb;
            color:#0f172a;
        }

        .container{
            max-width:1200px;
            margin:40px auto;
            padding:30px;
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .top-bar h1{
            font-size:40px;
            font-weight:700;
        }

        .back-btn{
            text-decoration:none;
            background:#991b1b;
            color:white;
            padding:12px 24px;
            border-radius:12px;
            transition:0.3s;
        }

        .back-btn:hover{
            background:#7f1d1d;
        }

        .card{
            background:white;
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            border-top:6px solid #dc2626;
        }

        .section-title{
            font-size:24px;
            margin-bottom:25px;
            color:#991b1b;
        }

        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:25px;
        }

        .info-box{
            background:#fff5f5;
            padding:20px;
            border-radius:18px;
            border:1px solid #fecaca;
        }

        .label{
            font-size:13px;
            color:#64748b;
            margin-bottom:10px;
        }

        .value{
            font-size:18px;
            font-weight:700;
            color:#0f172a;
        }

        .status{
            display:inline-block;
            padding:10px 20px;
            border-radius:30px;
            font-size:14px;
            font-weight:700;
        }

        .waiting{
            background:#fef3c7;
            color:#92400e;
        }

        .review{
            background:#dbeafe;
            color:#1d4ed8;
        }

        .admitted{
            background:#dcfce7;
            color:#166534;
        }

        .discharged{
            background:#fee2e2;
            color:#991b1b;
        }

        .notes{
            margin-top:30px;
            background:#fff5f5;
            padding:25px;
            border-radius:20px;
            border:1px solid #fecaca;
        }

        .notes p{
            margin-top:15px;
            line-height:1.8;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="top-bar">

        <h1>Patient Medical Record</h1>

        <a href="/patient/queue" class="back-btn">
            Back
        </a>

    </div>

    <div class="card">

        <h2 class="section-title">Patient Information</h2>

        <div class="grid">

            <div class="info-box">
                <div class="label">Patient Name</div>
                <div class="value">{{ $patient->name }}</div>
            </div>

            <div class="info-box">
                <div class="label">IC Number</div>
                <div class="value">{{ $patient->ic_number }}</div>
            </div>

            <div class="info-box">
                <div class="label">Age</div>
                <div class="value">{{ $patient->age }}</div>
            </div>

            <div class="info-box">
                <div class="label">Gender</div>
                <div class="value">{{ $patient->gender }}</div>
            </div>

            <div class="info-box">
                <div class="label">Race</div>
                <div class="value">{{ $patient->race }}</div>
            </div>

            <div class="info-box">
                <div class="label">Symptoms</div>
                <div class="value">{{ $patient->symptoms }}</div>
            </div>

            <div class="info-box">
                <div class="label">Temperature</div>
                <div class="value">{{ $patient->temperature }} °C</div>
            </div>

            <div class="info-box">
                <div class="label">Heart Rate</div>
                <div class="value">{{ $patient->heart_rate }}</div>
            </div>

            <div class="info-box">
                <div class="label">Respiratory Rate</div>
                <div class="value">{{ $patient->respiratory_rate }}</div>
            </div>

            <div class="info-box">
                <div class="label">Blood Pressure</div>
                <div class="value">
                    {{ $patient->sbp }}/{{ $patient->dbp }}
                </div>
            </div>

            <div class="info-box">
                <div class="label">Pulse</div>
                <div class="value">{{ $patient->pulse }}</div>
            </div>

            <div class="info-box">
                <div class="label">Patient Status</div>

                <div class="value">

                    @if($patient->status == 'Waiting')

                        <span class="status waiting">
                            Waiting
                        </span>

                    @elseif($patient->status == 'Under Review')

                        <span class="status review">
                            Under Review
                        </span>

                    @elseif($patient->status == 'Admitted')

                        <span class="status admitted">
                            Admitted
                        </span>

                    @else

                        <span class="status discharged">
                            Discharged
                        </span>

                    @endif

                </div>
            </div>

        </div>

        <div class="notes">

            <h2 class="section-title">
                Doctor Notes
            </h2>

            <p>

                {{ $patient->doctor_notes ?? 'No notes added yet.' }}

            </p>

        </div>

    </div>

</div>

</body>
</html>