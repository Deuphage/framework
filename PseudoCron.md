PseudoCron.php is a script that checks every minutes to see wether or not an
activity ended (meaning that activity.activity_end has past).
If so, the script generates peer correction groups of the size of
activity.peer_correcting_nb and set activity.peer_correction to 1.
