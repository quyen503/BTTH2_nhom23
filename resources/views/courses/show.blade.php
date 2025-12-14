<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $course->name }}</title>
</head>
<body>

<h1>{{ $course->name }}</h1>

<p>{{ $course->description }}</p>

<strong>Giá: {{ number_format($course->price) }} VND</strong>

<br><br>
<a href="{{ url('/courses') }}">← Quay lại</a>

</body>
</html>
