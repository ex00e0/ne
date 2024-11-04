@extends('layouts.header')
@section('title','мои заявки')
@section('content')

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
    <p class="card-text">Статус: <?=$st?></p>
    <p class="card-text">{{$appl->text}}</p>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
<div style="height:1vmax;"></div>
@endforeach

</div>
@endsection