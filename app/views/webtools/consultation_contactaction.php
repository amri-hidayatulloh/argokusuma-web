<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/consultation/save_contact'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($slide->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $slide->id; ?>">
              	<?php } ?>
              	<div class="box-body">
              	  <div class="form-group">
                    <label for="link">Channel Type </label>
                    <select class="form-control" name="channel">
                      <option value="phone" <?php if(isset($slide->id) and $slide->channel_type == 'phone') echo 'selected'; ?>>Phone Number</option>
                      <option value="whatsapp" <?php if(isset($slide->id) and $slide->channel_type == 'whatsapp') echo 'selected'; ?>>Whatsapp</option>
                      <option value="telegram" <?php if(isset($slide->id) and $slide->channel_type == 'telegram') echo 'selected'; ?>>Telegram</option>
                      <option value="email" <?php if(isset($slide->id) and $slide->channel_type == 'email') echo 'selected'; ?>>E-Mail</option>
                      <option value="facebook" <?php if(isset($slide->id) and $slide->channel_type == 'facebook') echo 'selected'; ?>>Facebook</option>
                      <option value="twitter" <?php if(isset($slide->id) and $slide->channel_type == 'twitter') echo 'selected'; ?>>Twitter</option>
                      <option value="url" <?php if(isset($slide->id) and $slide->channel_type == 'link') echo 'selected'; ?>>Web URL</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="caption">Username/Link/Number</label>
                    <input class="form-control" type="text" name="link" placeholder="e.g. argokusuma, +620836xxxx" value="<?php if(isset($slide->id)) echo $slide->channel_value; ?>">
                  </div>

                  <?php render_tab_text('Label','label',(!isset($slide) ? '' : $slide->label),['type'=>'consult-contact','item'=>'label','ref'=>(isset($slide) ? $slide->id : 0)],'',100); ?>

                  <?php render_tab_long_text('Greeting Message','initial_text',(!isset($slide) ? '' : $slide->initial_text),['type'=>'consult-contact','item'=>'initial_text','ref'=>(isset($slide) ? $slide->id : 0)],''); ?>

                 <fieldset>
                 	<legend>Language Availibility</legend>
                 	<?php foreach ($languages as $key => $value) { ?>
                 		<div class="checkbox">
						  <label>
						    <input type="checkbox" value="<?php echo $value['keylang']; ?>" name="lang[]">
						    <?php echo $value['label']; ?>
						  </label>
						</div>
                 	<?php } ?>
                 </fieldset>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Contact Channel</button>
              	</div>
            </form>
          </div>
</div>