@extends('admin.master')


@section('head')
 @if(isset($game)) <title>Edit Game</title> @else <title>Add Game</title> @endif
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"> @if(isset($game)) Edit @else Add @endif Game</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">GAME @if(isset($game)) EDIT @else CREATE @endif</h6>
		</div>
		<div class="card-body">
		@if(isset($game))
		  
		    <form action="{{ url('admin/games/update/'.$game->id) }}" method="post" enctype="multipart/form-data">
		@else
		   <form action="{{ url('admin/games') }}" method="post" enctype="multipart/form-data">
		@endif
			
				@csrf

				<div class="com-md-12">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="staticEmail" name="name" @if(isset($game)) value="{{ $game->game_name }}"  @else  placeholder="Enter a name of Game"  @endif required>
						</div>
					</div>
				</div>
				
				<div class="com-md-12">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
						<div class="col-sm-10">
						 @if(isset($game)) 
					        <img src="{{asset('/images/games/'.$game->game_image)}}" alt="image not uploaded" style="height:auto; width:80px;" />
                           <input type="file" class="form-control"  name="image"  value="{{ $game->game_image }}">
                             <p>Image resolution must be  110*110</p>
						 
							@else
							  <input type="file" class="form-control" id="staticEmail" name="image" placeholder="Enter a name of Game" required>
							   <p>Image resolution must be 110*110</p>

							@endif
							
						</div>
					</div>
				</div>
				
				<div class="com-md-12">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">API URL</label>
						<div class="col-sm-10">
							<input type="url" class="form-control" id="staticEmail" name="api_url" @if(isset($game)) value="{{ $game->api_url }}"  @else placeholder="Enter a API  URL" @endif required>
						</div>
					</div>
				</div>
				
				<div class="com-md-12">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<select name="status" id="" class="form-control" required>
								<option value="1" @if(isset($game)) @if($game->status=='1') selected @endif @endif>Active</option>
								<option value="0"  @if(isset($game)) @if($game->status=='0') selected @endif @endif>De-Active</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Custom Code</label>
					<div class="col-sm-10">
						<select class="form-control" name="customcode" value="" aria-label="Default select example">
							<option value="1" @if(isset($game))@if ($game->customcode ) {{ 'selected' }} @endif @endif>Enable</option>
							<option value="0"@if(isset($game)) @if (!$game->customcode ) {{ 'selected' }} @endif @endif >Disable</option>
						  </select>
					</div>
				</div>
				
				<div class="com-md-12">
					<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
					@if(isset($game)) 
					 	<input type="submit" value="Update" class="btn btn-primary">
					@else  
						<input type="submit" value="Submit" class="btn btn-primary">
					@endif
						
						<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
						</div>
					</div>
				</div>
				
		
				</form>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
