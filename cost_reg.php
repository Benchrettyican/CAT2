<!DOCTYPE html>
<html lang="en">
	<head>
	<link href="bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="https://sourcecodester.com">CAR PARKING CONTROL</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Hours and their Cost</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">

<form  method="POST">	
			
<div class="row">
<div class="col-md-4" ><b>Hour</b>
<input type="text" name="hour" class="form-control" required>
</div>
<div class="row">
<div class="col-md-4" ><b>Cost</b>
<input type="text" name="cost" class="form-control" required>
</div></div>


<br>

<div class="row" >
<div class="col-md-8">
<input type="submit" name="insert" value="ADD">
</div>
</div>
</form>
</div>
</div>

</body>
</html>
<?php
// include database connection file
require_once'db.php';
if(isset($_POST['insert']))
{
// Posted Values
$hr=$_POST['hour'];
$amt=$_POST['cost'];


// Query for Insertion
$sql="INSERT INTO cost (hour,amount) VALUES(:hour,:amount)";
//Prepare Query for Execution
$query = $dbh->prepare($sql);
// Bind the parameters
$query->bindParam(':hour',$hr,PDO::PARAM_STR);
$query->bindParam(':amount',$amt,PDO::PARAM_STR);


// Query Execution
$query->execute();
// Check that the insertion really worked. If the last inserted id is greater than zero, the insertion worked.
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
// Message for successfull insertion
echo "<script>alert('Record inserted successfully');</script>";
echo "<script>window.location.href='home.php'</script>";
}
else
{
// Message for unsuccessfull insertion
echo "<script>alert('Something went wrong. Please try again');</script>";
echo "<script>window.location.href='cost_reg.php'</script>";
}
}
?>
		</div>
	</div>
</body>
</html>