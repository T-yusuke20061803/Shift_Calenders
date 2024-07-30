<!-- resources/views/admin/users.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザー管理</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>Email</th>
                <th>役割</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('reader.users.updateRole', $user) }}" method="POST">
                        @csrf
                        <select name="role" onchange="this.form.submit()">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>一般ユーザー</option>
                            <option value="admin" {{ $user->role == 'reader' ? 'selected' : '' }}>管理者</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
