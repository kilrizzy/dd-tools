<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h2>Send Us An Email</h2>
		<div id="get_started">
			{{ Former::framework('TwitterBootstrap3') }}
			{{ Former::open_vertical('contact')->id('form-contact') }}
			<div class="row">
				<div class="col-sm-6">
					{{ Former::text('first_name','First Name')->placeholder('First Name')->required() }}
				</div>
				<div class="col-sm-6">
					{{ Former::text('last_name','Last Name')->placeholder('Last Name')->required() }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					{{ Former::email('email','Email Address')->placeholder('Email Address')->required() }}
				</div>
				<div class="col-sm-6">
					{{ Former::text('phone_number','Phone Number')->placeholder('Phone Number')->required() }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					{{ Former::textarea('comments','Question / Comments')->required() }}
				</div>
			</div>
			<p><button type="submit" class="btn btn-primary btn-lg">Send Email</button></p>
			{{Former::close()}}
		</div>
	</div>
</div>