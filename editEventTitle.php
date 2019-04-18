<?php

require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
} elseif (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['id']) && $_POST['status'] == '1'){
	
	$id = $_POST['id'];

	$sql = "DELETE FROM event_tasks WHERE event_id = $id;";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

	$title = 'DCC Meeting';
	if($_POST['color'] == '#0071c5') {
		$title = 'DTC Meeting';
	}
	
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$comments = $_POST['comments'];

	$sql = "UPDATE events SET title = '$title', start = '$start', end='$end', color='$color', user_id=1, status = 1, comments = '$comments' WHERE id = $id";
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

	foreach ($_POST['tasks'] as $key=>$value) {
		$qry = $bdd->prepare("INSERT INTO event_tasks(event_id, task_id, status) values ('$id', '$key', 2)");
		$qry->execute();
	}

}

if(isset($_POST['next_meeting']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['id']) && $_POST['status'] == '2'){

	$id = $_POST['id'];
	$sql = "UPDATE events SET status = 2 WHERE pk_id = $id";
	$req = $bdd->prepare($sql);
	$req->execute();

		$title = 'DCC Meeting';
	if($_POST['color'] == '#0071c5') {
		$title = 'DTC Meeting';
	}
	
	$start = $_POST['next_meeting'];
	$end = $_POST['next_meeting'];
	$color = $_POST['color'];
	$comments = $_POST['comments'];

	$sql = "INSERT INTO events(title,start,end,color,user_id,status,comments) values ('$title','$start','$end','$color',1,1,'$comments');";
	
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