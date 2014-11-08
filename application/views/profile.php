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
	 <legend><?php echo $form_perso_info ?>:</legend>
	 <h5><?php echo $form_username?>:</h5>
	 <input type="text" name="login" value="<?php echo $this->session->userdata('login');?>"><br>
	 <h5><?php echo $form_old_password?>:</h5>
	 <input type="password" name="pass">
	 <h5><?php echo $form_password?>:</h5>
	 <input type="password" name="old_pass"><br>
	 <h5><?php echo $form_email?>:</h5>
	 <input type="text" name="email" value="<?php echo 'coucou';?>"><br>
	 <h4><input type="submit" value="<?php echo $form_action_modify ?>"></h3>
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