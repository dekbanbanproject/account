<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>รพ.ภูเขียว</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo150.ico') }}">

    <link href="{{ asset('bt52/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Plugin css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Edu VIC WA NT Beginner', cursive;
        }

        body {
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),
                url(/pkclaim/public/sky16/images/bgPK00.jpg)no-repeat 50%;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            position: relative;
        }


        &::hover {
            background: aliceblue;
            color: gray;
            font-weight: 500;
        }

        .circle1 {
            position: absolute;
            width: 290px;
            height: 290px;
            background: rgba(240, 248, 255, 0.1);
            border-radius: 50%;
            top: 70%;
            left: 80%;
            z-index: -1;
            animation: float 2s 0.5s ease-in-out infinite;
        }

        .circle2 {
            position: absolute;
            width: 190px;
            height: 190px;
            background: rgba(240, 248, 255, 0.1);
            border-radius: 50%;
            top: -30%;
            right: 25%;
            z-index: -1;
            animation: float 2s ease-in-out infinite;
        }

        .circle3 {
            position: absolute;
            width: 230px;
            height: 230px;
            background: rgba(240, 248, 255, 0.1);
            border-radius: 50%;
            top: 50%;
            right: 80%;
            z-index: -1;
            animation: float 2s 0.7s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <br><br>

    <div class="container">
        <div class="circle1"> </div>
        <div class="circle2"> </div>
        <div class="circle3"> </div>
        <div class="flex justify-center">
            <div class="main-content">
                <div class="page-content">

                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script></script>
</body>

</html>
