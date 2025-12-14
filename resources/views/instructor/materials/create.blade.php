<h1>Upload tài liệu - {{ $lesson->title }}</h1>

<form method="POST"
      action="/instructor/lessons/{{ $lesson->id }}/materials"
      enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" required><br><br>

    <button type="submit">Upload</button>
</form>

<br>
<a href="/instructor/lessons/{{ $lesson->id }}/materials">⬅ Quay lại</a>
