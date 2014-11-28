<!DOCTYPE html>
<html>
<head>
	<title>Create new ticket</title>
</head>
<body>
	<div class="text-center">
	<?php
		echo form_open('dashboard/new_ticket');
		echo "<h5>Summary of  the problem:<br />" . form_input(array('name' => 'title')) . "</h5><br />";
		echo "<h5>Description of Issue:<br />" . form_textarea(array('name' => 'description', 'rows'=>10, 'cols'=> 25)) . "</h5><br />";
		echo "<h5>Priority:<br />" . form_dropdown('priority', array('0' => '0 - maximum priority', '1' => '1 - high priority', '2' => '2 - normal priority', '3'=> '3 - low priority', '4'=>'4 - lowest priority'), '2') . "</h5><br>";
		
		echo form_submit('submit', 'Submit');
	?>
	</div>
</body>
</html>
