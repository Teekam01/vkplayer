
@extends('layouts.master')

@section('head')
<title>VK Ludo Player - Play Ludo King Win Real Money</title>
@endsection



@section('content')


<div class="main-area" style="padding-top: 60px;">
<?php $i=1; ?>
	@foreach($winners as $row)
	<div class="d-flex px-4 py-3 list-item">
		<picture class="mr-3" style="font-size:20px; color:#c1c1c1"># {{ $i }}</picture><img class="border-50" height="30px" width="30px" src="{{asset('frontend/images/avatars/Avatar2.png')}}" alt="">
		<div style="margin-top:-7px"><span class="font-9 fw-800 d-flex" style="font-size:20px"> &nbsp;{{$row->vplay_id}} </span><small class="d-flex font-7 " style="    line-height: 7px;" > &nbsp; Total Win: {{$row->total_win}}</small>
		</div>
	</div>
	<?php $i++; ?>
	@endforeach
</div>
@endsection
