@extends('layouts.master')

@section('content')

<div class="container"> 
	{{ Former::framework('TwitterBootstrap3') }}
	{{ Former::open_vertical_for_files()->id('form-company-information') }}
		{{ Former::file('myfile','File')->accept('gif', 'jpg')->max(5, 'MB') }}
	    <p><button type="submit" class="btn btn-primary btn-lg bt-submit">Upload</button></p>
	{{Former::close()}}
</div>
@stop