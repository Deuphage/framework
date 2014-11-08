<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../assets/css/styles.css" rel="stylesheet">
		<style>
			.french {
			background:url("../../assets/French Flag.png");
			border:none;
			width: 200px; /* largeur à spécifier */
			height: 200px; /* longueur à spécifier */
			cursor: pointer;
			}
			.english {
			background:url("../../assets/English Flag.png");
			border:none;
			width: 200px; /* largeur à spécifier */
			height: 200px; /* longueur à spécifier */
			cursor: pointer;
			}
			.japanese {
			background:url("../../assets/Japanese Flag.png");
			border:none;
			width: 200px; /* largeur à spécifier */
			height: 200px; /* longueur à spécifier */
			cursor: pointer;
			}
		</style>
	</head>
	<body>
	 <?php echo validation_errors(); ?>
  <div class="text-center">
  	<?php echo form_open('intra/set_language'); ?>
	  	<input type="hidden" name="language" value="french">
    	<input type="submit" class="french" name="french" value=""/>
    </form>
    <?php echo form_open('intra/set_language'); ?>
	    <input type="hidden" name="language" value="english">
    	<input type="submit" class="english" name="english" value=""/>
	</form>
	<?php echo form_open('intra/set_language'); ?>
	    <input type="hidden" name="language" value="japanese">
    	<input type="submit" class="japanese" name="japanese" value=""/>
	</form>
	<?php echo form_open('intra/ldap_reset');?>
			<button type="submit">Reset LDAP</button>
	</form>
	 </p>
  </div>
	</body>
</html>