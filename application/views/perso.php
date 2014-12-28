<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Intra 42</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href=<?php echo '"' . css_url() . 'bootstrap.min.css"'?> rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href=<?php echo '"' . css_url() . 'style.css"'?> rel="stylesheet">
	</head>
	<body>
<div class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('intra')?>">Intra 42</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url('intra/main')?>"><?php echo $menu_home;?></a></li>
		<li><a href="<?php echo site_url('intra/profile')?>"><?php echo $menu_profile;?></a></li>
		<?php
		if (isset($menu_admin))
        	echo "<li><a href=\"" . site_url('intra/admin'). "\">" . $menu_admin . "</a></li>";
        if (isset($menu_module))
        	echo "<li><a href=\"" . site_url('module'). "\">" . $menu_module . "</a></li>";
        ?>
	 	<li><a href="<?php echo site_url('intra/email')?>"><?php echo $menu_newsletter;?></a></li>
	 	<li><a href="<?php echo site_url('intra/annuaire')?>"><?php echo "Annuaire";?></a></li>
	 	<li><a href="<?php echo site_url('forum')?>"><?php echo $menu_forum;?></a></li>
	 	<li><a href="<?php echo site_url('e_learning')?>"><?php echo "E-learning" ?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	 	<li><a href="<?php echo site_url('intra/logout')?>"><?php echo $menu_logout;?></a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container">
  <div class="text-center">
	 <h1><?php echo $title_welcome?> !<h1>
	 <?php echo $this->session->userdata('login'); ?>
  </div>

</div><!-- /.container -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/scripts.js"></script>
	</body>
</html>