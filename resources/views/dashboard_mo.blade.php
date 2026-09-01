<!DOCTYPE html>
<html>
<head>
    <title>Medical Officer Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { margin:0; font-family:'Orbitron'; color:white; background: radial-gradient(circle at top, #0f0c29, #090016); }
        .grid { position:fixed; width:100%; height:100%; background-image: linear-gradient(rgba(0,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,255,255,0.1) 1px, transparent 1px); background-size:40px 40px; animation:moveGrid 10s linear infinite; }
        @keyframes moveGrid { from{transform:translateY(0);} to{transform:translateY(40px);} }
        .navbar { display:flex; justify-content:space-between; padding:20px 50px; position:relative; z-index:2; }
        .navbar a { color:#ff00cc; margin-left:20px; text-shadow:0 0 10px #ff00cc; }
        .container { padding:40px; position:relative; z-index:2; }
        h2 { text-shadow:0 0 10px #a020f0, 0 0 20px #ff00cc; }
        a { color:#00f7ff; text-decoration:none; }
        button { margin-top:20px; padding:10px; background:linear-gradient(45deg,#ff00cc,#00f7ff); border:none; border-radius:5px; }
    </style>
</head>

<body>

<div class="grid"></div>

<div class="navbar">
    <h2>MedPredict AI</h2>
    <div><a href="/">Home</a></div>
</div>

<div class="container">

<h2>Medical Officer Dashboard</h2>

<p>Welcome {{ session('name') }}</p>

<ul>
    <li><a href="/patient/list">View Patients</a></li>
    <li><a href="/diagnosis/list">View Diagnosis</a></li>
</ul>

<a href="/logout">
    <button>Logout</button>
</a>

</div>

</body>
</html>