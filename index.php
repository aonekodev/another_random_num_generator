<!DOCTYPE html>
	<?php
	
	session_start();
	//OLD ARRAY DATA
	if(!isset($_SESSION["winners"])){
		$_SESSION["winners"] = array(); 
	}
	$old_winners = $_SESSION["winners"];	
	

	function randomize($start,$end,$times,$old_winners){
		$num = array();
		for($start;$start<=$end;$start++){
			array_push($num,$start);
		}
		//Exclude Part
		foreach($_SESSION["winners"] as $winner){

			if(($key = array_search($winner,$num))!== false){
				unset($num[$key]);
			}

		}
		//Assigning
		shuffle($num);
		$num_slice = array_splice($num,0,$times);
		$_SESSION["winners"]=array_merge($_SESSION["winners"],$num_slice);
		
	}

	if(isset($_POST['start']) OR isset($_POST['end']) OR isset($_POST['number'])){

		randomize($_POST['start'],$_POST['end'],$_POST['number'],$old_winners);

	}

?>
<html>
<head>
	<title>Random Number</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<style type="text/css">
		body{
			font-family: 'Source Sans Pro', sans-serif;

		}
		kbd{
			font-size: 22px;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-light bg-light">

	</nav>
	<h4 class="text-danger text-center">
	<?php
	if(isset($message)){
		echo $message;
	}
	?>
	</h4>
	<div class="container mt-4">
	<form action="assign.php" method="POST">
	<div class="row">
	
	<div class="col-lg-2 for">
		<input type="text" required class="form-control" name="start" placeholder="Start Value">
	</div>
	<div class="col-lg-2">
		<input type="text" required class="form-control" name="end" placeholder="End Value">
	</div>
	<div class="col-lg-2">
		<input type="text" required class="form-control" name="number" placeholder="Number Of Times">
	</div>
	<div class="col-lg-2">
		<button type="submit" class="btn btn-success">Assign</button>
	</div>
	
	</div>
	</form>
		<form action="#" method="POST" class="mt-3">
		<div class="form-group">
			<label>Start number</label>
			<input type="text" name="start" required class="form-control input-lg" placeholder="Enter your start value" value="<?php  if(isset($_SESSION['start_value'])){echo $_SESSION['start_value']; } ?>">
		</div>

		<div class="form-group">
			<label>End number</label>
			<input type="text" name="end" required class="form-control input-lg" placeholder="Enter your end value" value="<?php  if(isset($_SESSION['end_value'])){echo $_SESSION['end_value']; } ?>">
		</div>

		<div class="form-group">
			<label>Number Of Output</label>
			<input type="text" name="number" required class="form-control input-lg" value="<?php  if(isset($_SESSION['number'])){echo $_SESSION['number']; } ?>">
		</div>

		<div class="float-right">


			<button type="submit" class="btn btn-primary">Roll !</button>
			
		</div>
		</form>

		<form action="reset.php" method="POST">
			<button type="submit" class="btn btn-danger">Reset !</button>
		</form>
		<h4 class="mt-4" style="color:#726464">WINNERS !</h4>
		<h4 class="mt-4 text-center text-danger">
			<?php
			if(isset($nothing_left)){
				echo $nothing_left;
			}
			?>
		</h4>
		<table class="table mt-2">
			<thead>

    				<tr>
    				<th scope="col">Page</th>
    				<?php for($x=1;$x<=10;$x++){
    					echo "<th scope='col'>".$x."</th>";
    				}
    				?>
    				  
    				</tr>
			</thead>

			<tbody>
				
			<?php
			$count = 1;
			$row_number =1;
			if(isset($_SESSION["winners"])){

				foreach($_SESSION["winners"] as $winners){
				if($count%10==1){
					echo "<tr>";
					echo "<th class='scope'>".$row_number."</th>";
					$row_number++;
				}	

				echo "<td><kbd>".$winners."<kbd></td>";	

				if($count%10==0){
				echo "</tr>";
				}
				$count++;
				}
				
			}
				?>
			</tbody>

		</table>

	</div>
<hr>

</body>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>

