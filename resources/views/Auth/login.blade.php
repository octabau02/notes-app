@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="tabcontent">
        <form method="POST" action="{{ route('login') }}">
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
