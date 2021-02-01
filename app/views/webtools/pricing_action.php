
<div class="col-xs-12">
	<div class="box">
		<?php if($action == 'add'): ?>
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-eye"></i>&nbsp;Pricing Information</a></li>
		    <li role="presentation"><a style="color: #888;opacity: 0.8;cursor: not-allowed;" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list"></i>&nbsp;Quotation Features</a></li>
		</ul>
		<?php else: ?>
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" <?php if($tab == "") echo 'class="active"'; ?>><a href="<?php echo site_url('webtools/pricing/action/edit/'.$data['id']); ?>"><i class="fa fa-eye"></i>&nbsp;Pricing Information</a></li>
		    <li role="presentation" <?php if($tab == "quote") echo 'class="active"'; ?>><a href="<?php echo site_url('webtools/pricing/action/edit/'.$data['id'].'/quote'); ?>"><i class="fa fa-list"></i>&nbsp;Quotation Features</a></li>
		</ul>
		<?php endif; ?>
		<?php if(empty($tab)): ?>

			<form role="form" method="POST" action="<?php echo site_url('webtools/pricing/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
	            <?php if(isset($data['id'])) { ?>
	            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
	            <?php } ?>
	            <div class="box-body">
	            	<div class="row">
	            		<div class="col-md-9">

			                <?php render_tab_text('Pricing Title','pricing_name',(!isset($data) ? '' : $data['pricing_name']),['type'=>'pricing','item'=>'pricing_name','ref'=>(isset($data) ? $data['id'] : 0)],'',200); ?>
			                
			               	<div class="form-group" style="display: flex;justify-content: space-between;align-items: center; flex-wrap: wrap;">
			                  	<fieldset style="width: 100%">
			                  		<legend>Cover Image Background</legend>
			                  	</fieldset>
			                  	<?php render_uploader('cover',((isset($data) and !empty($data['cover_image'])) ? site_url('medias/services/'.$data['cover_image']) : ''),'Cover Background',['100%','200px'],['1024px','300px']); ?>
			                </div>

			                <?php render_tab_long_text('Description','description',(!isset($data) ? '' : $data['description']),['type'=>'pricing','item'=>'description','ref'=>(isset($data) ? $data['id'] : 0)],'tinymce'); ?>
			                <?php render_tab_long_text('Payment Term','payment_term',(!isset($data) ? '' : $data['payment_term']),['type'=>'pricing','item'=>'payment_term','ref'=>(isset($data) ? $data['id'] : 0)],'tinymce'); ?>
	            		</div>
	            		<div class="col-md-3">
	            			<div class="panel panel-default">
							  <div class="panel-heading">Publish Setting</div>
							  <div class="panel-body">
							      <div class="form-group">
								    <label>Save As</label>
								    <select class="form-control" name="state">
								    	<option value="1"  <?php if(isset($data) and $data['is_active'] == 1) echo 'checked'; ?>>Publish</option>
								    	<option value="2"  <?php if(isset($data) and $data['is_active'] == 2) echo 'checked'; ?>>Draft</option>
								    </select>
								  </div>
								  <div class="form-group">
								    <label>Timestamp</label>
								    <input type="text" class="form-control datetimepickerall" name="timestamp" value="<?php echo (isset($data)) ? $data['created_date'] : date('Y-m-d H:i:s'); ?>">
								  </div>
							  </div>
							</div>
	            			<fieldset>
	            				<legend>Thumbnail Image</legend>
	            			</fieldset>
	            			<?php render_uploader('thumbnail_image',((isset($data) and !empty($data['thumbnail_image'])) ? site_url('medias/services/'.$data['thumbnail_image']) : ''),'Thumbnail Square',['100%','220px'],['200px','200px']); ?>
	            			<br>
	            			
	            		</div>
	            		<div class="col-md-12">
	            			<br><hr>
	            			<button class="btn btn-danger btn-md tinymce-content submit-btn-file" data-rel="#ajax-form-file">Save Pricing info and Set Quote</button>
	            			<button class="btn btn-default btn-md" type="reset">Reset</button>
	            		</div>
	            	</div>
	            </div>
	        </form>

	    <?php elseif($tab == 'quote'): ?>
	            <div class="box-body">
	            	<div class="row">
	            		<div class="col-md-12" id="quote-area">
	            			<?php if(count($features) == 0) { ?>
	            			<form action="<?php echo site_url('webtools/pricing/savequote'); ?>" method="post" class="ajax-form">
	            				<input type="hidden" name="pricingid" value="<?php echo $data['id']; ?>">
		            			<input type="hidden" name="id" value="">
		            			<div class="panel panel-default">
								  <div class="panel-body">
								    <?php render_tab_text('Quote Table Caption','feature_title','',['type'=>'pricing-quote','item'=>'feature-title','ref'=>0],'',200); ?>
								  	<table class="table table-bordered">
									  <thead>
									  	<tr>
									  		<th style="background: #e0e0e0"><input type="text" name="featurekeycaption" class="form-control" placeholder="Heading Text Key (e.g. Item)"></th>
									  		<th style="background: #e0e0e0"><input type="text" name="featurevaluecaption" class="form-control" placeholder="Heading Text Value (e.g. Price)"></th>
									  		<th width="50px">&nbsp;</th>
									  	</tr>
									  </thead>
									  <tbody class="content">
									  	<tr>
									  		<td><input type="text" name="featurekeycol[]" class="form-control" placeholder="e.g. Item A (Your item on quote)"></td>
									  		<td><input type="text" name="featurevalcol[]" class="form-control" placeholder="e.g. Rp3,0000,000.00/M2"></td>
									  		<td><button type="button" class="btn btn-sm btn-danger remove-this-row"><i class="fa fa-trash"></i></button></td>
									  	</tr>
									  </tbody>
									  <tbody>
									  	<tr>
									  		<td colspan="2"><button type="button" class="btn btn-md btn-default addrowquote" style="width: 100%">+ Add More Row</button></td>
									  		<td></td>
									  	</tr>
									  </tbody>
									</table>
									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-primary btn-md">Save Changes</button>
										</div>
									</div>
								  </div>
								</div>
							</form>
							<?php 
							} else {
								foreach ($features as $key => $value) {
							?>
								<form action="<?php echo site_url('webtools/pricing/savequote'); ?>" method="post" class="ajax-form">
		            				<input type="hidden" name="pricingid" value="<?php echo $data['id']; ?>">
			            			<input type="hidden" name="id" value="<?php echo $value['id']; ?>">
			            			<div class="panel panel-default">
									  <div class="panel-body">
									    <?php render_tab_text('Quote Table Caption','feature_title',$value['caption'],['type'=>'pricing-quote','item'=>'feature-title','ref'=>$value['id']],'',200,'Quote'.($key+1)); ?>
									  	<table class="table table-bordered">
										  <thead>
										  	<tr>
										  		<th style="background: #e0e0e0"><input type="text" name="featurekeycaption" class="form-control" placeholder="Heading Text Key (e.g. Item)" value="<?php echo $value['key_heading_label']; ?>"></th>
										  		<th style="background: #e0e0e0"><input type="text" name="featurevaluecaption" class="form-control" placeholder="Heading Text Value (e.g. Price)" value="<?php echo $value['value_heading_label']; ?>"></th>
										  		<th width="50px">&nbsp;</th>
										  	</tr>
										  </thead>
										  <tbody class="content">
										  	<?php foreach ($value['rows'] as $row) { ?>
										  	<tr>
										  		<td><input type="text" name="featurekeycol[]" class="form-control" placeholder="e.g. Item A (Your item on quote)" value="<?php echo $row['key_value']; ?>"></td>
										  		<td><input type="text" name="featurevalcol[]" class="form-control" placeholder="e.g. Rp3,0000,000.00/M2" value="<?php echo $row['value_value']; ?>"></td>
										  		<td><button type="button" class="btn btn-sm btn-danger remove-this-row"><i class="fa fa-trash"></i></button></td>
										  	</tr>
											<?php } ?>
										  </tbody>
										  <tbody>
										  	<tr>
										  		<td colspan="2"><button type="button" class="btn btn-md btn-default addrowquote" style="width: 100%">+ Add More Row</button></td>
										  		<td></td>
										  	</tr>
										  </tbody>
										</table>
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-primary btn-md">Save Changes</button>
												<button class="btn btn-danger btn-md remove-quote" data-id="<?php echo $value['id']; ?>">Remove</button>
											</div>
										</div>
									  </div>
									</div>
								</form>
							<?php } } ?>
	            		</div>
	            		<div class="col-md-12">
	            			<br>
	            			<button type="button" class="btn btn-danger btn-md" id="addnewquote" style="width: 100%">+ Add New Quote Table</button>
	            			<br>
	            		</div>
	            	</div>
	            </div>

	    <?php endif; ?>

	</div>
</div>


<script type="template" id="template-panel-quote" style="display: none">
	<form action="<?php echo site_url('webtools/pricing/savequote'); ?>" method="post" class="ajax-form">
	    <input type="hidden" name="pricingid" value="<?php echo $data['id']; ?>">
		<input type="hidden" name="id" value="">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php render_tab_text('Quote Table Caption','feature_title','',['type'=>'pricing-quote','item'=>'feature-title','ref'=>0],'',200,'QuoteNUMERICALORDER'); ?>
				<table class="table table-bordered">
					<thead>
					  	<tr>
					  		<th style="background: #e0e0e0"><input type="text" name="featurekeycaption" class="form-control" placeholder="Heading Text Key (e.g. Item)"></th>
					  		<th style="background: #e0e0e0"><input type="text" name="featurevaluecaption" class="form-control" placeholder="Heading Text Value (e.g. Price)"></th>
					  		<th width="50px">&nbsp;</th>
					  	</tr>
					</thead>
					<tbody class="content">
					  	<tr>
							<td><input type="text" name="featurekeycol[]" class="form-control" placeholder="e.g. Item A (Your item on quote)"></td>
							<td><input type="text" name="featurevalcol[]" class="form-control" placeholder="e.g. Rp3,0000,000.00/M2"></td>
							<td><button type="button" class="btn btn-sm btn-danger remove-this-row"><i class="fa fa-trash"></i></button></td>
						</tr>
					</tbody>
					<tbody>
					  	<tr>
					  		<td colspan="2"><button class="btn btn-md btn-default addrowquote" type="button" style="width: 100%">+ Add More Row</button></td>
					  		<td></td>
					  	</tr>
					</tbody>
				</table>
				
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-primary btn-md">Save Changes</button>
						<button class="btn btn-danger btn-md remove-quote" data-id="" type="button">Remove</button>
					</div>
				</div>
			 </div>
		</div>
	</form>
</script>

<script type="template" id="template-row-quote" style="display: none">
	<tr>
		<td><input type="text" name="featurekeycol[]" class="form-control" placeholder="e.g. Item A (Your item on quote)"></td>
		<td><input type="text" name="featurevalcol[]" class="form-control" placeholder="e.g. Rp3,0000,000.00/M2"></td>
		<td><button type="button" class="btn btn-sm btn-danger remove-this-row"><i class="fa fa-trash"></i></button></td>
	</tr>
</script>