<div class="col-xs-12">
	<div class="box box-solid">
           
        <div class="box-body">
			<fieldset>
	          	<legend style="padding-bottom:5px">
	          		Lists&nbsp;&nbsp;
	          		<a href="<?php echo site_url('webtools/consultation/contactaction/add'); ?>"   class="btn btn-danger btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Channel</a>
	          	</legend>
	        </fieldset>
			<div class="box-body">
				<div class="table-responsive">
				<table id="table-data" class="datatable table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Channel</th>
							<th>Channel Link/Number</th>
							<th>Label</th>
							<th>Language Available</th>
							<th>Created Date</th>
							<th width="140px">&nbsp;</th>
						</tr>
				  	</thead>
					<tbody>
						<?php foreach ($lists as $key => $value) { ?>
						<tr>
							<td><?php echo $value['id']; ?></td>
							<td><?php echo $value['channel_type']; ?></td>
							<td><?php echo $value['channel_value']; ?></td>
							<td><?php echo $value['label']; ?></td>
							<td><?php echo $value['lang_available']; ?></td>
							<td><?php echo $value['created_date']; ?></td>
							<td width="140px">
								<div class="btn-group pull-right">
				          			<a href="<?php echo site_url('webtools/consultation/contactaction/edit/'.$value['id']); ?>" class="btn btn-default btn-sm" title="edit"><i class="fa fa-pencil"></i> Edit</a>
				          			<a href="" class="btn btn-danger btn-sm deletetrigger" data-table="consultation_contact" data-type="update" data-param="is_active=0" data-ids="id=<?php echo $value['id']; ?>" title="delete"><i class="fa fa-trash"></i> Remove</a>
				          		</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>