@extends('layouts.app')

@section('content')
<h2>Chỉnh sửa người dùng</h2>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label>Tên:</label><br>
    <input name="name" value="{{ $user->name }}" required><br><br>

    <label>Email:</label><br>
    <input name="email" type="email" value="{{ $user->email }}" required><br><br>

    <label>Role:</label><br>
    <select name="role">
        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>User</option>
        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
    </select><br><br>

    <button type="submit">Cập nhật</button>
</form>
@endsection
