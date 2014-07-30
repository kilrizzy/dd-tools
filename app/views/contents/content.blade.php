@extends('layouts.master')

@section('scripts')
{{ HTML::script('/assets/resources/ckeditor/ckeditor.js') }}
{{ HTML::script('/assets/resources/ckeditor/adapters/jquery.js') }}
<script>
var slugset = false;
@if(!empty($content->slug))
slugset = true;
@endif

//
$(function() {
	//Slug Generate
	if(!slugset){
		$('#title').keyup(function(){
			setSlug($(this).val());
		});
	}
	//Editor
	CKEDITOR.stylesSet.add( 'my_styles', [
	    { name: 'Spaced', element: 'span', attributes: { 'class': 'spaced' } },
	    { name: 'Small Text', element: 'span', attributes: { 'class': 'small' } },
	    { name: 'Big Text', element: 'span', attributes: { 'class': 'big' } },
	    { name: 'Green Text', element: 'span', attributes: { 'class': 'green' } },
	    { name: 'Blue Text', element: 'span', attributes: { 'class': 'blue' } },
	    { name: 'Gray Text', element: 'span', attributes: { 'class': 'gray' } },
	    { name: 'Image Left', element: 'img', attributes: { 'class': 'left' } },
	    { name: 'Image Right', element: 'img', attributes: { 'class': 'right' } },
	    { name: 'Image Responsive', element: 'img', attributes: { 'class': 'img-responsive' }, styles:{ 'width': 'auto', 'height':'auto'} },
	]);
	$( '.ckeditor' ).ckeditor( 
		function() { 
			/* callback code */ 
		}, 
		{ 
			filebrowserBrowseUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=files') }}",
			filebrowserImageBrowseUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=images') }}",
			filebrowserFlashBrowseUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=flash') }}",
			filebrowserUploadUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=files') }}",
			filebrowserImageUploadUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=images') }}",
			filebrowserFlashUploadUrl : "{{ asset('assets/resources/kcfinder/browse.php?type=flash') }}",
			toolbar: [
				{ name: 'document', items: [ 'Source' ] },
			    { name: 'clipboard', items: [ 'PasteText', 'PasteFromWord' ] },
			    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Subscript', 'Superscript', 'RemoveFormat' ] },
			    { name: 'paragraph',   items: [ 'NumberedList', 'BulletedList', 'Blockquote', 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
			    { name: 'links', items: [ 'Link', 'Unlink' ] },
			    { name: 'insert', items: [ 'Image', 'HorizontalRule', 'PageBreak' ] },
			    { name: 'styles', items: [ 'Styles', 'Format', 'ShowBlocks' ] },
			],
			format_tags : 'p;ph1;ph2;h1;h2;h3;h4;h5;h6;pre;address;div',
			format_ph1 : { 
				name: 'H1 Paragraph',
				element : 'p', 
				attributes : { 'class' : 'h1' }
			},
			format_ph2 : { 
				name: 'H2 Paragraph',
				element : 'p', 
				attributes : { 'class' : 'h2' }
			},
			contentsCss : [ 
				CKEDITOR.getUrl( 'contents.css' ), 
				"{{ asset('assets/css/editor.css?r='.time().'') }}",
				"http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic",
				"http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800",
				"http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700,900,200italic,300italic,400italic,600italic,700italic"
			],
			stylesSet : 'my_styles'
		}
	);
});

function setSlug(title){
	var slug = title;
	slug = slug.toLowerCase();
	slug = slug.replace(/[^a-z\d\s]*/g,'');
	slug = slug.replace(/ /g,'_');
	$('#slug').val(slug);
}
</script>
@stop

@section('content')
<div class="container">
    <h1 class="title">Content</h1>

    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}
    {{ Former::text('title', 'Title')->placeholder('Title')->value($content->title)->required() }}
    {{ Former::text('slug', 'Slug')->placeholder('Slug')->value($content->slug)->required() }}
    {{ Former::textarea('data', 'Data')->value($content->data)->class('ckeditor') }}
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop