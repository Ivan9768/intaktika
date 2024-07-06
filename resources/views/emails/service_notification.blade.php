<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vacancy Notification</title>
</head>
<body>
<p>Услуга: {{ $service->title }}</p>
<p>Комментарий: {{ $comment }}</p>
<p><a href="{{ route('application-service.search', ['id' => $uv]) }}">Ссылка на заявку</a></p>
</body>
</html>
