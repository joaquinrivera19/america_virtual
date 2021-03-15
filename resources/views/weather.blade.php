<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AMERICA VIRTUAL</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f2f1 !important;
        }

        .bg-dark {
            background-color: #ff695a !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #ff695a;
            border-color: #ff695a;
        }

        .title_custom {
            color: #5e5eca !important;
        }

        .hr_title {
            border-top: 2px solid rgba(0, 0, 0, .1);
            background-color: #ff695b;
        }

        .hr_title_form {
            border-top: 2px solid rgba(0, 0, 0, .1);
            background-color: #5e5eca;
        }

        .sesion {
            font-size: 14px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
            background-color: #ff695b;
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">AMERICA VIRTUAL</a>

            @guest
            <button class="btn btn-light nav-link sesion" onclick="openForm()">INICIAR SESIÓN</button>
            @else
            <a class="navbar-brand" href="#">Bienvenido, {{ Auth::user()->name }}</a>

            <a class="btn btn-light nav-link sesion" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            @endguest

        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">




        <div class="row">
            <div class="col-md-12 mb-5 mt-5 text-center">
                <h4>SERVICIO DEL CLIMA</h4>
                <hr class="hr_title">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-5">

                <div class="card">
                    <div class="card-body">

                        {!! Form::open(array('route' => ['home.store', 'method' => 'POST'])) !!}

                        <h4 class="title_custom">Seleccioná la zona</h4>
                        <hr class="hr_title_form">
                        <div class="mb-3">
                            {!! Form::label('pais', 'País :', ['class' => 'form-label']) !!}
                            {!! Form::text('pais', null, ['class' => 'form-control','placeholder' => 'Selecciona un pais', 'required' => 'required']) !!}
                        </div>
                        <div class="mb-3">
                            {!! Form::label('ciudad', 'Ciudad :', ['class' => 'form-label']) !!}
                            {!! Form::text('ciudad', null, ['class' => 'form-control','placeholder' => 'Selecciona una ciudad', 'required' => 'required']) !!}
                        </div>

                        <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">BUSCAR</button>

                        {!! Form::close() !!}

                    </div>
                </div>

            </div>

            <div class="col-md-6 mb-5">


                <div class="card">
                    <div class="card-body">

                        <h4 class="title_custom">Reporte</h4>
                        <hr class="hr_title_form">

                        <div class="row align-items-start">
                            <div class="col">
                                <p>
                                    <small class="text-muted">{{$pais}}</small></br>
                                    <small class="text-muted">{{$ciudad}}</small>
                                </p>
                                <h3>Viernes</h3>
                                <h4>{{ $weathers_actual['weather'][0]['description'] }}</h4>

                                <h1 style="margin: 25px 0px;">{{ round($weathers_actual['main']['temp']) }} º C</h1>
                                <h4>{{ $weathers_actual['main']['temp'] }} º F</h4>

                            </div>
                            <div class="col">



                                <img src="{{ 'http://openweathermap.org/img/wn/' . $weathers_actual['weather'][0]['icon'] . '@2x.png' }}" class="card-img-top" alt="...">
                                <p>
                                    <small class="text-muted">Prob. de precipitaciones: 0 %</small></br>
                                    <small class="text-muted">Humedad: {{$weathers_actual['main']['humidity']}} %</small></br>
                                    <small class="text-muted">Viento: a {{$weathers_actual['wind']['speed']}} km/h</small>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>
        <!-- /.row -->

        <div class="row">
            <div class="card-group mb-5" style="width: 100%;">

                @foreach($resultado as $resul)

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center title_custom">{{ strtoupper($resul['fecha_nombre']) }}</h5>
                        <img src="{{ $resul['icon'] }}" class="card-img-top" alt="...">
                        <p class="card-text">{{ round ($resul['temp']) }} º C</p>
                        <p class="card-text">{{ $resul['temp'] }} º F</p>
                    </div>
                </div>

                @endforeach

            </div>
        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer style="background-color: #343a40!important; padding: 15px 0px;">
        <div class="container">
            <p class="m-0 text-left text-white">Copyright 2021 All right register America Virtual</p>
        </div>
        <!-- /.container -->
    </footer>


    <div class="form-popup" id="myForm">
        <form method="POST" action="{{ route('login') }}" class="form-container">
            @csrf
            <label style="margin-top: 15px;">Usuario</label>
            <input id="email" type="email" placeholder="americavirtual@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label style="margin-top: 15px;">Contraseña</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <button type="submit" class="btn">INICIAR SESIÓN</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Cerrar</button>
        </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        $(document).ready(function() {
            document.getElementById("myForm").style.display = "block";
        });

    </script>

</body>

</html>