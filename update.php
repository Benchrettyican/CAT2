<?php
// include database connection file
require_once'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MY CAR PARKING CONTROL </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>



<?php
// Get the userid
$userid=intval($_GET['id']);
$sql = "SELECT * from user where id=?";
//Prepare the query:
$query = $dbh->prepare($sql);
//Execute the query:
$query->execute([$userid]);

//In case that the query returned at least one record, we can echo the records within a foreach loop:
while ($result=$query->fetch(PDO::FETCH_OBJ)) {
    # code...
?>
<form name="insertrecord" method="post" style="border:solid 1px; border-radius:4px; width:1000px;text-align:center; padding-left:200px; margin-left:100px;margin-top:100px;">
<div class="row">
<div class="col-md-4"><b>First Name</b>
<input type="text" name="fullname" value="<?php echo htmlentities($result->fullname);?>" class="form-control" required>
</div></div><br>

<div class="row">
<div class="col-md-4"><b>Email id</b>
<input type="email" name="email" value="<?php echo htmlentities($result->email);?>" class="form-control" required>
</div><br>
<div class="row">
 <div class="col-md-4"><b>Tel Number</b>
 <input type="text" name="tel" class="form-control" value="<?php echo htmlentities($result->id);?>" required>
</div>
</div>

<br><br>
<h3 style="margin-left:-600px;"> Car's Data</h3>

<div class="row">
<div class="col-md-4"><b>Car's plate</b>
<input type="text" name="plate" class="form-control" value="<?php echo htmlentities($result->plate);?>" required>
</div>

<div class="row">
<div class="col-md-4"><b>Zone/Place</b>
<input type="text" name="zone" class="form-control" value="<?php echo htmlentities($result->place);?>" required>
</div></div>

<div class="row">
<div class="col-md-4"><b>Date</b>
<input type="text" name="date" class="form-control" value="<?php echo htmlentities($result->calendar);?>" required>
</div>

<div class="row">
<div class="col-md-4"><b>Staring Time</b>
<input type="text" name="stime" class="form-control" value="<?php echo htmlentities($result->start_time);?>" required>
</div></div>


<div class="row">
<div class="col-md-4" ><b>End Time</b>
<input type="text" name="etime" class="form-control" value="<?php echo htmlentities($result->end_time);?>" required>
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

<?php } ?>
<div class="row" style="margin-top:1%">
<div class="col-md-8">
<input type="submit" name="update" value="Update">
</div>
</div>
</form>

</body>
</html>

<?php
// include database connection file
require_once'db.php';
if(isset($_POST['update']))
{
// Get the userid
$userid=intval($_GET['id']);
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


// Query for Query for Updation
$sql="update user set fullname=:fn,email=:eml,:tel=:tl:,:plate=:pt,:place=:plc,:calendar=:cal,:start_time=:stt,:end_time=:ent,:cost=:cs where id=:uid";
//Prepare Query for Execution
$query = $dbh->prepare($sql);
// Bind the parameters
$query->bindParam(':fn',$fname,PDO::PARAM_STR);
$query->bindParam(':eml',$emailid,PDO::PARAM_STR);
$query->bindParam(':tl',$tel,PDO::PARAM_STR);
$query->bindParam(':pt',$pt,PDO::PARAM_STR);
$query->bindParam(':plc',$zn,PDO::PARAM_STR);
$query->bindParam(':cal',$dte,PDO::PARAM_STR);
$query->bindParam(':stt',$st,PDO::PARAM_STR);
$query->bindParam(':ent',$et,PDO::PARAM_STR);
$query->bindParam(':cs',$cst,PDO::PARAM_STR);


// Mesage after updation

if (!$query->execute) {
    # code...
   echo "<script>alert('Record not  Updated ');</script>";
}else {
     echo "<script>alert('Record Updated successfully');</script>";
}

// Code for redirection
echo "<script>window.location.href='home.php'</script>"; 
}
?>