<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/'.get_option_lang('pricing-cover')); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option_lang('pricing-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option_lang('pricing-sub-title'); ?></h1>
		</div>
	</div>
</div>


<div class="container-fluid portfolio-container">
	<div class="row justify-content-md-center">
		<div class="col-12 card-area blog">
			<div class="card-columns" id="project-container">
				<?php foreach($pricing as $key => $value): ?>
					<a href="<?php echo $value['url'] ;?>">
					  <div class="card blog">
					    <img class="card-img-top img-fluid" src="<?php echo $value['thumb'] ;?>" alt="Card image cap">
					 	<div class="text-area">
					 		<span><?php echo date('d F Y', strtotime($value['modified_date'])) ;?></span>
					 		<h1><?php echo $value['pricing_name'] ;?></h1>
					 		<p><?php echo $value['snippet'] ;?></p>
					 		<a href="<?php echo $value['url'] ;?>"><?php echo get_option_lang('read-more'); ?></a>
					 	</div>
					  </div>
				  	</a>
			  	<?php endforeach; ?>
			</div>	
				  
		</div>
	</div>
</div>