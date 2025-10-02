<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Notas personales')</title>
    <style>
        header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        body{
            padding: 0 16rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
        }

        .justify-beetween{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-navbar{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .profile-navbar > span{
            display: block;
            padding: 5px;
        }

        .panel{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .items-panel{
            display: flex;
            flex-direction: column;
            align-items: center;;
        }

        .items-panel > p{
            margin: 5px 0;
        }

        .number{
            font-size: 24px;
            font-weight: bold;
        }

        .card{
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
            padding: 16px;
        }

        .card.important{
            border: 2px solid #e01b24;
            background-color: #fcf4f4;
        }

        .card > p{
            color: #71768d;
        }

        .card-header{
            display: flex;
            justify-content: space-between;
        }

        .notes{
            display: grid;
            grid-gap: 12px;
            grid-template-columns: 1fr 1fr 1fr;
        }

        h3{
            margin-top: 0;
        }

        .time{
            font-size: small;
        }

        dialog {
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .modal{
            width: 400px;
            border-radius: 10px;
        }

        .modal > p{
            color: #71768d;
        }

        .modal-footer{
            margin: 7px;
            display: flex;
            justify-content: end;
            gap: 3px;
        }

        .form-input{
            display: flex;
            flex-direction: column;
            padding: 5px;
        }

        .form-input>label {
            font-weight: bold;
        }

        .form-input > input{
            border-radius: 5px;
            height: 20px;
        }

        .form-input >input, textarea{
            border-radius: 5px;
            background-color: #f3f3f5;
            border: 1px solid #e5e7eb;
            padding: 8px;
        }

        .form-input.checkbox{
            flex-direction: row;
            align-items: center;
            gap: 5px;
        }

        textarea{
            resize: none;
        }

        .button-icon{
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .secondary-button{
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            border: 1px solid #71768d;
            background-color: white;
            cursor: pointer;
        }

        .secondary-button:hover{
            background-color: #f0f0f0

        }

        .create-button{
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            border: 1px solid #71768d;
            background-color: black;
            cursor: pointer;
        }



        .create-button:hover{
            background-color: rgb(41, 33, 33);
            color: white;
            border: 1px solid white;
        }
        .time{
            display: flex;
            align-items: center;
            gap: 5px;
            color: #71768d;
            font-size: small;
        }
        .icon{
            width: 20px;
        }

        .action-button{
            background-color: transparent;
            cursor: pointer;
            border: none;
        }

        .action-button:hover{
            border-bottom: 1px solid black;
        }

    </style>

</head>
<body>
    <header>
        <h1>Gestión de notas personales</h1>
        <div class="profile-navbar">
            <span>{{ auth()->user()->name }}</span>
            <span>{{ auth()->user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="secondary-button button-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M409 337C418.4 327.6 418.4 312.4 409 303.1L265 159C258.1 152.1 247.8 150.1 238.8 153.8C229.8 157.5 224 166.3 224 176L224 256L112 256C85.5 256 64 277.5 64 304L64 336C64 362.5 85.5 384 112 384L224 384L224 464C224 473.7 229.8 482.5 238.8 486.2C247.8 489.9 258.1 487.9 265 481L409 337zM416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L480 544C533 544 576 501 576 448L576 192C576 139 533 96 480 96L416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160C497.7 160 512 174.3 512 192L512 448C512 465.7 497.7 480 480 480L416 480z"/></svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>

    </footer>
</body>
</html>

