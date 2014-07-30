@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="title">User</h1>

    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::text('first_name', 'First Name')->placeholder('First Name')->value($edituser->first_name)->required() }}
    {{ Former::text('last_name', 'Last Name')->placeholder('Last Name')->value($edituser->last_name)->required() }}
    {{ Former::email('email', 'Email')->placeholder('Email')->value($edituser->email)->required() }}
    {{ Former::select('role', 'Role')->options($data_list['roles'])->value($edituser->group) }}
    @if($edituser->id == 0)
    {{ Former::password('password', 'Password')->placeholder('Password')->required() }}
    @else
    {{ Former::password('password', 'Password')->placeholder('Password')->help('Leave blank to keep existing') }}
    @endif
    {{ Former::text('url', 'Author URL')->value($edituser->url)->placeholder('https://plus.google.com/u/12345678910')->help('If user is an administrator / author, include Google Plus URL') }}
    {{ Former::text('partner_key', 'Partner Key')->value($edituser->partner_key)->help('http://bizlender.com/a/[partner_key]') }}
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop