<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<head>
	<link rel="stylesheet" href="<?php echo css_url();?>style.css"/>
	<link rel="stylesheet" href="<?php echo css_url();?>calendar.css"/>
		<title></title>
		<script type="text/javascript" src="../../assets/js/calendar.js"></script>

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
				<!-- Logger -->
			<legend><?php echo "Logger" ?>:</legend>
			<?php echo form_open('intra/logger', array('method'=>'link')); ?>
	 			<h4><input type="submit" value="<?php echo "View" ?>"></h4>
	 		<?php echo form_close();?>
	 		<!-- Test sujet -->
	 		<?php echo form_open('module/sujet_test', array('method'=>'post', 'enctype'=>'multipart/form-data')); ?>
		    <label for="sub">File PDF (max. 2 Mo) :</label><br />
		    <input type="hidden" name="MAX_FILE_SIZE" value="2048576" />
		    <center><input type="file" name="sub" id="sub" /><br /></center>
		    <label for="title">Title</label><br />
		    <input type="text" name="title" id="title" /><br />
			<input type="submit" name="submit" value="Upload" />
			<?php echo form_close();?>
	 		<!-- Partie pedagogique -->
	 			<!-- Module -->
	 		<legend><?php echo "Education" ?>:</legend>
			<?php echo form_open('module/module_create');?>
			<h4>Module creation:</h4>
			<h5>Module name</h5>
			<input type="text" name="name" value="Module" />
			<h5>Places</h5>
			<input type="text" name="places_nb" value="1" />
			<h5>Credits</h5>
			<input type="text" name="credits"  value="1" />
			<p><h5>Regestration start</h5><input type="text" name="reg_start" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<p><h5>Regestration end</h5><input type="text" name="reg_end" id="dateField1" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier1" onclick="calToogle();" />
			<div id="calendarWrap1">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar1"></div>
			</div>
			</div>
			<p><h5>Module start</h5><input type="text" name="module_start" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<p><h5>Module end</h5><input type="text" name="module_end" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<br>
			<input type="submit" value="Create Module">
			<?php echo form_close();?>
				<!-- Activité -->
			<?php echo form_open('module/activity_create',  array('method'=>'post', 'enctype'=>'multipart/form-data'));?>
			<h4>Activity creation:</h4>
			<h5>Activity name</h5>
			<input type="text" name="name" value="Activity" />
			<h5>File PDF (max. 2 Mo) :</h5>
		    <input type="hidden" name="MAX_FILE_SIZE" value="2048576" />
		    <center><input type="file" name="sub" id="sub" /><br /></center>
			<h5>Description</h5>
			<?php echo form_textarea(array('name' => 'description', 'rows'=>3, 'cols'=> 25))?>
			<h5>Linked module</h5>
			<select name="mid">
			<?php foreach($modules['unsubscribed'] as $elem)
				echo "<option value='$elem->id'>$elem->name</option>";
			?>
			</select>
			<h5>Places</h5>
			<input type="text" name="places_nb" value="1" />
			<h5>Group size</h5>
			<input type="text" name="group_size"  value="1" />
			<h5>Peer_correcting_nb</h5>
			<input type="text" name="peer_correcting_nb"  value="1" />
			<h5>Group generation</h5>
			<input type="radio" name="group_gen" value="auto" checked> Auto
			<br>
			<input type="radio" name="group_gen" value="manual"> Manual
			<h5>Type</h5>
			<input type="radio" name="type" value="project" checked> Project
			<br>
			<input type="radio" name="type" value="exam"> Exam
			<p><h5>Regestration start</h5><input type="text" name="reg_start" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<p><h5>Regestration end</h5><input type="text" name="reg_end" id="dateField1" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier1" onclick="calToogle();" />
			<div id="calendarWrap1">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar1"></div>
			</div>
			</div>
			<p><h5>Activity start</h5><input type="text" name="activity_start" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<p><h5>Activity end</h5><input type="text" name="activity_end" id="dateField" value="" /></p>
			<div id="calMain">
			<input type="button" id="cal_Toogle" value="Calendrier" onclick="calToogle();" />
			<div id="calendarWrap">
			<ul>
			<li><input type="button" value="&laquo;" onclick="calYearNav('-1');" /></li>
			<li><input type="button" value="&lsaquo;" onclick="calMonthNav('-1');" /></li>
			<li id="calendarTitle"> </li>
			<li><input type="button" value="&rsaquo;" onclick="calMonthNav('+1');" /></li>
			<li><input type="button" value="&raquo;" onclick="calYearNav('+1');" /></li>
			</ul>
			<div id="calendar"></div>
			</div>
			</div>
			<br>
			<input type="submit" value="Create activity">
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
						echo form_submit('go', 'Go'). "<br>";
						echo form_close();
						echo " open </form>"; //bouton pour fermer
						$data = array();
						foreach($admin_list as $login)
						{
							$data[$login] = $login;
						}
						echo form_open('dashboard/assign_ticket');
						echo form_hidden('id', $ticket->id);
						echo form_dropdown('admin', $data, $ticket->admin); //Liste de l'admin qui s'occupe du ticket
						echo form_submit('assign admin', 'assign'). "</form><br>";
						echo form_close();
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
			<?php echo form_open('intra/ldap_reset', array('method'=>'link'));?>
			<input type="submit" value="Reset LDAP">
			<?php echo form_close() ?>
			<?php echo form_open('intra/load_ldap', array('method'=>'link'));?>
			<input type="submit" name="Load LDAP" value="Load LDAP"/>
		</form>
  	</div>
</center>
<!-- javascript du calendrier -->
	<script type="text/javascript">
	//<![CDATA[
	function calnit(){
		dateObj.setDate(dateFieldId.value);
		dateObj.show();
		calShowTitle();
		calendarWrapId.style.display = "block";
	}
	function calToogle(){
		if(calendarWrapId.style.display == "block"){
			calendarWrapId.style.display = "none";
		}else{
			calnit();
			calendarWrapId.style.display = "block";
		}
	}
	function calMonthNav(val){
		dateObj.setMonth(val);
		dateObj.show();
		calShowTitle();
	}
	function calYearNav(val){
		dateObj.setYear(val);
		dateObj.show();
		calShowTitle();
	}
	function calClick(dateStr){
		var dateArr = dateStr.split('/');
		if(parseInt(dateArr[0], 10)<10) dateArr[0] = '0'+dateArr[0];
		if(parseInt(dateArr[1], 10)<10) dateArr[1] = '0'+dateArr[1];
		dateFieldId.value = dateArr[2]+'-'+dateArr[1]+'-'+dateArr[0];
		calendarWrapId.style.display = "none";
	}
	function calShowTitle(){
		monthName = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
		document.getElementById('calendarTitle').innerHTML = monthName[dateObj.dateDisp.getMonth()]+' '+dateObj.dateDisp.getFullYear();
	}
	// crée l'objet jsSimpleDatePickr
	var dateObj = new jsSimpleDatePickr('calendar');
	dateObj.funcDateClic = 'calClick';
	dateObj.classTable = 'calendar';
	dateObj.classTd = 'day';
	dateObj.classSelection = 'selectedDay';
	dateFieldId = document.getElementById('dateField');
	calendarWrapId = document.getElementById('calendarWrap');

	var dateObj1 = new jsSimpleDatePickr('calendar1');
	dateObj1.funcDateClic = 'calClick';
	dateObj1.classTable = 'calendar';
	dateObj1.classTd = 'day';
	dateObj1.classSelection = 'selectedDay';
	dateFieldId1 = document.getElementById('dateField1');
	calendarWrapId1 = document.getElementById('calendarWrap1');

	var dateObj2 = new jsSimpleDatePickr('calendar2');
	dateObj2.funcDateClic = 'calClick';
	dateObj2.classTable = 'calendar';
	dateObj2.classTd = 'day';
	dateObj2.classSelection = 'selectedDay';
	dateFieldId2 = document.getElementById('dateField2');
	calendarWrapId2 = document.getElementById('calendarWrap2');

	var dateObj3 = new jsSimpleDatePickr('calendar3');
	dateObj3.funcDateClic = 'calClick';
	dateObj3.classTable = 'calendar';
	dateObj3.classTd = 'day';
	dateObj3.classSelection = 'selectedDay';
	dateFieldId3 = document.getElementById('dateField3');
	calendarWrapId3 = document.getElementById('calendarWrap3');
	//]]>
	</script>
	</body>
</html>