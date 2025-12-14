<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách khóa học</title>
</head>
<body>

<h1>Danh sách khóa học</h1>

@foreach ($courses as $course)
    <div style="border:1px solid #ccc; padding:10px; margin:10px">
        <h3>{{ $course->name }}</h3>

        <p>{{ $course->description }}</p>

        <strong>Giá: {{ number_format($course->price) }} VND</strong>
        <br><br>

        <a href="{{ route('courses.show', $course->id) }}">
            Xem chi tiết
        </a>
    </div>
@endforeach

</body>
</html>
