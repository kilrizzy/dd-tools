@extends('layouts.master')

@section('scripts')
<script>
$(function() {
	//Delete user button
	$('.btn_delete_user').click(function(){
		//confirm
		uid = $(this).attr("data-user-id");
		email = $(this).attr("data-user-email");
		var c = confirm('Are you sure you want to delete '+email+' (ID #'+uid+')?');
		if(c){
			$.ajax({
			    url: "{{URL::to('admin/user')}}",
			    type: 'DELETE',
			    data: { 
			        uid : uid 
			    },
			    success: function(data) {
			    	location.reload();
			    }     
			});
		}
	});
});
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">Users</h1>
    <div class="table-responsive">
	    <table class="table table-striped table-hover table-condensed">
	    	<thead>
	    		<tr>
	    			<th>Name</th>
	    			<th>Email</th>
	    			<th>Role</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach ($users as $u)
	    		<tr>
	    			<td>{{ $u->first_name }} {{ $u->last_name }}</td>
	    			<td>{{ $u->email }}</td>
	    			<td>
	    				@foreach ($u->getGroups() as $group)
	    				{{ $group->name }}
	    				@endforeach
	    			</td>
	    			<td>
	    				<a href="{{URL::to('admin/user/'.$u->id)}}" class="btn btn-success btn-sm">
						  <span class="glyphicon glyphicon-pencil"></span> Edit
						</a>
						<button type="button" class="btn btn-danger btn-xs btn_delete_user" data-user-id="{{ $u->id }}" data-user-email="{{ $u->email }}">
						  <span class="glyphicon glyphicon-trash"></span>
						</button>
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	</div>
</div>
@stop