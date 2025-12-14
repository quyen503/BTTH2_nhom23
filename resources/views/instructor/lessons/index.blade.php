<h1>Bài học - {{ $course->title }}</h1>

<a href="/instructor/courses/{{ $course->id }}/lessons/create">
    + Thêm bài học
</a>

@foreach($lessons as $lesson)
    <div style="border:1px solid #ccc; padding:10px; margin-top:10px">
        <b>Bài {{ $lesson->order }}:</b> {{ $lesson->title }}
    </div>
@endforeach

<br>
<a href="/instructor/courses">⬅ Quay lại khóa học</a>
