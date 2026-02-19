@extends('layouts.admin') @section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        
        .navbar {
            background-color: #5d29d6;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar h1 {
            font-size: 24px;
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
        }
        
        .container {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-card {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .welcome-card h2 {
            color: #5d29d6;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h1>Nusa Indo</h1>
        <a href="/">Logout</a>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>Selamat Datang di Dashboard</h2>
            <p>Anda telah berhasil login.</p>
        </div>
    </div>

</body>
</html>
@endsection