@extends('layouts.master')

@section('scripts')
<script>
$(function() {

});
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">Menu Item</h1>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::select('menu', 'Menu')->options($menu_types)->value($menu->menu)->required() }}
    {{ Former::text('name', 'Name')->placeholder('Name')->value($menu->name)->required() }}
    {{ Former::text('path', 'Path')->placeholder('Path')->value($menu->path)->required() }}
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop