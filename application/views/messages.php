<!DOCTYPE html>
<html>
<head>
	<title>FORUM</title> <!-- Change the title so it can read the name of the topic -->
</head>
<body>
<?php
	if ($list_messages != FALSE)
	{ 
		foreach ($list_messages as $msg)
		{
			echo "<p>" . $msg->login . " said:   " . $msg->message;
			if (strcmp($msg->login, $this->session->userdata('login')) == 0)
			{
				echo "<a href=\"".  site_url('forum/edit_message?mid=' . $msg->id . '&tid=' . $msg->tid) . "\">" . " EDIT</a>";
				echo form_open('forum/delete_message');
				echo form_hidden('id', $msg->id);
				echo form_hidden('tid', $msg->tid);
				echo form_submit('delete_msg', 'delete');
				echo form_close();
			}
			echo "</p>";
		}
	}
	if ($this->session->userdata('online') && $this->session->userdata('login'))
	{
		echo form_open('forum/create_message');
		echo "title:<br />" . form_input(array('name' => 'title')) . "<br />";
		echo "message: <br />" . form_textarea(array('name' => 'message', 'cols' => 25, 'rows' => 5)) . "<br />";
		echo form_hidden('tid', $tid);
		echo form_submit('submit', 'post reply');
	}
 ?>
</body>
</html>