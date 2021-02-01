<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/'.get_option('contactus-cover')); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option_lang('suggestion-sub-heading'); ?></span>
			<h1 class="text-shadow"><?php echo get_option_lang('suggestion-heading'); ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center">

		<div class="col-11">
			<div class="row about-headline about">
				<div class="col no-border text-center" style="padding-top:0">
					<span><?php echo get_option_lang('get-in-touch'); ?></span>
					<h1 class="center"><?php echo get_option_lang('suggestion-heading'); ?></h1>
					<form action="<?php echo site_url('home/suggestsubmission/'.$csrf_token); ?>" method="post" class="ajax-form-csrf">
					  <div class="form-row">
					    <div class="col-12">
					      <input type="text" class="form-control" name="name" placeholder="Name">
					    </div>
					    <div class="w-100"><br></div>
					    <div class="col">
					      <input type="text" class="form-control" name="email" placeholder="E-Mail">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" name="phone" placeholder="HP/Telp No">
					    </div>
					    <div class="w-100"><br></div>
					    
					    <div class="col-12">
					      <textarea class="form-control" name="message" placeholder="<?php echo get_option_lang('suggestion-heading'); ?>" rows="7"></textarea>
					    </div>
					    <div class="w-100"><br></div>
					    <div class="col-12">
					    	<button class="blue medium sbt" type="submit">Submit</button>
					    	<button class="blue medium ldr" type="button" style="display: none"><i class="fa fa-spinner fa-spin"></i></button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>