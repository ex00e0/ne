@extends('layouts.header')
@section('title','регистрация')
@section('content')

@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="container">
<form action="{{route('reg')}}" method="post">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Имя</label>
        <input type="text" class="form-control" name="name">
     </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <button type="submit" class="btn btn-primary" style="background-color:#4964ac;">Отправить</button>
</form>
</div>
@endsection