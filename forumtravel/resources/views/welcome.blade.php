<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Forum</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #f9f9f9;
            color: #333;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90%;
        }
        .content {
            text-align: center;
            padding: 50px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        .links {
            margin-top: 30px;
        }
        .links a {
            color: #333;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 20px;
            padding: 15px 30px;
            border: 2px solid #3498db;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-block;
            background-color: #a6ff4d !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .links a:hover {
            background-color: #3498db;
            color: #fff;
        }
        .footer {
            background-color: #e6ffcc;
            color: black;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-image: url('/images/gallery-2.jpg'); background-size: 100%;">
    <div class="container">
        <div class="content">
            <div class="header">
                <h1>Dobrodošli na Travel Forum</h1>
                <p>Povežite se sa kolegama putnicima, delite svoja iskustva i otkrijte nove destinacije.</p>
            </div>
            <div class="links">
            <a href="{{ route('threads.index') }}">Trenutne diskusije foruma</a>
                <a href="{{ route('login') }}">Prijavi se</a>
                <a href="{{ route('register') }}">Registruj se</a>
            </div>
        </div>
    </div>
    <div class="footer">
        &copy; 2024 Travel Forum. Sva prava zadržana.
    </div>
</body>
</html>
