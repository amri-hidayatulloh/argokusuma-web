<div class="container-fluid cover-area" style="background: url(<?php echo $data->cover; ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<h1 class="text-shadow">Pricing</h1>
		</div>
	</div>
</div>

<div class="container-fluid portfolio-container">
	<div class="row justify-content-md-center">
		<div class="col-9 blog-detail-area">
			<img src="<?php echo $data->thumb; ?>" class="cover">
			<span class="timestamp"><?php echo date('d F, Y H:i', strtotime($data->modified_date)); ?></span>
			<h1 class="title"><?php echo $data->pricing_name; ?></h1>
			<div class="content">
				<?php echo $data->description; ?>
			</div>

			<?php foreach ($features as $key => $value) { ?>
			<h2><?php echo $value['caption']; ?></h2>
			<table class="table table-dark table-striped">
				<thead>
					<tr>
						<th><?php echo $value['key_heading_label']; ?></th>
						<th><?php echo $value['value_heading_label']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($value['tables'] as $k => $v) { ?>
					<tr>
						<td><?php echo $v['key_value']; ?></td>
						<td><?php echo $v['value_value']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<br>

			<?php } ?>
			<hr>

			<h2 class="title"><?php echo get_option_lang('pricing-term'); ?></h1>
			<div class="content">
				<?php echo $data->payment_term; ?>
			</div>
		</div>
		<div class="col-3 sidebar-blog">
			<h2><?php echo get_option_lang('other-pricing'); ?></h2>
			<hr>

			<?php foreach($pricing as $key => $value): ?>
			<a href="<?php echo $value['url'] ;?>">
				<div class="popular-box">
					<img src="<?php echo $value['thumb']; ?>" class="thumb">
					<div class="text-area">
						<h3><?php echo $value['pricing_name'] ;?></h3>
						<p><?php echo $value['modified_date'] ;?></p>
					</div>
				</div>
			</a>
			<?php endforeach; ?>

		</div>
	</div>
	
</div>