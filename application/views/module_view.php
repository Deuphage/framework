<!DOCTYPE html>
<html>
<head>
	<title>Modules</title>
	<link rel="stylesheet" type="text/css" href="<?php echo css_url();?>marene.css">
</head>
<body>
	<?php
		if ($modules['subscribed'] != FALSE)
		{
			foreach($modules['subscribed'] as $elem)
			{
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_open('module/module_unsubscribe', '', array('uid'=>$uid, 'mid'=>$elem->mid));
				echo '<p class="subscribed"><a href="' . base_url() . 'index.php/module/activities?mid='. $elem->mid. '"">' . $elem->name . "</a>\t";
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_submit('unsubscribe', 'Unsubscribe') . '</form>';
				echo "</p>";
			}
		}

		if ($modules['unsubscribed'] != FALSE)
		{
			foreach($modules['unsubscribed'] as $elem)
			{
				if ($status != 3 && strtotime($elem->reg_end) > time())								// |
					echo form_open('module/module_subscribe', '', array('uid'=>$uid, 'mid'=>$elem->id));	// |-> Not that necessary, but it's cleaner / nicer
				echo "<p>" . $elem->name . "\t"; // You can't click on an activity that you didnt subscribe to. Maybe you should...
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_submit('subscribe', 'Subscribe') . "</form>";
				echo "</p>";
			}
		}
	?>
</body>
</html>