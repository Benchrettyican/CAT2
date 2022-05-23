<?php
  // Connect to database
include 'db.php';
  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["myfile"]["tmp_name"];
    
    if ($_FILES["myfile"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        $sql = "INSERT into user (fullname,email,tel,plate,place,calendar,start_time,end_time,cost)
             values ('" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "')";
        $result = mysqli_query($dbh, $sql);
        
        if (! empty($result)) {
          $type = "success";
          $message = "Data is imported into the database";
        } else {
          $type = "error";
          $message = "Problem importing CSV data";
        }
      }
    }
  }
  //Return to the index page
  header('Location: home.php');
  exit;
?>

