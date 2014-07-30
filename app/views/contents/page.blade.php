@extends('layouts.master')

@section('scripts')
<script>
$(function() {

});
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">Page</h1>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::text('name', 'Name')->placeholder('Name')->value($page->name)->required() }}
    {{ Former::text('slug', 'Slug')->placeholder('Slug')->value($page->slug)->required() }}
    
    <h2>Page Blocks</h2>
    <table class="table">
    @foreach($page->datarendered['blocks'] as $bid => $block)
    	<tr>
	    	<td width="50%">{{ Former::select('block['.$bid.'][slug]', 'Slug')->options($options['slugs'])->value($block['slug']) }}</td>
	    	<td width="30%">{{ Former::select('block['.$bid.'][style]', 'Style')->options($options['block_styles'])->value($block['style']) }}</td>
            <td width="20%">@if(!empty($block['slug']))<label class="control-label">{{ $block['slug'] }}</label><a href="<?php $c = Content::getFromSlug($block['slug']); if($c){ echo URL::to('admin/content/'.$c->id);  } ?>" class="btn btn-primary btn-block">Edit</a>@endif</td>
    	</tr>
    @endforeach
    </table>
    <h2>Page Meta</h2>
    {{ Former::text('meta[title]', 'Title')->placeholder('Leave blank to use page title')->value($page->datarendered['meta']['title']) }}
    {{ Former::text('meta[description]', 'Description')->value($page->datarendered['meta']['description']) }}
    {{ Former::text('meta[keywords]', 'Keywords')->value($page->datarendered['meta']['keywords']) }}
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop