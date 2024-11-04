@extends('layouts.headerAdmin')
@section('title','заявки')
@section('content')
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>location.href='../index.php';</script>";
}
?>
@error('success')
    <script>alert("{{ $message }}");</script>
@enderror


<div class="container">

@foreach ($posts as  $appl)

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <img src="{{asset('images/posts/$appl->image')}}" class="card-img-top" alt="...">


    <h5 class="card-title">{{$appl->title}}</h5>
    <p class="card-text">{{$appl->text}}</p>
    <p class="card-text" style="color:darkgrey;"><?= substr($appl->created_at, 8, 2).".".substr($appl->created_at, 5, 2).".".substr($appl->created_at, 0, 4)?></p>

    <!-- <a href="{{route('accept', ['id'=>$appl->id])}}" class="btn btn-primary" style="background-color:#4964ac;">Принять</a>
    <a href="{{route('reject', ['id'=>$appl->id])}}" class="btn btn-danger">Отклонить</a> -->

  </div>
</div>
<div style="height:1vmax;"></div>
@endforeach

</div>
@endsection