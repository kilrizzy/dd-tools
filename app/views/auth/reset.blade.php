@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="title">Reset Password</h1>
    <p>If you already know your password <a href="{{ URL::to('login') }}">Click here to return to login</a></p>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::email('email', 'Email')->placeholder('Email')->required()->value(Input::old('email')) }}
    {{ Former::actions( Former::default_submit('Reset My Password')->class('btn btn-primary') ) }}
    {{ Former::close() }}
</div>
@stop