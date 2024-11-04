@extends('layouts.header')
@section('title','подать заявку')
@section('content')

@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror


<div class="container">
<form action="{{route('appl')}}" method="post">
    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Текст заявки</label>
    <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="appl"></textarea>
    
  </div>
  <button type="submit" class="btn btn-primary" style="background-color:#4964ac;">Отправить</button>
</form>
</div>
@endsection