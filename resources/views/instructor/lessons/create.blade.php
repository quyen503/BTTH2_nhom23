<h1>Thêm bài học - {{ $course->title }}</h1>

<form method="POST" action="/instructor/courses/{{ $course->id }}/lessons">
    @csrf

    <input type="text" name="title" placeholder="Tiêu đề bài học" required><br><br>

    <textarea name="content" placeholder="Nội dung bài học" required></textarea><br><br>

    <input type="number" name="order" placeholder="Thứ tự bài học" required><br><br>

    <button type="submit">Lưu bài học</button>
</form>

<br>
<a href="/instructor/courses/{{ $course->id }}/lessons">⬅ Quay lại</a>
