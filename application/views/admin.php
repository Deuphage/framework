<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<head>
	<link rel="stylesheet" href="<?php echo css_url();?>style.css"/>
		<title></title>
	</head>
	<body><center>
		<?php echo $title_admin;?>
		<div class="text-center">
    		<h1><?php echo $title_panel?></h1>
	 		<p class="lead">
	 		<!-- Partie gestion utilisateur -->
	 		<?php echo form_open('intra/admin_form');?>
				<h5><?php echo $form_username?></h5>
				<select name="login">
				<?php foreach($user_list as $login)
					echo "<option value='$login'>$login</option>";
				?>
				</select>
				<p><input type="text" name="login2"></p>
				<h5>First name</h5>
				<input type="text" name="first_name">
				<h5>Email</h5>
				<input type="text" name="email">
				<h5>Gender</h5>
				<input type="radio" name="gender" value="1" checked> Male
				<br>
				<input type="radio" name="gender" value="0"> Female
				<h5><?php echo $form_status?></h5>
				<select name="status"/>
					<option value="0"><?php echo $form_mere_mortal;?></option>
					<option value="-1"><?php echo "Miserable closed account";?></option>
					<option value="1"><?php echo $form_all_powerful;?></option>
				</select>
				<h5>Password</h5>
				<input type="password" name="pass">
				<h5><?php echo $form_action?></h5>
				<select name="action"/>
					<option value="read"><?php echo $form_action_read;?></option>
					<option value="create"><?php echo "Create";?></option>
					<option value="modify"><?php echo $form_action_modify;?></option>
					<option value="delete"><?php echo $form_action_delete;?></option>
				</select>
				<h3><input type="submit" value="<?php echo $form_control;?>"></h3>
			</form>
			</p>

			<?php echo form_open('intra/logger', array('method'=>'link')); ?>
	 			<h4><input type="submit" value="<?php echo "Logs" ?>"></h4>
	 		<?php echo form_close();?>
				<!-- Partie ticket -->
			<legend><?php echo "Tickets" ?>:</legend>
			<?php
			if ($list_ticket != FALSE)
			{
				foreach ($list_ticket as $ticket)
				{
					if ($ticket->open == 1)
					{
						echo form_open('dashboard/view_ticket');
						echo form_hidden('id', $ticket->id);
						echo "#".$ticket->id . " | " . $ticket->login . " | " . $ticket->title . "  " . $ticket->priority . " | " . $ticket->admin;
						echo form_submit('go', 'Go');
						echo form_close();
						echo " open "; //bouton pour fermer
						$data = array();
						foreach($admin_list as $login)
						{
							$data[$login] = $login;
						}
						echo form_dropdown('admin', $data, $ticket->admin) . "<br>"; //Liste de l'admin qui s'occupe du ticket
					}
					else
					{
						echo "#".$ticket->id . " | " . $ticket->login . " | " . $ticket->title . "  " . $ticket->priority . " | " . $ticket->admin;
						echo " closed <br>"; //bouton pour ouvrir
						echo form_open('dashboard/open_ticket');
						echo form_hidden('id', $ticket->id);
						echo form_submit('open', 'Open');
						echo form_close();
					}
				}
			}
			?>
			<?php echo form_open('intra/ldap_reset');?>
			<button type="submit">Reset LDAP</button>
		</form>
  	</div>
</center>

	</body>
</html>