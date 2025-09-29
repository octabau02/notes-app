@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="tabcontent">
        <form method="POST" action="/login">
            @csrf
            <div class="form-items">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" placeholder="correo@email.com" value="{{old('email')}}">
            </div>
            <div class="form-items">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="********" autocomplete="off"/>
            </div>
            <div class="form-items">
                <button class="submit-button" type="submit" >Iniciar Sesión</button>
            </div>
        </form>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div>
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
        @endif
    </div>
@endsection

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Gestión de notas personales</h1>
    <P>Accede o crea una cuenta para gestionar tus notas</P>

    <form method="POST" action="/login">
    @csrf

    <label for="email">Correo</label>
    <input type="email" name="email" id="email" placeholder="correo@email.com" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="********" autocomplete="off"/>

    <button type="submit">Iniciar Sesión</button>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>
-->
