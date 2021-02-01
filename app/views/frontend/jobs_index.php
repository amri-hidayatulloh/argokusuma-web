<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/'.get_option('contactus-cover')); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option_lang('job-sub-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option_lang('job-title'); ?></h1>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-md-center">

		<div class="col-11">
			<div class="line-separator no-padding no-margin"></div>
		</div>

		<div class="col-11">
			<div class="row about-headline about">
				<div class="col no-border text-center" style="padding-bottom: 0;padding-top: 0">
					<span><?php echo get_option_lang('job-vacancy'); ?></span>
					<h1 class="center"><?php echo get_option_lang('job-available'); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-11">
			<div class="row">
				<div class="col">
					<div class="card">
					<?php foreach ($jobs as $key => $value) { ?>
					  <div class="card-body">
						<div class="container-fluid">
						  <div class="row">
						    <div class="col-sm-8">
						      <h2><?php echo $value['job_position']; ?></h2>
						      <p><?php echo $value['location']; ?></p>
						    </div>
						    <div class="col-sm-4">
						    	<a href="mailto:<?php echo $value['email']; ?>">
						      		<button class="btn btn-primary btn-lg pull-right"><?php echo get_option_lang('job-apply'); ?></button>
						    	</a>
						    </div>
						    <div class="col-12">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
								  <li class="nav-item" role="presentation">
								    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" data-toggle="tab"><?php echo get_option_lang('job-description'); ?></a>
								  </li>
								  <li class="nav-item" role="presentation">
								    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" data-toggle="tab"><?php echo get_option_lang('job-requirement'); ?></a>
								  </li>
								</ul>
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><?php echo $value['description']; ?></div>
								  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php echo $value['requirement']; ?></div>
								</div>
						    </div>
						  </div>
						</div>
					  </div>
					</div>
					<?php } ?>
				</div>
			</div>
			<br><br>
		</div>
		
	</div>
</div>