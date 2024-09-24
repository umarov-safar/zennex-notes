<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zennex - TheNoter</title>

        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 90vh;
                font-family: athelas, georgia, serif;
            }

            div {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            div h1 {
                color: #E801BD;
                font-weight: bolder;
                font-size: 120px;
            }

            a {
                text-decoration: none;
            }

            .btn {
                padding: 14px 20px;
                color: white;
                background: #E801BD;
                border-radius: 20px;
                font-size: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>Zennex - MyNoter App</h1>
            <a class="btn" href="{{ route('api-docs') }}">API документация</a>
        </div>
    </body>
</html>
