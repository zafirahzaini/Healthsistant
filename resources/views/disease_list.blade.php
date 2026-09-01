<!DOCTYPE html>
<html>
<head>
    <title>Disease List</title>

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

        .navbar {
            display:flex;
            justify-content:space-between;
            padding:20px 50px;
            position:relative;
            z-index:2;
        }

        .navbar a {
            color:#ff00cc;
            text-shadow:0 0 10px #ff00cc;
            text-decoration:none;
            margin-left:20px;
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
            width:100%;
            background: rgba(255,255,255,0.05);
        }

        th, td {
            padding:10px;
            border:1px solid #00f7ff;
            text-align:center;
        }

    </style>
</head>

<body>

<div class="grid"></div>

<!-- NAVBAR -->
<div class="navbar">
    <h2>MedPredict AI</h2>
    <div>
        <a href="/">Home</a>
    </div>
</div>

<div class="container">

<h2>Disease List</h2>

@if(session('success'))
    <p style="color:lightgreen">{{ session('success') }}</p>
@endif

<table>
<tr>
    <th>ID</th>
    <th>Disease Name</th>
    <th>ICD Version</th>
</tr>

@foreach($diseases as $d)
<tr>
    <td>{{ $d->DiseaseID }}</td>
    <td>{{ $d->disease_name }}</td>
    <td>{{ $d->ICD_version }}</td>
</tr>
@endforeach
</table>

</div>

</body>
</html>