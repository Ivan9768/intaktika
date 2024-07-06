<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ ограничен</title>
    <!-- Подключение Bootstrap через CDN -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/assets/css/style.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .message-box {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="message-box">
        <h1 class="display-4">Ваш аккаунт забанен</h1>
        <p class="lead">Пожалуйста, свяжитесь с поддержкой для получения дополнительной информации.</p>
        <button class="btn btn-outline-primary">
            <a href="{{ route('home') }}">{{__('На главную')}}</a>
        </button>
    </div>
</div>

</body>
</html>
