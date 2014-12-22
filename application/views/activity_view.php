<!DOCTYPE html>
<html>
<head>
	<title>Activities</title>
	<link rel="stylesheet" type="text/css" href="<?php echo css_url();?>marene.css">
</head>
<body>
	<?php
		if ($activities['subscribed'] != FALSE)
		{
			foreach($activities['subscribed'] as $elem)
			{
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_open('module/activity_unsubscribe', '', array('uid'=>$uid, 'aid'=>$elem->aid, 'mid'=>$elem->mid));
				echo '<p class="subscribed"><a href="' . base_url() . 'index.php/module/subject?mid='. $elem->mid. '"">' . $elem->name . "</a>\t";
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_submit('unsubscribe', 'Unsubscribe') . '</form>';
				echo "</p>";
			}
		}

		if ($activities['unsubscribed'] != FALSE)
		{
			foreach($activities['unsubscribed'] as $elem)
			{
				if ($status != 3 && strtotime($elem->reg_end) > time())					
					echo form_open('module/activity_subscribe', '', array('uid'=>$uid, 'aid'=>$elem->id, 'mid'=>$elem->mid));
				echo "<p>" . $elem->name . "\t"; // You can't click on an activity that you didnt subscribe to. Maybe you should...
				if ($status != 3 && strtotime($elem->reg_end) > time())
					echo form_submit('subscribe', 'Subscribe') . "</form>";
				echo "</p>";
			}
		}
	?>
	
	
</body>
</html>
