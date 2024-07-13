<!--ユーザー識別-->
@extends('layouts.app')

@section('content')
    <div class = "container">
        <h1>{{$user->name}}</h1>
        <p>{{$user->email}}</p>
    </div>
    
@extends