<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/jobs/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($slide->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $slide->id; ?>">
              	<?php } ?>
              	<div class="box-body">
              	  <div class="form-group">
                  <?php render_tab_text('Job Position','job_position',(!isset($slide) ? '' : $slide->job_position),['type'=>'jobs','item'=>'job_position','ref'=>(isset($slide) ? $slide->id : 0)],'',100); ?>
                  <div class="form-group">
                    <label for="caption">Location</label>
                    <input class="form-control" type="text" name="location" placeholder="e.g. Jakarta, Tanggerang etc" value="<?php if(isset($slide->id)) echo $slide->location; ?>">
                  </div>
                  <div class="form-group">
                    <label for="caption">E-Mail to Apply</label>
                    <input class="form-control" type="text" name="email" placeholder="E-Mail Address" value="<?php if(isset($slide->id)) echo $slide->email; ?>">
                  	<p class="help-block">Applicant will able to send their application to this email address</p>
                  </div>
                  <?php render_tab_long_text('Job Description','description',(!isset($slide) ? '' : $slide->description),['type'=>'jobs','item'=>'description','ref'=>(isset($slide) ? $slide->id : 0)],'tinymce'); ?>
                  <?php render_tab_long_text('Requirement','requirement',(!isset($slide) ? '' : $slide->requirement),['type'=>'jobs','item'=>'requirement','ref'=>(isset($slide) ? $slide->id : 0)],'tinymce'); ?>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Vacancy</button>
              	</div>
            </form>
          </div>
</div>