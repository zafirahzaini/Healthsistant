<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            color: white;
            min-height: 100vh;

            background: radial-gradient(circle at top, #0f0c29, #090016);
        }

        .grid {
            position: fixed;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0,255,255,0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,255,0.1) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: moveGrid 10s linear infinite;
            z-index: 0;
        }

        @keyframes moveGrid {
            from { transform: translateY(0); }
            to { transform: translateY(40px); }
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px 50px;
            position: relative;
            z-index: 2;
        }

        .navbar h2 {
            color: #00f7ff;
        }

        .navbar a {
            color: #ff00cc;
            margin-left: 20px;
            text-decoration: none;
            text-shadow: 0 0 10px #ff00cc;
        }

        .container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
        }

        .box {
            background: rgba(255,255,255,0.05);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            text-align: center;
            width: 320px;

            box-shadow: 
                0 0 10px #00f7ff,
                0 0 20px #ff00cc;
        }

        h2 {
            margin-bottom: 20px;
            text-shadow: 
                0 0 10px #a020f0,
                0 0 20px #ff00cc;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

            background: linear-gradient(45deg, #ff00cc, #00f7ff);
            color: black;
            font-weight: bold;
        }

        button:hover {
            box-shadow: 0 0 15px #ff00cc;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>

<div class="grid"></div>

<!-- NAVBAR -->
<div class="navbar">
    <h2>MedPredict AI</h2>
    <div>
        <a href="/">Home</a> <!-- ✅ ADDED -->
        <a href="/login">Login</a>
    </div>
</div>

<div class="container">
    <div class="box">

        <h2>Register</h2>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Age" required>

            <select name="role" required>
                <option value="">Select Role</option>
                <option value="medical officer">Medical Officer</option>
                <option value="nurse">Nurse</option>
                <option value="operation manager">Operation Manager</option>
                <option value="doctor">Doctor</option>
            </select>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Register</button>
        </form>

    </div>
</div>

</body>
</html>