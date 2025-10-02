@extends('layouts.auth')

@section('title', 'Registrar nota')

@section('content')
    <div class="card">
    <form method="POST" action="/notes/store">
        @csrf
        <label for="title">Titulo</label>
        <input type="text" name="title" id="title">

        <label for="content">Contenido</label>
        <textarea type="text" name="content" id="content"></textarea>
        
        <button type="submit">Crear nota</button>
    </form>
    </div>
@endsection