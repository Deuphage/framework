<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../assets/css/styles.css" rel="stylesheet">
	</head>
	<body>
	 <?php echo validation_errors(); ?>
  <div class="text-center">
    <h1><?php echo $form_username ?></h1>
	 <p class="lead">
	 <?php echo form_open('intra/login'); ?>
	 <h5><?php echo $form_username ?></h5>
	 <input type="text" name="login" value="<?php echo set_value('login');?>"/><br>
	 <h5><?php echo $form_password ?></h5>
	 <input type="password" name="pass"/><br>
	 <h3><input type="submit" value="<?php echo $menu_login;?>"></h3>
	 </form>
	 </p>
  </div>
	</body>
</html>