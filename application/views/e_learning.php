<!DOCTYPE html>
<html>
<head>
	<title>E-learning</title>
</head>
<body>
	<?php
		foreach ($modules['unsubscribed'] as $elem)
		{
			echo "<h4>" . $elem->name . "</h4>";
			echo "<br>";

			foreach ($e_learning as $elem2)
			{
				if ($elem2->mid == $elem->id)
					{
						echo "<a href=\"".  site_url('e_learning/view_file?file=' . $elem2->file . "&extension=" . $elem2->extension) . "\">" . $elem2->name . "</a>";
						// echo form_open('e_learning/delete_file');
						// echo form_hidden('id', $elem2->file);
						// echo form_submit('submit', 'X');
						echo "<br>";
					}

			}

			if ($this->session->userdata('status') > 0)
			{
				echo form_open('e_learning/add_file',  array('method'=>'post', 'enctype'=>'multipart/form-data'));
				echo form_input('name', 'Filename');
				echo "<h5>File PDF or Video :</h5>";
		    	//echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2048576\" />";
		    	echo "<input type=\"file\" name=\"file\" id=\"file\" /><br />";
		    	echo form_hidden('mid', $elem->id);
		    	echo form_submit('submit', 'Send file!');
		    	echo form_close();
			}
		}
		foreach ($activities as $elem)
		{
			if ($elem->type === "project")
			{
				echo "<h4>" . $elem->name . "</h4>";
				echo "<br>";
			
				foreach ($e_learning as $elem2)
				{
					if ($elem2->aid == $elem->id)
					echo "<a href=\"".  site_url('e_learning/view_file?file=' . $elem2->file . "&extension=" . $elem2->extension) . "\">" . $elem2->name . "</a><br> ";
				}
			
				if ($this->session->userdata('status') > 0)
				{
					echo form_open('e_learning/add_file',  array('method'=>'post', 'enctype'=>'multipart/form-data'));
					echo form_input('name', 'Filename');
					echo "<h5>File PDF or Video :</h5>";
					echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2048576\" />";
					echo "<input type=\"file\" name=\"file\" id=\"file\" /><br />";
					echo form_hidden('aid', $elem->id);
					echo form_submit('submit', 'Send file!');
					echo form_close();
				}
			}
		}
	?>
</body>
</html>
