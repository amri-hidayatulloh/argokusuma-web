<!DOCTYPE html>
<html>
<head>
	<title>Render Lang</title>
	<style type="text/css">
		* {
			font-family: sans-serif;
			color: #444;
			font-size: 12px;
			outline: none;
		}
		input {
			width: 300px;
			padding: 10px;
			margin-bottom: 10px;
			border : solid 1px #ccc;
		}
		select {
			width: 320px;
			padding: 10px;
			margin-bottom: 10px;
			border : solid 1px #ccc;
		}
		textarea {
			width: 300px;
			height: 100px;
			padding: 10px;
			margin-bottom: 10px;
			border : solid 1px #ccc;
		}
		button {
			padding: 10px;
			background: #f0f0f0;
			border : solid 1px #ccc;
			width: 100px;
		}
	</style>
</head>
<body>
	<form action="<?php echo site_url('render/lang/'.$group.'/'.$type); ?>" method="post">
		<label>Group</label><br>
		<input type="text" name="group" value="<?php echo $group; ?>"><br>
		<label>Field Type</label><br>
		<select name="type">
			<option value="text" <?php if($type == 'text') echo 'selected'; ?>>Single line Text</option>
			<option value="longtext" <?php if($type == 'longtext') echo 'selected'; ?>>Multiple line Text</option>
		</select>
		<br>
		<label>Key</label><br>
		<input type="text" name="key"><br>
		<?php 
		$langs = get_available_langs();
		foreach ($langs as $key => $value) {
		?>
		<label><?php echo $value['label']; ?></label><br>
		<textarea name="<?php echo $key; ?>"></textarea><br>
		<?php } ?>
		<button type="submit" name="submit">SAVE</button>
	</form>
</body>
</html>