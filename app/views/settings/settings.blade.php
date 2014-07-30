@extends('layouts.master')

@section('scripts')
<script>
$(function() {

});
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">System Settings</h1>
    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical_for_files() }}
    {{ Former::text('emails_initial', 'Initial Emails')->value($settings['emails_initial'])->required() }}
    {{ Former::text('emails_application', 'Application Complete Emails')->value($settings['emails_application'])->required() }}
    {{ Former::text('emails_contact', 'Contact Form Emails')->value($settings['emails_contact'])->required() }}
    {{ Former::textarea('script_head', 'Global Head Scripts')->value($settings['script_head']) }}
    {{ Former::textarea('script_footer', 'Global Footer Scripts')->value($settings['script_footer']) }}
    {{ Former::textarea('robots', 'Robots.txt Content')->value($settings['robots']) }}
    
    <h2>Backgrounds</h2>
    @foreach($data_list['background_elements'] as $element)
    <h3>{{ $element['name'] }}</h3>
    <div class="row">
    	<div class="col-sm-3">
    		{{ Former::text($element['id'].'_color', 'HEX Color')->value($settings[$element['id'].'_color'])->required() }}
    	</div>
    	<div class="col-sm-3">
    		{{ Former::select($element['id'].'_type', 'Background Type')->options($data_list['background_image_types'])->value($settings[$element['id'].'_type'])->required() }}
    	</div>
    	<div class="col-sm-4">
    		{{ Former::file($element['image'], 'Background Image') }}
    	</div>
        <div class="col-sm-2">
            <img src="{{ asset('uploads/assets/backgrounds/'.$element['image'].'.png') }}" class="img-responsive" />
        </div>
    </div>
    @endforeach
    
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop