<!DOCTYPE html>
<html lang="en">
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
	</head>
	<body>
<div class="container">
	 <?php echo validation_errors();?>
	 <div class="text-center">
	 <?php echo form_open('intra/change_profile'); ?>
	 <fieldset>
	 <legend>Personal information of :<?php echo $login; ?></legend>
	 <h5>Login:</h5>
	 <?php echo $login; ?><br>
	 <h5>First name</h5>
	 <?php echo $first_name; ?>
	 <h5>Last name</h5>
	 <?php echo $surname; ?><br>
	 <h5>E-mail:</h5>
	 <?php echo $email; ?><br>
	 <h5>Sex:</h5>
	 <?php echo $sex; ?><br>
	 <h5>Status:</h5>
	 <?php echo $status; ?><br>
	</fieldset>
	 <?php echo form_close();?>
	 </div>

</div><!-- /.container -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/scripts.js"></script>
	</body>
</html>