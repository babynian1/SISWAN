<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>SISWAN - @yield('title')</title>

    <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .login-container {
            width: 450px;
            margin: auto;
        }

        .login-container::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="h-screen login-container">
        <div class="relative flex z-10 items-center justify-center my-10"><img src="{{asset('assets/gif/logo.gif')}}" /></div>
        <div class="relative m-auto z-10 text-cyan-900	 text-center mb-4 uppercase font-roboto font-bold desktop:text-xl">
            SISWAN - RSIA Puri Bunda
        </div>
        @yield('content')
    </div>


    <<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    @yield('javascript')
</body>

</html>

