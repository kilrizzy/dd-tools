@extends('layouts.master')

@section('scripts')
<script>
$(function() {

});
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">Search / Replace</h1>
    <div class="alert alert-warning">
        <p><strong>Note:</strong> Be careful, this is a non-reverable find / replace that will replace code from existing content blocks</p> 
        <p>Use the "Search Only" action first to make sure your find/replace will provide the desired effect</p>
    </div>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::text('search', 'Search')->placeholder('Search')->value($search)->required() }}
    {{ Former::text('replace', 'Replace')->placeholder('Replace')->value($replace) }}
    {{ Former::select('action', 'Action')->value($action)->options(array('search'=>"Search Only",'replace'=>"Replace Content"))->required() }}
    {{ Former::actions( Former::default_submit('Run') ) }}
    {{ Former::close() }}

    <h2>Results</h2>
    @if($results)
    {{ $results }}
    @endif
</div>
@stop