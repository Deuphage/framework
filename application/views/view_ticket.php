<!DOCTYPE html>
<html>
<head>
	<title>View ticket</title>
</head>
<body>
	<div class="text-center">
		<?php
			echo "<h2>#" . $info_ticket[0]->id . " " . $info_ticket[0]->title . "</h2><br>";
 			echo "<legend>Description :</legend>";
			echo $info_ticket[0]->description . "<br>";
			echo "<legend>Messages :</legend>";
			foreach ($messages_list as $message)
			{
				echo $message->login . " said: " . $message->message . "<br>";
			}
			echo form_open('dashboard/new_message');
			echo form_hidden('tid', $info_ticket[0]->id);
			echo "<legend>Feedback:</legend>";
			echo "Message:<br> " . form_textarea(array('name'=>'message', 'rows'=> 3, 'cols'=> 25)) . "<br>";
			echo form_submit('new_message', 'Reply');
			echo form_close();
			if ($info_ticket[0]->open == 1)
			{
				echo form_open('dashboard/close_ticket');
				echo form_hidden('tid', $info_ticket[0]->id);
				echo form_submit('close', 'Close ticket');
				echo form_close();
			}
		?>
	</div>
</body>
</html>
