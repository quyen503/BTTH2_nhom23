<h2>Danh sách khóa học</h2>

<form method="GET">
    <input name="search" placeholder="Tìm khóa học">
    <button>Tìm</button>
</form>

<hr>

@foreach($courses as $course)
    <div>
        <h3>{{ $course->title }}</h3>
        <p>Giá: {{ $course->price }} VND</p>
    </div>
@endforeach

{{ $courses->links() }}
