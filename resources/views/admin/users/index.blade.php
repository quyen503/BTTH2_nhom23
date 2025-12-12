@extends('layouts.app')

@section('content')
<h2>Danh sách người dùng</h2>

<a href="{{ route('admin.users.create') }}">+ Thêm người dùng</a>

<table border="1" cellpadding="10" style="margin-top: 20px;">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Role</th>
        <th>Hành động</th>
    </tr>

    @foreach ($users as $u)
    <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role == 2 ? 'Admin' : 'User' }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $u->id) }}">Sửa</a>

            <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xoá user này?')">Xoá</button>
            </form>

            @if ($u->role == 1)
                <a href="/admin/users/role/{{ $u->id }}/2">Set Admin</a>
            @else
                <a href="/admin/users/role/{{ $u->id }}/1">Set User</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
