<h1>Khóa học của tôi</h1>

<a href="/instructor/courses/create">+ Tạo khóa học mới</a>

@foreach($courses as $course)
    <div style="border:1px solid #ccc; padding:10px; margin-top:10px">
        <h3>{{ $course->title }}</h3>
        <a href="/instructor/courses/{{ $course->id }}/edit">Sửa</a> |
        <a href="/instructor/courses/{{ $course->id }}/delete"
           onclick="return confirm('Xóa khóa học?')">Xóa</a>
    </div>
@endforeach
