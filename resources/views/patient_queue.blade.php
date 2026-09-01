<!DOCTYPE html>
<html>
<head>

    <title>Patient Queue</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        .main-container{
    display:flex;
    min-height:100vh;
}

.sidebar{
    width:290px;
    background:linear-gradient(180deg,#166534,#14532d);
    padding:30px 22px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.logo-section{
    margin-bottom:40px;
}

.logo{
    display:flex;
    align-items:center;
    gap:14px;
}

.logo-box{
    width:58px;
    height:58px;
    border-radius:18px;
    background:rgba(255,255,255,0.15);
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

.logo h2{
    color:white;
}

.logo-sub{
    color:rgba(255,255,255,0.75);
    margin-top:10px;
    font-size:13px;
}

.menu-title{
    color:rgba(255,255,255,0.5);
    margin-bottom:15px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    color:white;
    text-decoration:none;
    padding:14px;
    border-radius:14px;
    margin-bottom:10px;
}

.menu a:hover{
    background:rgba(255,255,255,0.1);
}

.menu .active{
    background:white;
    color:#166534;
}

.logout-btn a{
    display:flex;
    justify-content:center;
    gap:10px;
    background:white;
    color:#166534;
    padding:15px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
}

.content{
    flex:1;
    padding:35px;
}

        body{
            font-family:'Poppins',sans-serif;
            background:#f5f5f5;
            margin:0;
            padding:0px;
        }

        .container{
            width:100%;
        }

        .stats{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border-top:5px solid #16a34a;
    border-radius:20px;
    padding:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

.stat-card h2{
    color:#166534;
    margin-bottom:10px;
}

        .welcome-card{
    background:white;
    padding:20px 30px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    text-align:right;
}

.welcome-card h3{
    color:#166534;
    margin-bottom:8px;
}

.welcome-card p{
    color:#6b7280;
}

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .title{
            font-size:42px;
            font-weight:700;
            color:#111827;
        }

        .search-box{
            position:relative;
        }

        .search-box input{
            width:320px;
            padding:15px 20px;
            border:none;
            border-radius:14px;
            background:white;
            box-shadow:0 5px 20px rgba(0,0,0,0.05);
            font-family:'Poppins',sans-serif;
            outline:none;
        }

        .table-card{
            background:white;
            border-radius:25px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            border-top:6px solid #16a34a;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            text-align:left;
            padding:18px;
            color:#6b7280;
            font-size:14px;
            border-bottom:1px solid #e5e7eb;
        }

        td{
            padding:20px 18px;
            border-bottom:1px solid #f3f4f6;
            color:#111827;
            font-size:15px;
        }

        tr:hover{
            background:#fafafa;
        }

        .badge{
            padding:8px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:600;
        }

        .waiting{
            background:#fef3c7;
            color:#92400e;
        }

        .discharged{
            background:#fee2e2;
            color:#b91c1c;
        }

        .btn{
            background:linear-gradient(135deg,#166534,#16a34a);
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:12px;
            cursor:pointer;
            font-weight:600;
            font-size:14px;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-2px);
        }

    </style>

</head>

<body>

<div class="main-container">
    
@include('layouts.doctor_sidebar')

    <div class="content">
    <div class="container">
    <div class="top-bar">

    <div>
        <div class="title">
            Patient Queue
        </div>
        <p style="color:#6b7280;margin-top:10px;">
            Review queued patients and perform medical assessment
        </p>
    </div>
    <div style="display:flex;gap:20px;align-items:center;">

    <div class="search-box">
        <input
            type="text"
            id="searchInput"
            placeholder="Search patient ID, name or IC..."
        >
    </div>

    <div class="welcome-card">
        <h3>
            Welcome,
            {{ session('name') }}
        </h3>
        <p>Doctor</p>
    </div>

</div>

    </div>

    <div class="stats">

    <div class="stat-card">
        <h2>{{ $patients->count() }}</h2>
        <p>Patients In Queue</p>
    </div>

    <div class="stat-card">
    <h2>
        {{ $patients->where('status','Waiting')->count() }}
    </h2>
    <p>Waiting Patients</p>
</div>

</div>

    <div class="table-card">

        <table id="patientTable">
            <thead>
                <tr>
                    <th>Queue No</th>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>IC Number</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Symptoms</th>
                    <th>Assigned Doctor</th>
                    <th>Registration Time</th>
                    <th>Waiting Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($patients as $index => $patient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patient->PatientID }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->ic_number }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->symptoms }}</td>
                    <td>

@if($patient->assigned_doctor)

    {{ $patient->assigned_doctor }}

@else

    Not Assigned

@endif

</td>
                    <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        @php
                            $waitingTime =
                            \Carbon\Carbon::parse($patient->created_at)
                            ->diffForHumans(now(), true);
                        @endphp
                        {{ $waitingTime }}
                         </td>
                    <td>

                        @if($patient->status == 'Waiting')

                            <span class="badge waiting">
                                {{ $patient->status }}
                            </span>

                        @elseif($patient->status == 'Discharged')

                            <span class="badge discharged">
                                {{ $patient->status }}
                            </span>

                        @else

                            <span class="badge">
                                {{ $patient->status }}
                            </span>

                        @endif

                        </td>

                    <td>

                        <a href="/patient/action/{{ $patient->PatientID }}">

                            <button class="btn">
                                Take Action
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<script>

    const searchInput =
    document.getElementById("searchInput");

    searchInput.addEventListener("keyup", function() {

        const filter =
        searchInput.value.toLowerCase();

        const rows =
        document.querySelectorAll("#patientTable tbody tr");

        rows.forEach(row => {

            const text =
            row.innerText.toLowerCase();

            if(text.includes(filter)){

                row.style.display = "";

            }else{

                row.style.display = "none";
            }

        });

    });

</script>

</div>
</div>
</body>
</html>