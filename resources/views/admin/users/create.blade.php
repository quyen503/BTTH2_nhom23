@extends('layouts.app')

@section('content')
<h2>Thêm người dùng mới</h2>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <label>Tên:</label><br>
    <input name="name" required><br><br>

    <label>Email:</label><br>
    <input name="email" type="email" required><br><br>

    <label>Password:</label><br>
    <input name="password" type="password" required><br><br>

    <label>Role:</label><br>
    <select name="role">
        <option value="1">User</option>
        <option value="2">Admin</option>
    </select><br><br>

    <button type="submit">Thêm</button>
</form>
@endsection
