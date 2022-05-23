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
<div class="container">
<div class="row">
<div class="col-md-12">
<h3> CAR PARKING CONTROL</h3> <br>
<a href="home.php"><button class="btn btn-primary">Home</button></a>
<a href="in.php"><button class="btn btn-primary"> Add New Vehicle</button></a>
<a href="Report.php"><button class="btn btn-primary"> Report</button></a>
<a href="index.php"><button class="btn btn-primary">Log Out</button></a>

<hr />


<div class="table-responsive">
<table id="mytable" class="table table-bordred table-striped">
<thead>
<th>#</th>
<th>First Name</th>
<th>Email</th>
<th>Tel</th>
<th>Car Plate</th>
<th>Place</th>
<th>Date</th>
<th>Start Time</th>
<th>End Time</th>
<th>Cost/Hr</th>


<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>
<?php
$sql = "SELECT * from user";
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
?>
<!-- Display Records -->
    <tr>
    <td><?php echo htmlentities($cnt);?></td>
    <td><?php echo htmlentities($result->fullname);?></td>

    <td><?php echo htmlentities($result->email);?></td>
    <td><?php echo htmlentities($result->tel);?></td>
    <td><?php echo htmlentities($result->plate);?></td>
    <td><?php echo htmlentities($result->place);?></td>
    <td><?php echo htmlentities($result->calendar);?></td>
    <td><?php echo htmlentities($result->start_time);?></td>

    <td><?php echo htmlentities($result->end_time);?></td>
    <td><?php echo htmlentities($result->cost);?></td>

<td><a href="update.php?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
<td><a href="delete.php?del=<?php echo htmlentities($result->id);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
    </tr>
<?php
// for serial number increment
$cnt++;
}} ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>