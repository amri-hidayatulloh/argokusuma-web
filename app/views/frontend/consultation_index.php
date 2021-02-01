<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/'.get_option('aboutus-cover')); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option_lang('consult-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option_lang('consult-sub-title'); ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid common-section grey">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<h1><?php echo get_option_lang('consult-teams-heading'); ?></h1>
		</div>
		<div class="col-11">
			<div class="teams-box">
				<?php foreach ($teams as $key => $value) { ?>
				<div class="team">
					<img src="<?php echo site_url('medias/teams/'.$value['photo']); ?>">
					<div class="text">
						<h1><?php echo $value['name']; ?></h1>
						<span><?php echo $value['position']; ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>		
	</div>
</div>

<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<h1 style="padding-bottom: 20px"><?php echo get_option_lang('consult-contact-heading'); ?></h1>
		</div>
		<div class="col-11 text-center">
			<?php 
			foreach ($contact as $key => $value) { 

			$icon = [
				'phone' => 'fa-phone',
				'whatsapp' => 'fa-whatsapp',
				'telegram' => 'fa-paper-plane',
				'email' => 'fa-envelope',
				'facebook' => 'fa-facebook',
				'twitter' => 'fa-twitter',
				'url' => 'fa-link'
			];

			$link = $value['channel_value'];
			$value['channel_type'] = trim($value['channel_type']);

			if($value['channel_type'] == 'phone') {
				$link = "tel:".$value['channel_value'];
			} else if($value['channel_type'] == 'telegram') {
				$link = "https://t.me/".$value['channel_value'];
			} if($value['channel_type'] == 'whatsapp') {
				$link = "https://wa.me/".$value['channel_value'];
			} if($value['channel_type'] == 'email') {
				$link = "mailto:".$value['channel_value'];
			} if($value['channel_type'] == 'facebook') {
				$link = "https://facebook.com/".$value['channel_value'];
			} if($value['channel_type'] == 'twitter') {
				$link = "https://twitter.com/".$value['channel_value'];
			} 

			?>
			<a href="<?php echo $link; ?>" target="_blank">
				<button class="btn btn-primary btn-lg" style="width: 80%;margin-bottom: 20px;"><i class="fa <?php echo $icon[trim($value['channel_type'])]; ?>"></i> <?php echo $value['label']; ?></button>
			</a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<span class="sub"><?php echo get_option_lang('aboutus-bottom-subtitle'); ?></span><br>
			<h1><?php echo get_option_lang('aboutus-bottom-title'); ?></h1>
			<p><?php echo get_option_lang('aboutus-bottom-body'); ?></p>
			<a href="<?php echo site_url('contact-us'); ?>">
				<button class="blue medium">Contact Us&nbsp;&nbsp;<img src="<?php echo site_url('assets/static/arrowsubscribe.png'); ?>" height="15"></button>
			</a>
		</div>
		<div class="col-11">
			<br><br>
		</div>
	</div>
</div>