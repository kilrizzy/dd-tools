@extends('layouts.master')

@section('scripts')
<script>
$(function() {
	//Delete character button
	$('.btn_delete_character').click(function(){
		//confirm
		id = $(this).attr("data-character-id");
		name = $(this).attr("data-character-name");
		var c = confirm('Are you sure you want to delete '+name+' (ID #'+id+')?');
		if(c){
			$.ajax({
			    url: "{{URL::to('admin/character')}}",
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
    <h1 class="title">Characters <a href="{{URL::to('admin/character')}}" class="btn btn-primary">Add New</a></h1>
    <div class="table-responsive">
	    <table class="table table-striped table-hover table-condensed">
	    	<thead>
	    		<tr>
	    			<th>Name</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach ($characters as $c)
	    		<tr>
	    			<td>{{ $c->name }}</td>
	    			<td>
	    				<a href="{{URL::to('admin/character/'.$c->id)}}" class="btn btn-success btn-sm">
						  <span class="glyphicon glyphicon-pencil"></span> Edit
						</a>
						<button type="button" class="btn btn-danger btn-xs btn_delete_character" data-character-id="{{ $c->id }}" data-character-name="{{ $c->name }}">
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