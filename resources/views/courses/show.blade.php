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
@auth
<form method="POST" action="{{ route('courses.enroll', $course->id) }}">
    @csrf
    <button type="submit">Đăng ký khóa học</button>
</form>
@else
<p><a href="{{ route('login') }}">Đăng nhập để đăng ký</a></p>
@endauth

</body>
</html>
