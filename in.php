<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MY CAR PARKING CONTROL </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h3>Client| Car Informations</h3>
<hr />
</div>
</div>
<form name="insertrecord" method="post" style="border:solid 1px; border-radius:4px; width:1000px;text-align:center; padding-left:200px;">
<h3 style="margin-left:-600px;"> Client Data</h3>
<div class="row">
<div class="col-md-4"><b>Full names</b>
<input type="text" name="fullname" class="form-control" required>
</div></div>

<div class="row">
<div class="col-md-4"><b>Email id</b>
<input type="email" name="email" class="form-control" required>
</div></div>

                 <div class="row">
                 <div class="col-md-4"><b>Tel Number</b>
                 <input type="text" name="tel" class="form-control" required>
                    </div>
                </div>
<br><br>
<h3 style="margin-left:-600px;"> Car's Data</h3>

<div class="row">
<div class="col-md-4"><b>Car's plate</b>
<input type="text" name="plate" class="form-control" required>
</div>
<div class="row">
<div class="col-md-4"><b>Zone/Place</b>
<input type="text" name="zone" class="form-control" required>
</div></div>

<div class="row">
<div class="col-md-4"><b>Date</b>
<input type="date" name="date" class="form-control" required>
</div>

<div class="row">
<div class="col-md-4"><b>Staring Time</b>
<input type="text" name="stime" class="form-control" required>
</div></div>


<div class="row">
<div class="col-md-4" ><b>End Time</b>
<input type="text" name="etime" class="form-control" required>
</div>
<div class="row">
<div class="col-md-4" ><b>Cost</b>
<select name="cost">
<?php
	require_once 'db.php';

$sql = "SELECT * from cost where amount ";
//Prepare the query:
$query = $dbh->prepare($sql);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$results=$query->fetchAll(PDO::FETCH_OBJ);
// For serial number initialization
$cnt=1;
if($query->rowCount() > 0)
{
//In case that the query returned at least one record, we can echo the records within a foreach loop:
foreach($results as $result)
{
   $co= htmlentities($result->amount);}
?>

<option> <?php echo $co?></option>
<?php }?>
</select>

</div></div>


<br>

<div class="row" style="">
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
$fname=$_POST['fullname'];
$emailid=$_POST['email'];
$tel=$_POST['tel'];
$pt=$_POST['plate'];
$zn=$_POST['zone'];
$dte=$_POST['date'];
$st=$_POST['stime'];
$et=$_POST['etime'];
$cst=$_POST['cost'];

// Query for Insertion
$sql="INSERT INTO user(fullname,email,tel,plate,place,calendar,start_time,end_time,cost) VALUES(:fullname,:email,:tel,:plate,:place,:calendar,:start_time,:end_time,:cost)";
//Prepare Query for Execution
$query = $dbh->prepare($sql);
// Bind the parameters
$query->bindParam(':fullname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$emailid,PDO::PARAM_STR);
$query->bindParam(':tel',$tel,PDO::PARAM_STR);
$query->bindParam(':plate',$pt,PDO::PARAM_STR);
$query->bindParam(':place',$zn,PDO::PARAM_STR);
$query->bindParam(':calendar',$dte,PDO::PARAM_STR);
$query->bindParam(':start_time',$st,PDO::PARAM_STR);
$query->bindParam(':end_time',$et,PDO::PARAM_STR);
$query->bindParam(':cost',$cst,PDO::PARAM_STR);

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
echo "<script>window.location.href='home.php'</script>";
}
}
?>