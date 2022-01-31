<form action="truncupdate.php" method="post">
<?php
 $dbname = 'Formee_Admin';
$conn = mysqli_connect('127.0.0.1', 'formeeadminuser', 'ForMeeAdmin*098', $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";

 $sql = "SHOW TABLES FROM $dbname";
$result = mysqli_query($conn,$sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysqli_error();
    exit;
}

while ($row = mysqli_fetch_row($result)) {
    echo "<br>    <input type='checkbox' id='{$row[0]}' name='{$row[0]}' value='{$row[0]}'>{$row[0]}\n";
}

mysqli_free_result($result);
?>
<input type="submit" value="submit">