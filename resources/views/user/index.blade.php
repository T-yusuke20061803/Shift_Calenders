@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザー管理</h1>
    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>Email</th>
                <th>カラー</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="color" name="color" value="{{ $user->color }}">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </td>
                <td>
                    <!-- 他のアクションボタン -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
