<?php
require_once('bdd.php');


$sql = "SELECT
	`events`.id,
	`events`.title,
	`events`.`start`,
	`events`.`end`,
	`events`.color,
	`events`.comments,
	GROUP_CONCAT(DISTINCT tasks.pk_id) tasks
FROM
	`events`
LEFT JOIN event_tasks ON `events`.id = event_tasks.event_id
LEFT JOIN tasks ON event_tasks.task_id = tasks.pk_id
GROUP BY
	`events`.id";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

$sql2 = "SELECT * FROM tasks WHERE type=2";

$req2 = $bdd->prepare($sql2);
$req2->execute();

$tasks = $req2->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Calendar</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />


    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 100%;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <?php include "nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>DTC/DCC Meeting Management</h2>
                <br>
                <div id="calendar" class="col-centered"></div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  </div>
			  <div class="modal-body">
				
				<!--<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-2">
					  <input type="radio" name="status" checked> Planned
					</div>
					<div class="col-sm-2">
					  <input type="radio" name="status"> Held
					</div>
				  </div>-->

				  <div class="form-group">
					<label for="color" class="col-sm-3 control-label">Meeting</label>
					<div class="col-sm-9">
					  <select name="color" class="form-control" id="color">
						  <option style="color:#0071c5;" value="#0071c5">DTC Meeting</option>
						  <option style="color:#008000;" value="#008000">DCC Meeting</option>	
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">	
				  <div class="col-sm-3">
				  </div>				
					<div class="col-sm-9">
						<?php
						 foreach($tasks as $task): 
						?>
					  <p><input type="checkbox" name="tasks[<?php echo $task['pk_id']; ?>]"> <?php echo $task['description']; ?></p>
					<?php endforeach; ?>
					</div>
				  </div>
				  <div class="form-group">
					<label for="title" class="col-sm-3 control-label">Issues/Challenges</label>
					<div class="col-sm-9">
					  <textarea name="comments" id="comments" class="col-sm-12" rows="5">
</textarea>
					</div>
				  </div>

				  <input type="hidden" name="start" class="form-control" id="start">
				  <input type="hidden" name="end" class="form-control" id="end">
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
				
				<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-2">
					  <input type="radio" name="status" value="1"> Planned
					</div>
					<div class="col-sm-7">
					  <input type="radio" name="status" value="2" checked> Held
					</div>
				  </div>

				  <div class="form-group">
					<label for="color" class="col-sm-3 control-label">Meeting</label>
					<div class="col-sm-9">
					  <select name="color" class="form-control" id="color">
						  <option style="color:#0071c5;" value="#0071c5">DTC Meeting</option>
						  <option style="color:#008000;" value="#008000">DCC Meeting</option>	
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">	
				  <div class="col-sm-3">
				  </div>				
					<div class="col-sm-9">
						<?php
						 foreach($tasks as $task):
						?>
					  <p><input type="checkbox" class="tasks" name="tasks[<?php echo $task['pk_id']; ?>]" id="<?php echo $task['pk_id']; ?>"> <?php echo $task['description']; ?></p>
					<?php endforeach; ?>
					</div>
				  </div>
				  <div class="form-group">
					<label for="title" class="col-sm-3 control-label">Issues/Challenges</label>
					<div class="col-sm-9">
					  <textarea name="comments" id="comments" class="col-sm-12" rows="5">
</textarea>
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-3 control-label">Next Meeting Date</label>
					<div class="col-sm-9">
					  <input type="text" placeholder="YYYY-MM-DD" name="next_meeting" class="form-control" id="next_meeting" />
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-9">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				  <input type="hidden" name="start" class="form-control" id="start">
				  <input type="hidden" name="end" class="form-control" id="end">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Update</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
	<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '<?php echo date("Y-m-d"); ?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					//$('#ModalEdit #start').val(event.start.format('YYYY-MM-DD HH:mm:ss'));
					//$('#ModalEdit #end').val(event.end.format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalEdit #comments').val(event.comments);

					var array = event.tasks.split(',');
					$('#ModalEdit .tasks').each(function() {
						if(array.includes(this.id)) {
							this.checked = true;
						} else {
							this.checked = false;
						}						
					});

					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position
				edit(event);
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
				edit(event);
			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					comments: '<?php echo $event['comments']; ?>',
					tasks: '<?php echo $event['tasks']; ?>',
				},
			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});

</script>

</body>

</html>
