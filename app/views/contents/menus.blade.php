@extends('layouts.master')

@section('scripts')
<script>
$(function() {
	//Delete user button
	$('.btn_delete_menu').click(function(){
		//confirm
		id = $(this).attr("data-menu-id");
		slug = $(this).attr("data-menu-slug");
		var c = confirm('Are you sure you want to delete '+slug+' (ID #'+id+')?');
		if(c){
			$.ajax({
			    url: "{{URL::to('admin/menu')}}",
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
    <h1 class="title">Menus</h1>
    <p><a href="{{URL::to('admin/menu')}}" class="btn btn-primary">Add Menu Item</a></p>
    @foreach($menu_categories as $menu_category)
    <h2>{{$menu_category['name']}}</h2>
    <div class="table-responsive">
	    <table class="table table-striped table-hover table-condensed">
	    	<thead>
	    		<tr>
	    			<th width="30%">Name</th>
	    			<th width="50%">Path</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach ($menu_category['items'] as $m)
	    		<tr>
	    			<td>{{ $m->name }}</td>
	    			<td>{{ $m->path }}</td>
	    			<td>
	    				<a href="{{URL::to('admin/menu/'.$m->id)}}" class="btn btn-success btn-sm">
						  <span class="glyphicon glyphicon-pencil"></span> Edit
						</a>
						<button type="button" class="btn btn-danger btn-xs btn_delete_menu" data-menu-id="{{ $m->id }}" data-menu-slug="{{ $m->name }}">
						  <span class="glyphicon glyphicon-trash"></span>
						</button>
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	</div>
	@endforeach
</div>
@stop