
<div class="col-xs-12">
  <div class="box box-danger">
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
          <div class="col-md-12">
          	<div class="col-md-7">
          		<a href="<?php echo site_url('webtools/submission/exportsuggestion'); ?>" class="btn btn-md btn-danger"><i class="fa fa-file"></i>&nbsp;&nbsp;Export Suggestions (CSV)</a>
          	</div>
	        <form action="<?php echo site_url('webtools/submission/suggestion/'); ?>" method="post">
	        <div class="input-group col-md-5 pull-right">
		      <input type="text" class="form-control" placeholder="Search" value="<?php echo $keyword; ?>" name="keyword">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
		      </span>
		    </div>
		    </form>
          </div>
        </div>
    </div>
  </div>

  <input type="hidden" id="meta_keyword" value="<?php echo $keyword; ?>">
  <input type="hidden" id="post_type" value="review">

  <?php foreach ($content['content'] as $key => $value) { ?>
  <div data-id="<?php echo $value['id']; ?>" class="bs-callout">
    <div class="box-body">
        <div class="row">
          <div class="col-md-12">
          
          	<h4 style="margin-bottom: 0px;margin-top: 0;">
          		
          		<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				     <i class="fa fa-user"></i>
				  </button>
				</div>
				<strong><?php echo ucwords($value['name']); ?></strong><br><br>
				<p>E-Mail: <?php echo $value['email']."<br>  Phone: ".$value['phone']; ?></p>
          	</h4>
          	<h6 style="margin-top: 4px;margin-bottom: 15px">
          		<?php echo date('F, d Y',strtotime($value['created_date'])); ?>
          		<br>
          	</h6>
         	
         	<p align="left">
         		<?php echo $value['suggestion']; ?>
         	</p>

          <p><small>IP Address <?php echo $value['ip_address']; ?>&nbsp;(<?php echo $value['user_agent']; ?>)</small></p>

         	<div class="btn-group button-area" role="group" aria-label="..." style="margin-top: 10px">
         		<a href="#" class="btn btn-danger btn-md trigger-comment-delete btn-delete" data-target="submission" data-method="deletesuggestion" data-id="<?php echo $value['id']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
         	</div>
          </div>
        </div>
    </div>
  </div>
  <?php } ?>
  <div class="btn-group pull-right" aria-label="">
  	<a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/submission/suggestion/'.$content['pagination']['first']); ?>">First</a>
  	<?php if(isset($content['pagination']['prev'])) { ?><a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/submission/suggestion/'.$content['pagination']['prev']); ?>">Prev</a><?php } ?>
  	<?php for($i = $content['pagination']['endpoint'][0]; $i <= $content['pagination']['endpoint'][1]; $i++) { ?>
  	<a class="btn btn-<?php echo ($page == $i) ? 'danger' : 'default'; ?> btn-md" role="group" href="<?php echo site_url('webtools/submission/suggestion/'.$i); ?>"><?php echo $i; ?></a>
  	<?php } ?>
  	<?php if(isset($content['pagination']['next'])) { ?><a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/submission/suggestion/'.$content['pagination']['next']); ?>">Next</a><?php } ?>
  	<a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/submission/suggestion/'.$content['pagination']['last']); ?>">Last</a>
  </div>


</div>
