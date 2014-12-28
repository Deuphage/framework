<!DOCTYPE html>
<html>
<head>
	<title>E learning</title>
</head>
<body>
	<div>
	<?php
		$get = $this->input->get(NULL, TRUE);
		if ($get['extension'] === "pdf")
			echo "<center><embed src=\"../../assets/e-learning/" . $get['file'] . "\" width=\"80%\" height=\"1000px\"></center>" ;
		else if ($get['extension'] === "mp3" || $get['extension'] === "ogg")
		{
			echo "<audio src=\"../../assets/e-learning/" . $get['file'] . "\" controls>";
 			echo "Merci de changer de navigateur. Genre pas Opera.";			
			echo "</audio>";
		}
		else
			echo "<video src=\"../../assets/e-learning/" . $get['file'] . "\"⁪ controls ></video⁪⁪>" ;
	?>
	</div>
</body>
</html>