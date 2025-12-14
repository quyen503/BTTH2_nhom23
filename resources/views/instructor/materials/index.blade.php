<h1>Tài liệu - {{ $lesson->title }}</h1>

<a href="/instructor/lessons/{{ $lesson->id }}/materials/create">
    + Upload tài liệu
</a>

@foreach($materials as $file)
    <div style="border:1px solid #ccc; padding:10px; margin-top:10px">
        📄 {{ $file->filename }}
    </div>
@endforeach

<br>
<a href="/instructor/courses/{{ $lesson->course_id }}/lessons">
    ⬅ Quay lại bài học
</a>
