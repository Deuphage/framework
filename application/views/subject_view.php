<!DOCTYPE html>
<html>
<head>
	<title>View subject</title>
</head>
<body>
	<div>
	<?php
		$get = $this->input->get(NULL, TRUE);
		echo "<center><embed src=\"../../assets/pdf/" . $get['subject'] . "\" width=\"80%\" height=\"1000px\"></center>" ;
	?>
	</div>
</body>
</html>
