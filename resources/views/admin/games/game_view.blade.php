@extends('admin.master')


@section('head')
<title>View Game</title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a> View Game</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">GAME VIEW</h6>
		</div>
		<div class="card-body">
			<table class="table table-stripped">
		    	<tr>
					 <th>Game ID</th>
					 <td>{{ $game->game_id }}</td>
		 		</tr>
		 		<tr>
					 <th>Game ID</th>
					 <td>{{ $game->game_name }}</td>
		 		</tr>
		 		<tr>
					 <th>Game Image</th>
					 <td><img src="{{ asset('/images/games/'.$game->game_image) }}" style="width:140px"> </td>
		 		</tr>
		 		<tr>
					 <th>API URL</th>
					 <td>{{ $game->api_url }}</td>
		 		</tr>
		 		<tr>
					 <th>Status</th>
					 <td>@if($game->status==1) Active @else De-Active @endif</td>
		 		</tr>
			</table>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
