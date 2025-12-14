<h1>Tạo khóa học mới</h1>

<form method="POST" action="/instructor/courses">
    @csrf
    <input type="text" name="title" placeholder="Tên khóa học" required><br><br>

    <textarea name="description" placeholder="Mô tả" required></textarea><br><br>

    <select name="category_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select><br><br>

    <input type="number" name="price" placeholder="Giá"><br><br>
    <input type="number" name="duration_weeks" placeholder="Số tuần"><br><br>

    <select name="level">
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
    </select><br><br>

    <button type="submit">Lưu</button>
</form>
