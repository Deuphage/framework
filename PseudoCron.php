#!/usr/bin/php
<?php

	function prepare_peer_correction_group($db, $data)
	{
		$aid = $data['id'];
		$query = $db->query('SELECT uid FROM activity_subscriptions WHERE aid=' . $aid);
		$all = $query->fetchAll(PDO::FETCH_ASSOC);
		$row_num = $query->rowCount();
		for ($i=0; $i < $row_num; $i++)
		{
			for ($j=1; $j <= $data['peer_correcting_nb']; $j++)
			{
				$insert = $db->prepare('INSERT INTO peer_correction(aid, corrector_uid, corrected_uid)
					VALUES(:aid, :corrector, :corrected)');
				$insert_data = array(
					':aid'			=>	$data['id'],
					':corrector'	=>	$all[($i + $j) % $row_num]['uid'],
					':corrected'	=>	$all[$i]['uid']
				);
				$insert->execute($insert_data);
			}
		}
		$db->query('UPDATE activity SET peer_corrections=1 WHERE id=' . $data['id']);
	}

	date_default_timezone_set('Europe/Paris');
	try
	{
		$db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=gpw', 'root', 'groscaca');
		while (42)
		{
			sleep(60); // Check every 60 seconds
			echo '[' . date('d/m/Y H:i', time()) . ']';
			$query = $db->prepare('SELECT * FROM activity WHERE UNIX_TIMESTAMP(activity_end) < :time AND peer_corrections=0');
			$res = $query->execute(array(':time'=>time()));
			while (($data = $query->fetch(PDO::FETCH_ASSOC)) != FALSE)
			{
				prepare_peer_correction_group($db, $data);
				echo " " . $data['name'] . ": Peer correction group created";
			}
			echo PHP_EOL;
		}
	}
	catch (PDOException $e)
	{
		echo "PseudoCron script error: " . $e->getMessage() . PHP_EOL;
		die;
	}
?>