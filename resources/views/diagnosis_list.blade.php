<!DOCTYPE html>
<html>
<head>
    <title>Diagnosis List</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin:0;
            font-family:'Orbitron';
            color:white;
            background: radial-gradient(circle at top, #0f0c29, #090016);
        }

        .grid {
            position:fixed;
            width:100%;
            height:100%;
            background-image:
                linear-gradient(rgba(0,255,255,0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,255,0.1) 1px, transparent 1px);
            background-size:40px 40px;
            animation:moveGrid 10s linear infinite;
        }

        @keyframes moveGrid {
            from { transform:translateY(0);}
            to { transform:translateY(40px);}
        }

        .container {
            position:relative;
            z-index:2;
            padding:40px;
        }

        h2 {
            text-shadow:0 0 10px #a020f0, 0 0 20px #ff00cc;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: rgba(255,255,255,0.05);
        }

        th, td {
            padding: 10px;
            border: 1px solid #00f7ff;
            text-align: center;
        }

    </style>
</head>

<body>

<div class="grid"></div>

<div class="container">

<h2>Diagnosis List</h2>

@if(session('success'))
    <p style="color:lightgreen">{{ session('success') }}</p>
@endif

<table>
<tr>
    <th>ID</th>
    <th>Complaint</th>
    <th>Disease</th>
    <th>Acuity</th>
</tr>

@foreach($diagnosis as $d)
<tr>
    <td>{{ $d->DiagnosisID }}</td>
    <td>{{ $d->chief_complaint }}</td>
    <td>{{ $d->disease_name }}</td>
    <td>{{ $d->acuity_level }}</td>
</tr>
@endforeach
</table>

</div>

</body>
</html>