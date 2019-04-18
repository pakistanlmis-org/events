<?php

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = 'DCC Meeting';
	if($_POST['color'] == '#0071c5') {
		$title = 'DTC Meeting';
	}
	
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$comments = $_POST['comments'];

	$sql = "INSERT INTO events(title, start, end, color, user_id, status, comments) values ('$title', '$start', '$end', '$color', 1, 1, '$comments')";
	//$req = $bdd->prepare($sql);
	//$req->execute();	
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

	$event_id = $bdd->lastInsertId();

	foreach ($_POST['tasks'] as $key=>$value) {
		$qry = $bdd->prepare("INSERT INTO event_tasks(event_id, task_id, status) values ('$event_id', '$key', 2)");
		$qry->execute();
	}

}	
?>
<script type="text/javascript">window.location= 'index.php'; </script>