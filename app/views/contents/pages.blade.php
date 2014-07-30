@extends('layouts.master')

@section('scripts')
<script>
$(function() {
	//Delete user button
	$('.btn_delete_content').click(function(){
		//confirm
		id = $(this).attr("data-page-id");
		slug = $(this).attr("data-page-slug");
		var c = confirm('Are you sure you want to delete '+slug+' (ID #'+id+')?');
		if(c){
			$.ajax({
			    url: "{{URL::to('admin/page')}}",
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
    <h1 class="title">Pages</h1>
    <p><a href="{{URL::to('admin/page')}}" class="btn btn-primary">Add Page</a></p>
    <div class="table-responsive">
	    <table class="table table-striped table-hover table-condensed">
	    	<thead>
	    		<tr>
	    			<th width="30%">Name</th>
	    			<th width="50%">Slug</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach ($pages as $p)
	    		<tr>
	    			<td>{{ $p->name }}</td>
	    			<td>{{ $p->slug }}</td>
	    			<td>
	    				<a href="{{URL::to('admin/page/'.$p->id)}}" class="btn btn-success btn-sm">
						  <span class="glyphicon glyphicon-pencil"></span> Edit
						</a>
						<button type="button" class="btn btn-danger btn-xs btn_delete_page" data-page-id="{{ $p->id }}" data-page-slug="{{ $p->slug }}">
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