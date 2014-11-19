<!DOCTYPE html>
<html>
<head>
	<title>topics</title>
</head>
<body>
	<?php
		//$get = $this->input->get(NULL, TRUE);
		//echo "<h1>" . $get['tid'] . "</h1>";
		foreach ($topic_list as $topic)
		{
			echo "<p><a href=\"".  site_url('forum/view_topic?tid=' . $topic->id) . "\">" . $topic->title . "</a> ";
			echo $topic->description;
			if (strcmp($topic->login, $this->session->userdata('login')) == 0)
			{
				echo "<a href=\"".  site_url('forum/edit_topic?tid=' . $topic->id) . "\">" . " EDIT</a>";
				echo "<form method='link' action=\"" . site_url('forum/edit_topic?tid=' . $topic->id) . "\"><input type='submit' value='Edit'></form>";
			}
			echo "</p>";
		}
	?>
	<?php
		if ($this->session->userdata('online') && $this->session->userdata('login'))
		{
			echo form_open('forum/create_topic', array('method' => 'post'));
			echo "title:<br />" . form_input(array('name' => 'title')) . "<br />";
			echo "description:<br />" . form_input(array('name' => 'description')) . "<br />";
			echo form_submit('submit', 'create topic');
		}
	?>
</body>
</html>
