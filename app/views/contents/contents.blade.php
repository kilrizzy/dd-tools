@extends('layouts.master')

@section('scripts')
<script>
$(function() {
	//Delete user button
	$('.btn_delete_content').click(function(){
		//confirm
		id = $(this).attr("data-content-id");
		slug = $(this).attr("data-content-slug");
		var c = confirm('Are you sure you want to delete '+slug+' (ID #'+id+')?');
		if(c){
			$.ajax({
			    url: "{{URL::to('admin/content')}}",
			    type: 'DELETE',
			    data: { 
			        id : id 
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
    <h1 class="title">Content Blocks</h1>
    <p><a href="{{URL::to('admin/content')}}" class="btn btn-primary">Add Content Block</a></p>
    <div class="table-responsive">
	    <table class="table table-striped table-hover table-condensed">
	    	<thead>
	    		<tr>
	    			<th>Slug</th>
	    			<th>Title</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach ($contents as $c)
	    		<tr>
	    			<td>{{ $c->slug }}</td>
	    			<td>{{ $c->title }}</td>
	    			<td>
	    				<a href="{{URL::to('admin/content/'.$c->id)}}" class="btn btn-success btn-sm">
						  <span class="glyphicon glyphicon-pencil"></span> Edit
						</a>
						<button type="button" class="btn btn-danger btn-xs btn_delete_content" data-content-id="{{ $c->id }}" data-content-slug="{{ $c->slug }}">
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