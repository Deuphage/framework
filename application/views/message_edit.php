<!DOCTYPE html>
<html>
<head>
	<title>Edit topics</title>
</head>
<body>
	<?php
		$get = $this->input->get(NULL, TRUE);
		echo form_open('forum/edit_message?tid=' . $get['tid'] . "mid=" . $get['mid'], array('method' => 'post'));
		echo "title:<br />" . form_input(array('name' => 'title')) . "<br />";
		echo "message:<br />" . form_input(array('name' => 'message')) . "<br />";
		echo form_submit('submit', 'edit message');
	?>
</body>
</html>
