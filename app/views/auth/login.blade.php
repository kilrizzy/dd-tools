@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="title">Login</h1>
    <div class="alert alert-info fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4>First Time Logging In?</h4>
      <p><strong>While you were working on your application we emailed you access to login to manage your account.</strong></p>
      <p><em>Can't find the email?</em></p>
      <p>
        <a href="{{ URL::to('reset') }}" class="btn btn-primary">Click Here to Have a New Email Sent</a>
        <a href="{{ URL::to('contact') }}" class="btn btn-primary">Or Contact Us</a>
      </p>
      <p>Otherwise, login below with your email address and password</p>
    </div>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::email('email', 'Email')->placeholder('Email')->required()->value(Input::old('email')) }}
    {{ Former::password('password', 'Password')->placeholder('Password')->required() }}
    {{ Former::actions( Former::default_submit('Sign in')->class('btn btn-primary') ) }}
    {{ Former::close() }}
</div>
@stop