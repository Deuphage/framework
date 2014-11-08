<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Intra 42</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="../../assets/css/styles.css" rel="stylesheet">
		<!--<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css"/> -->
	</head>
	<body><center>
		
		<div class="text-center">
    		<h1><?php echo "Annuaire"?></h1>
	 		<p class="lead">
	 		<?php
	 			foreach($ldap_list as $data)
				{
  					echo $data->cn . " - " . $data->uid . " - " . $data->mobilephone . " " . "<br>";
				}
			?>
			</p>
  		</div>
	</center>
	</body>
</html>