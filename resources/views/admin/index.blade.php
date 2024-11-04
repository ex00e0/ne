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

@foreach ($appls as  $appl)

<div class="card" style="width: 18rem;">
  <div class="card-body">
  
     <?php if($appl->status == 'created') {$st = 'создана'; }
     else if ($appl->status == 'rejected') {$st = 'отклонена';} 
     else if ($appl->status == 'accepted') {$st = 'принята';} ?>


    <h5 class="card-title">Заявка № {{$appl->id}}</h5>
    <!-- <p class="card-text">Подал: {{$appl->id_user}}</p> -->
    <p class="card-text">Статус: <?=$st?></p>
    <p class="card-text" style="color:darkgrey;"><?= substr($appl->created_at, 8, 2).".".substr($appl->created_at, 5, 2).".".substr($appl->created_at, 0, 4)?></p>
    <p class="card-text">{{$appl->text}}</p>
    <?php if($appl->status == 'created') {?>
    <a href="{{route('accept', ['id'=>$appl->id])}}" class="btn btn-primary" style="background-color:#4964ac;">Принять</a>
    <a href="{{route('reject', ['id'=>$appl->id])}}" class="btn btn-danger">Отклонить</a>
    <? }?>
  </div>
</div>
<div style="height:1vmax;"></div>
@endforeach

</div>
@endsection