<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vacancy Notification</title>
</head>
<body>
<p>Вакансия: {{ $vacancy->vacancy }}</p>
<p><a href="{{ route('application.search', ['vacancy_id' => $vacancy->id, 'user_id' => $user->id]) }}">Ссылка на отклик</a></p>
</body>
</html>
