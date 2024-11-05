@extends('layouts.headerAdmin')
@section('title','создать пост')
@section('content')

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('text')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('image')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror


<div class="container">
<form action="{{route('create')}}" method="post">
    @csrf
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Заголовок поста</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Текст поста</label>
    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="text"></textarea>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Фото поста</label>
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image">
    
  </div>
  <button type="submit" class="btn btn-primary" style="background-color:#4964ac;">Отправить</button>
</form>
</div>
@endsection