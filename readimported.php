<!DOCTYPE html>
<html>
<head>
  <title>Import CSV File in MySQL PHP</title>
</head>
<body>
    <h3>Read the article on : <a href="https://stackhowto.com/how-to-import-csv-file-in-mysql-php/" target="_blank">How to Import CSV File in MySQL PHP</a></h3>
    <form enctype="multipart/form-data" action="import_csv.php" method="post">
        <div class="input-row">
            <label class="col-md-4 control-label">Choose a CSV file</label>
            <input type="file" name="file" id="file" accept=".csv">
            <br />
            <br />
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            <br />
        </div>
    </form>
    <?php
      // Connect to database
      include("db.php");
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tbody>
                    <tr>
                        <td> <?php  echo $row['id']; ?> </td>
                        <td> <?php  echo $row['name']; ?> </td>
                        <td> <?php  echo $row['description']; ?> </td>
                        <td> <?php  echo $row['price']; ?> </td>
                    </tr>
            <?php } ?>
                </tbody>
        </table>
        <?php } ?>
</body>
</html>