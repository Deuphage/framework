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
    <h1><?php echo $title_register?></h1>
	 <p class="lead">
	 <?php echo form_open('intra/register'); ?>
	 <h5><?php echo $form_username?></h5>
	 <input type="text" name="login" value="<?php echo set_value('login');?>"/><br>
	 <h5><?php echo $form_password?></h5>
	 <input type="password" name="pass" value="<?php echo set_value('pass');?>"/><br>
	 <h5><?php echo $form_confirmation?></h5>
	 <input type="password" name="passconf" value=""/><br>
	 <h5><?php echo $form_first_name?></h5>
	 <input type="text" name="first_name" value="<?php echo set_value('first_name');?>"/><br>
	 <h5><?php echo $form_surname?></h5>
	 <input type="text" name="surname" value="<?php echo set_value('surname');?>"/><br>
	 <h5><?php echo $form_gender?></h5>
	 <input type="radio" name="gender" value="1"><img src="../../assets/male_knight.jpg" alt="male knight">
	 <input type="radio" name="gender" value="0"><img src="../../assets/female_angel.jpg" alt="female angel">
	 <h5><?php echo $form_email?></h5>
	 <input type="text" name="email" value="<?php echo set_value('email');?>"/><br>
	 <h5><?php echo $form_avatar?></h5>
	 <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	 <input type="file" name="avatar" style="display:block;margin:auto;">
	 <h3><input type="submit" value="42"></h3>
	 </form>
	 </p>
  </div>
	</body>
</html>