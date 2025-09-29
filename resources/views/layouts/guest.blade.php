<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Iniciar Sesión / Registro')</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
        }

        h1 {
            font-size: large;
        }

        main {
            display: flex;
            justify-content: center;
            height: 100vh;
            align-items: center;
        }

        card {
            width: 25vw;
            background-color: #ffffff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 20px;
        }

        .form-items {
            display: flex;
            flex-direction: column;
            padding: 5px;
        }

        .form-items>label {
            font-weight: bold;
        }

        .form-items>input {
            border-radius: 5px;
            background-color: #f3f3f5;
            border: 1px solid #e5e7eb;
            padding: 5px;
        }

        .form-items>button {
            background-color: #030212;
            color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            border-radius: 10px;
        }

        .tablinks {
            text-decoration: none;
            color: #030212;
            padding: 8px 64px;
            border-radius: 10px;
        }

        /* Style the buttons that are used to open the tab content */
        .tab a {
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
            margin: 5px 0;
        }

        /* Change background color of buttons on hover */
        .tab a:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab a.active {
            background-color: #fff;
        }

        /* Style the tab content */
        .tabcontent {}
    </style>
</head>

<body>
    <main>
        <card>
            <h1>Gestión de notas personales</h1>
            <p>Accede o crea un cuenta para gesionar tus notas</p>

            <div class="tab">
                <a href="/login" class="tablinks">Iniciar sesión</button>
                    <a href="/register" class="tablinks">Registrarse</a>
            </div>
            @yield('content')
        </card>
    </main>
    <script>
        var currentPath = window.location.pathname;
        var tabLinks = document.querySelectorAll('.tab a.tablinks');

        tabLinks.forEach(function(link) {
            if (currentPath === link.getAttribute('href')) {
                link.classList.add('active');
            }
       });
    </script>
</body>

</html>
