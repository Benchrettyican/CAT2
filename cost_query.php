<?php
	session_start();
	require_once 'db.php';
 
	if(ISSET($_POST['add'])){
		if($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != ""){
			try{
				$hour = $_POST['hour'];
				$amt = $_POST['amount'];
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `cost` VALUES ('', '$hour', '$amt')";
				$dbh->exec($sql);
			}
			
			catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
			$dbh = null;
			header('location:home.php');
		}
		  else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'cost_reg.php'</script>
			";
		}}
	
?>