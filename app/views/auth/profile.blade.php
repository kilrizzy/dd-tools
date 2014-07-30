@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="title">My Account</h1>

    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::text('first_name', 'First Name')->placeholder('First Name')->value($user->first_name)->required() }}
    {{ Former::text('last_name', 'Last Name')->placeholder('Last Name')->value($user->last_name)->required() }}
    {{ Former::email('email', 'Email')->placeholder('Email')->value($user->email)->required() }}
    {{ Former::password('password', 'Password')->placeholder('Password')->help('Leave blank to keep existing') }}
    {{ Former::actions( Former::default_submit('Save')->class('btn btn-primary') ) }}
    {{ Former::close() }}
</div>
@stop