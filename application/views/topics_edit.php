<!DOCTYPE html>
<html>
<head>
	<title>Edit topics</title>
</head>
<body>
	<?php
		$get = $this->input->get(NULL, TRUE);
		echo form_open('forum/edit_topic?tid=' . $get['tid'], array('method' => 'post'));
		echo "title:<br />" . form_input(array('name' => 'title')) . "<br />";
		echo "description:<br />" . form_input(array('name' => 'description')) . "<br />";
		echo form_submit('submit', 'edit topic');
	?>
</body>
</html>
