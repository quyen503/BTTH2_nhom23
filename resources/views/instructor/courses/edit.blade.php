<h1>Sửa khóa học</h1>

<form method="POST" action="/instructor/courses/{{ $course->id }}/update">
    @csrf
    <input type="text" name="title" value="{{ $course->title }}"><br><br>

    <textarea name="description">{{ $course->description }}</textarea><br><br>

    <select name="category_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                @if($course->category_id == $cat->id) selected @endif>
                {{ $cat->name }}
            </option>
        @endforeach
    </select><br><br>

    <input type="number" name="price" value="{{ $course->price }}"><br><br>
    <input type="number" name="duration_weeks" value="{{ $course->duration_weeks }}"><br><br>

    <select name="level">
        <option value="Beginner" @if($course->level=='Beginner') selected @endif>Beginner</option>
        <option value="Intermediate" @if($course->level=='Intermediate') selected @endif>Intermediate</option>
        <option value="Advanced" @if($course->level=='Advanced') selected @endif>Advanced</option>
    </select><br><br>

    <button type="submit">Cập nhật</button>
</form>
