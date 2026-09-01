<!DOCTYPE html>
<html>
<head>

    <title>Vital Signs Monitoring</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Poppins',sans-serif;
    }

    body{
        background:#f5f2eb;
    }

    .main-container{
        display:flex;
    }

    .content{
        flex:1;
        padding:40px;
    }

    .page-title{
        font-size:40px;
        font-weight:700;
        color:#92400e;
    }

    .subtitle{
        color:#92400e;
        margin-top:10px;
        margin-bottom:30px;
    }

    .card{
        background:white;
        border-radius:25px;
        padding:30px;
        box-shadow:0 4px 15px rgba(0,0,0,.05);
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th{
        background:#f59e0b;
        color:white;
        padding:15px;
        text-align:left;
    }

    td{
        padding:15px;
        border-bottom:1px solid #eee;
    }

    .btn{
        background:#f59e0b;
        color:white;
        text-decoration:none;
        padding:10px 18px;
        border-radius:10px;
        display:inline-block;
    }

    </style>

</head>

<body>

<div class="main-container">

    @include('layouts.nurse_cardiology_sidebar')

    <div class="content">

        <h1 class="page-title">
            Vital Signs Monitoring
        </h1>

        <p class="subtitle">
            Select a patient to record vital signs
        </p>

        <div class="card">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($patients as $patient)

                    <tr>

                        <td>{{ $patient->PatientID }}</td>

                        <td>{{ $patient->name }}</td>

                        <td>{{ $patient->status }}</td>

                        <td>

                            <a href="/nurse-cardiology/vitals/{{ $patient->PatientID }}"
                               class="btn">

                                Record Vitals

                            </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>